<?php

namespace App\Http\Livewire\Site\Profile;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Transaction extends Component
{
    public $count = 10;

    public $current_page = 1;
    public $last_page;
    public $enable_prev;
    public $enable_next;


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
        $response = Http::post(env('PAY_SERVER_URL') . 'user/transactions?page=' . $this->current_page, [
            'count' => $this->count,
            'type' => 'author',
            'user_id' => auth()->user()->id,
            'api_token' => env('PAY_SERVER_API_TOKEN')
        ]);


        if ($response->failed()) {
            abort(500, "خطا، سیستم قادر به دریافت اطلاعات از سرور پرداخت نیست");
        }

        $transactions = $response['transactions'];
        $this->last_page = $transactions['last_page'];

        $this->page_updated();

        return view('livewire.site.profile.transaction', [
            'transactions' => $transactions['data'],
            'last_page' => $transactions['last_page'],
            'current_page' => $this->current_page
        ])->layout('layouts.profile');
    }
}
