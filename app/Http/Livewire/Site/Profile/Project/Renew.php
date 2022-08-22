<?php

namespace App\Http\Livewire\Site\Profile\Project;

use App\Models\Factor;
use Livewire\Component;
use App\Models\Server;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as Paymenter;

class Renew extends Component
{
    public $project;

    public $servers;

    public $per = [
        '1' => 'ماهانه',
        '3' => '۳ ماهه',
        // '12' => 'سالانه',
    ];
    public $plan_select;
    public $per_select = 1;


    public $renewModal = false;

    protected function rules()
    {
        return [
            'domain' => 'required',
        ];
    }

    public function mount()
    {
        $this->servers = Server::all();
    }

    public function Renew($server_id)
    {
        $server = $this->servers->find($server_id);
        $price = ($server->price * (int)$this->per_select);

        $user = auth()->user();

        $factor = Factor::create([
            'user_id' => $user->id,
            'final_price' => round($price),
            'type' => 'renew',
            'items' => [
                'server' => $server,
                'project_id' => $this->project->id,
                'month' => (int)$this->per_select,
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
        return view('livewire.site.profile.project.renew')->layout('layouts.profile');
    }
}
