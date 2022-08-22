<?php

namespace App\Http\Livewire\Dashboard\Licence;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{
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
        $response = Http::post(env('LICENCE_SERVER_URL') . 'dashboard/licences?page=' . $this->current_page, [
            'type' => $this->type,
            'api_token' => env('LICENCE_SERVER_API_TOKEN')
        ]);


        if ($response->failed()){
            dd('خطا، سیستم قادر به دریافت اطلاعات از سرور لایسنس نیست');
        }

        $licences = $response['licences'];
        $this->last_page = $licences['last_page'];

        return view('livewire.dashboard.licence.index' , [
            'licences' => $licences['data'],
            'last_page' => $licences['last_page'],
            'current_page' => $this->current_page
        ])->extends('dashboard.master');
    }
}
