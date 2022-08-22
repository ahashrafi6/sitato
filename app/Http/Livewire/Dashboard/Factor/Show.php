<?php

namespace App\Http\Livewire\Dashboard\Factor;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Show extends Component
{
    public function render()
    {
        $response = Http::post(env('PAY_SERVER_URL') . 'dashboard/factor', [
            'id' => request('factor'),
            'api_token' => env('PAY_SERVER_API_TOKEN')
        ]);


        if ($response->failed()){
            dd('خطا، سیستم قادر به دریافت اطلاعات از سرور پرداخت نیست');
        }

        $factor = $response['factor'][0];
        $user = User::find($factor['user_id']);

        return view('livewire.dashboard.factor.show' , [
            'factor' => $factor,
            'user' => $user
        ])->extends('dashboard.master');
    }
}
