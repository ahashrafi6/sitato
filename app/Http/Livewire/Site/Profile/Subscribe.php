<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Product;
use App\Rules\Domain;
use App\Traits\Site\LicenceApi;
use App\Traits\Site\PayApi;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Subscribe extends Component
{
    public $count = 10;

    public $current_page = 1;
    public $last_page;
    public $enable_prev;
    public $enable_next;

    public $domain;

    public $plan = '3month';
    public $discount_code;
    public $discount_percent = 0;
    public $discount = 0;

    public $search;
    public $downloads;


    public function Download()
    {
        $this->validate([
            'search' => 'required',
        ]);

        $this->downloads = Product::where('fa_title' , 'LIKE' , '%' . $this->search . '%')->whereIn('access' , ['full' , 'subscribe'])->take(8)->get();
    }

    public function Domain($licence_id)
    {
        $this->validate([
            'domain' => [new Domain()],
        ]);

        $response = LicenceApi::licence_domain([
            'type' => 'change',
            'domain' => sanitize_domain($this->domain),
            'user_id' => auth()->user()->id,
            'licence_id' => $licence_id,
        ]);

        if ($response->successful()) {
            if ($response['error'])
                $this->emit('fail-alert');


            session()->flash('success');
            return redirect()->to(route('profile.subscribes'));
        }
    }

    public function Renew($licence_id)
    {
        $this->validate([
            'plan' => 'required',
        ]);

        $plan = \App\Models\Subscribe::where('en_title' , $this->plan)->first();
        if ($plan){

            // create factor on pay server
            $response = PayApi::factor_subscribe_renew([
                'user_id' => auth()->user()->id,
                'licence_id' => $licence_id,
                'plan' => [
                    'title' => $plan->fa_title,
                    'day' => $plan->day,
                    'gift' => $plan->gift,
                    'obj' => subscribe_obj($plan->price, $plan->offPrice, $this->discount),
                ],
            ]);

            if ($response->successful()) {
                return redirect()->to($response['url']);
            }
        }

        $this->emit('fail-alert');
    }

    public function applyDiscount()
    {
        $discount = \App\Models\Discount::where('code', $this->discount_code)->whereType('subscribe')->first();

        if ($discount) {
            // check exist
            if ($discount->id == $this->discount) {
                return session()->flash('error', 'این کد تخفیف از قبل اعمال شده است!');
            }

            // check expire
            if (!is_null($discount->expire_at) && $discount->expire_at < now()->toDateString()) {
                return session()->flash('error', 'زمان استفاده از کد تخفیف به اتمام رسیده است!');
            }

            // check capacity
            if (!is_null($discount->capacity) && ($discount->capacity - $discount->consumed) <= 0) {
                return session()->flash('error', 'ظرفیت کد تخفیف تمام شده است!');
            }

            // check per user
            if (!is_null($discount->capacity_per_user)) {
                $users = $discount->users;
                $counts = array_count_values($users);
                if ($discount->capacity_per_user <= $counts[auth()->user()->id]) {
                    return session()->flash('error', 'ظرفیت کد تخفیف برای شما تمام شده است!');
                }
            }

            $this->discount_percent = $discount->discount;
            $this->discount = $discount->id;
            return session()->flash('success', $discount->discount . '% تخفیف بر روی اشتراک ها اعمال شد');
        }

        return session()->flash('error', 'کد تخفیف وارد شده معتبر نیست!');
    }

    public function page_updated()
    {
        if ($this->last_page > $this->current_page){
            $this->enable_next = true;
        }else{
            $this->enable_next = false;
        }
        if ($this->current_page > 1) {
            $this->enable_prev = true;
        }else{
            $this->enable_prev = false;
        }
    }

    public function prev()
    {
        if ($this->current_page > 1) {
            $this->current_page--;
        }
    }

    public function next()
    {
        if ($this->current_page < $this->last_page) {
            $this->current_page++;
        }
    }

    public function render()
    {
        $response = Http::post(env('LICENCE_SERVER_URL') . 'user/subscribes?page=' . $this->current_page, [
            'count' => $this->count,
            'user_id' => auth()->user()->id,
            'api_token' => env('LICENCE_SERVER_API_TOKEN')
        ]);


        if ($response->failed()) {
            abort(500, "خطا، سیستم قادر به دریافت اطلاعات از سرور لایسنس نیست");
        }

        $subscribes = $response['subscribes'];
        $this->last_page = $subscribes['last_page'];

        $this->page_updated();

        $plans = \App\Models\Subscribe::all();
        return view('livewire.site.profile.subscribe', [
            'plans' => $plans,
            'subscribes' => $subscribes['data'],
            'last_page' => $subscribes['last_page'],
            'current_page' => $this->current_page
        ])->layout('layouts.profile');
    }
}
