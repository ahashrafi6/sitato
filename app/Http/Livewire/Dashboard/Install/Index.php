<?php

namespace App\Http\Livewire\Dashboard\Install;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{
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
        $response = Http::post(env('LICENCE_SERVER_URL') . 'dashboard/installs?page=' . $this->current_page, [
            'status' => $this->status,
            'api_token' => env('LICENCE_SERVER_API_TOKEN')
        ]);

        if ($response->failed()){
            dd('خطا، سیستم قادر به دریافت اطلاعات از سرور پرداخت نیست');
        }

        $installs = $response['installs'];
        $this->last_page = $installs['last_page'];

        return view('livewire.dashboard.install.index' , [
            'installs' => $installs['data'],
            'last_page' => $installs['last_page'],
            'current_page' => $this->current_page
        ])->extends('dashboard.master');
    }
}
