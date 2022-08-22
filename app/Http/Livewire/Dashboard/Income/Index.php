<?php

namespace App\Http\Livewire\Dashboard\Income;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{
    public $type = 'all';
    public $status = 'all';

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
        $response = Http::post(env('PAY_SERVER_URL') . 'dashboard/incomes?page=' . $this->current_page, [
            'type' => $this->type,
            'status' => $this->status,
            'api_token' => env('PAY_SERVER_API_TOKEN')
        ]);


        if ($response->failed()){
            dd('خطا، سیستم قادر به دریافت اطلاعات از سرور پرداخت نیست');
        }

        $incomes = $response['incomes'];
        $this->last_page = $incomes['last_page'];

        return view('livewire.dashboard.income.index' , [
            'incomes' => $incomes['data'],
            'last_page' => $incomes['last_page'],
            'current_page' => $this->current_page
        ])->extends('dashboard.master');
    }
}
