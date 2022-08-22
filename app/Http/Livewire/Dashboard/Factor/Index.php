<?php

namespace App\Http\Livewire\Dashboard\Factor;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{
    public $resNumber = '';
    public $type = 'all';

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
        $response = Http::post(env('PAY_SERVER_URL') . 'dashboard/factors?page=' . $this->current_page, [
            'resNumber' => $this->resNumber,
            'type' => $this->type,
            'api_token' => env('PAY_SERVER_API_TOKEN')
        ]);

        if ($response->failed()){
            dd('خطا، سیستم قادر به دریافت اطلاعات از سرور پرداخت نیست');
        }

        $factors = $response['factors'];
        $this->last_page = $factors['last_page'];

        return view('livewire.dashboard.factor.index' , [
            'factors' => $factors['data'],
            'last_page' => $factors['last_page'],
            'current_page' => $this->current_page
        ])->extends('dashboard.master');
    }
}
