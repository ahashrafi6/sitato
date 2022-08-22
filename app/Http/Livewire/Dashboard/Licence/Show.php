<?php

namespace App\Http\Livewire\Dashboard\Licence;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Show extends Component
{
    public function render()
    {
        $response = Http::post(env('LICENCE_SERVER_URL') . 'dashboard/licence', [
            'id' => request('licence'),
            'api_token' => env('LICENCE_SERVER_API_TOKEN')
        ]);

        if ($response->failed()){
            dd('خطا، سیستم قادر به دریافت اطلاعات از سرور لایسنس نیست');
        }

        $licence = $response['licence'][0];
        $user = User::find($licence['user_id']);
        $product = Product::find($licence['product_id']);

        $factor = Http::post(env('PAY_SERVER_URL') . 'dashboard/factor', [
            'id' => $licence['factor_id'],
            'api_token' => env('PAY_SERVER_API_TOKEN')
        ]);
        if ($factor->failed()){
            dd('خطا، سیستم قادر به دریافت اطلاعات از سرور پرداخت نیست');
        }


        return view('livewire.dashboard.licence.show' , [
            'licence' => $licence,
            'user' => $user,
            'product' => $product,
            'factor' => $factor['factor'][0],
        ])->extends('dashboard.master');
    }
}
