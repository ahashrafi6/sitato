<?php

namespace App\Http\Livewire\Site\Profile;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Affiliate extends Component
{
    public $type = 'link';
    public $user;
    public $verified = false;
    public $meta;

    public $data = [
        'total_affiliate' => 0,
        'current_affiliate' => 0,
        'day_affiliate_count' => 0,
        'day_affiliate_price' => 0,
        'lists' => null
    ];

    protected $queryString = ['type'];


    public function mount()
    {
        $this->check();
    }


    public function check()
    {
        $user = auth()->user();
        $this->user = $user;
        if ($user->isAff()) {
            $this->verified = true;

            // get affiliates lists
            $response = Http::post(env('PAY_SERVER_URL') . 'user/affiliates', [
                'user_id' => auth()->user()->id,
                'api_token' => env('PAY_SERVER_API_TOKEN')
            ]);
            if ($response->failed()) {
                abort(500, "خطا، سیستم قادر به دریافت اطلاعات از سرور پرداخت نیست");
            }
            $this->data = $response['data'];
        }
    }


    public function affiliate_verified()
    {
        auth()->user()->makeUniqueAffid();
        $this->emit('success-alert');
        $this->check();
    }

    public function render()
    {
        return view('livewire.site.profile.affiliate')->layout('layouts.profile');
    }
}
