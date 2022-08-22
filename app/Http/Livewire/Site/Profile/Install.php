<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Product;
use App\Traits\Site\LicenceApi;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Install extends Component
{
    public $count = 10;

    public $current_page = 1;
    public $last_page;
    public $enable_prev;
    public $enable_next;

    public $status = 'all';
    public $user;
    public $ids;
    public $isAuthor = false;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $this->user = auth()->user();
        $this->isAuthor = $this->user->isAuthor();
        $this->ids = $this->user->products()->pluck('id');
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

    public function completed($install_id ,$factor_id , $product_id)
    {
        if ($this->user->id == Product::find($product_id)->author_id){
            $response = Http::post(env('PAY_SERVER_URL') . 'user/installs/completed', [
                'install_id' => $install_id,
                'factor_id' => $factor_id,
                'product_id' => $product_id,
                'api_token' => env('PAY_SERVER_API_TOKEN')
            ]);


            if ($response->successful()) {
                $this->emit('success-alert');
                $this->emit('refreshComponent');
            }
        }
    }

    public function render()
    {
        $response = Http::post(env('LICENCE_SERVER_URL') . 'user/installs?page=' . $this->current_page, [
            'count' => $this->count,
            'type' => $this->isAuthor ? 'author' : 'user',
            'status' => $this->status,
            'id' => $this->isAuthor ? $this->ids : $this->user->id,
            'api_token' => env('LICENCE_SERVER_API_TOKEN')
        ]);

        if ($response->failed()) {
            abort(500, "خطا، سیستم قادر به دریافت اطلاعات از سرور لایسنس نیست");
        }

        $installs = $response['installs'];
        $this->last_page = $installs['last_page'];

        $this->page_updated();

        return view('livewire.site.profile.install', [
            'installs' => $installs['data'],
            'last_page' => $installs['last_page'],
            'current_page' => $this->current_page
        ])->layout('layouts.profile');
    }
}
