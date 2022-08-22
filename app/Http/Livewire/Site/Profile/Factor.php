<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Project;
use Livewire\Component;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as Paymenter;

class Factor extends Component
{
    public \App\Models\Factor $factor;

    public $project;

    public function mount(){
        if($this->factor->type != 'server' || $this->factor->status){
            abort(404);
        }

        $this->project = Project::find($this->factor->items['project_id']);
    }


    public function Pay(){
        $factor = $this->factor;
        $user = $this->factor->user;

        if($factor->status){
            return;
        }

        $invoice = (new Invoice)->amount($factor->final_price)
        ->detail([
            'description' => 'پرداخت فاکتور',
            'email' => $user->email,
            'mobile' => $user->phone,
        ]);
  

    $json = Paymenter::callbackUrl(url('/payments/verify'))
        //->via('idpay')
        ->purchase(
            $invoice,
            function ($driver, $transactionId) use ($factor) {
                session()->put('zarinpal.payments.transaction_id', $transactionId);
                session()->put('zarinpal.payments.factor_id', $factor->id);
            }
        )->pay()->toJson();
        return redirect(json_decode($json)->action);

    }

    public function render()
    {
        return view('livewire.site.profile.factor')->layout('layouts.factor');
    }
}
