<?php

namespace App\Http\Livewire\Site\Profile\Project;

use App\Models\Factor;
use App\Models\Server as ModelsServer;
use Carbon\Carbon;
use Livewire\Component;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as Paymenter;

class Server extends Component
{
    public $project;
    public $servers;

    public $per = [
        '1' => 'ماهانه',
        '3' => '۳ ماهه',
        // '12' => 'سالانه',
    ];
    public $plan_select;
    public $per_select;

    public $wallet;

    public function mount()
    {
        $this->getServers();
        $this->per_select = $this->project->month;

        $this->wallet = (now()->diffInDays($this->project->payment_end) - 1) * (($this->project->server->price * $this->project->month) / (Carbon::create($this->project->payment_start)->diffInDays($this->project->payment_end) -1 ));
    }


    public function getServers()
    {
        $this->servers = ModelsServer::where('id' , '!=' , $this->project->server_id)->where('price' , '>' , $this->project->server->price)->get();
    }

    public function Upgrade($server_id){

        $server = $this->servers->find($server_id);
        $price = ($server->price * (int)$this->per_select) - $this->wallet;

        $user = auth()->user();

        $factor = Factor::create([
            'user_id' => $user->id,
            'final_price' => round($price),
            'type' => 'server',
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
        return view('livewire.site.profile.project.server')->layout('layouts.profile');
    }
}
