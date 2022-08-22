<?php

namespace App\Http\Livewire\Site\Profile\Project;

use App\Models\Factor;
use Livewire\Component;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as Paymenter;

class Plan extends Component
{
    public $project;
    public $plans;

    public $plan_select;

    public function mount()
    {
        $this->getPlans();
    }

    public function getPlans()
    {
        $this->plans = $this->project->product->plans()->where('id' , '!=' , $this->project->plan_id)->where('price' , '>' , $this->project->plan->price)->get();
    }

    public function Upgrade($plan_id){
        $plan = $this->plans->find($plan_id);
        if($plan->isOff()){
            $price = $plan->offPrice - $this->project->plan->price;
        }else{
            $price = $plan->price - $this->project->plan->price;
        }
        
        $user = auth()->user();

        $factor = Factor::create([
            'user_id' => $user->id,
            'final_price' => round($price),
            'type' => 'plan',
            'items' => [
                'plan' => $plan,
                'project_id' => $this->project->id
            ],
        ]);

       
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
        return view('livewire.site.profile.project.plan')->layout('layouts.profile');
    }
}
