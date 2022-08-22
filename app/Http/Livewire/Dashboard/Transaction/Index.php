<?php

namespace App\Http\Livewire\Dashboard\Transaction;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{
    public $type = 'all';
    public $source = 'all';

    public $current_page = 1;
    public $last_page;


    public function prev()
    {
        if ($this->current_page > 1){
            $this->current_page --;
        }
    }

    public function next()
    {
        if ($this->current_page < $this->last_page){
            $this->current_page ++;
        }
    }

    public function render()
    {
        $response = Http::post(env('PAY_SERVER_URL') . 'dashboard/transactions?page=' . $this->current_page, [
            'type' => $this->type,
            'cate' => $this->source,
            'api_token' => env('PAY_SERVER_API_TOKEN')
        ]);


        if ($response->failed()){
            dd('خطا، سیستم قادر به دریافت اطلاعات از سرور پرداخت نیست');
        }

        $transactions = $response['transactions'];
        $this->last_page = $transactions['last_page'];

        return view('livewire.dashboard.transaction.index' , [
            'transactions' => $transactions['data'],
            'last_page' => $transactions['last_page'],
            'current_page' => $this->current_page
        ])->extends('dashboard.master');
    }
}
