<?php

namespace App\Http\Livewire\Dashboard\Refund;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Show extends Component
{
    public $refund_id;
    public $status;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $this->refund_id = request('refund');
    }

    public function send()
    {
        $this->validate([
            'status' => 'required',
        ]);


        $response = Http::post(env('PAY_SERVER_URL') . 'dashboard/refund/manage', [
            'id' => $this->refund_id,
            'status' => $this->status,
            'api_token' => env('PAY_SERVER_API_TOKEN')
        ]);

        if ($response->successful()){
            $this->emit('refreshComponent');
        }
    }

    public function render()
    {
        $response = Http::post(env('PAY_SERVER_URL') . 'dashboard/refund', [
            'id' => $this->refund_id,
            'api_token' => env('PAY_SERVER_API_TOKEN')
        ]);


        if ($response->failed()){
            dd('خطا، سیستم قادر به دریافت اطلاعات از سرور پرداخت نیست');
        }


        $refund = $response['refund'];
        $user = User::find($refund['user_id']);

        $this->status = $refund['status'];
        $this->description = $refund['description'];

        return view('livewire.dashboard.refund.show' , [
            'refund' => $refund,
            'user' => $user
        ])->extends('dashboard.master');
    }
}
