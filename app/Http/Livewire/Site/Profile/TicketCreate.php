<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Factor;
use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\Project as ModelsProject;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as Paymenter;

class TicketCreate extends Component
{
    public $department;
    public $type;
    public $title;
    public $body;
    public $licence;
    public $product;
    public $username;
    public $licence_select;
    public $files = [];
    public $bought_products;
    //  public $author_products;

    public $search_products_status = false;
    public $bought_products_status = false;
    public $supportModal = false;
    public $domainModal = false;

    protected $listeners = ['urlAdded'];

    public function mount()
    {
        $this->init();
    }

    public function init()
    {
        $user = auth()->user();

        $this->bought_products = $user->projects()->with(['product', 'plan'])->get();
    }

    public function updatedType()
    {
       /*  if ($this->type == 'subwp-download') {
            $this->search_products_status = true;
        } else {
            $this->search_products_status = false;
        } */
        if (
            $this->type == 'product-help' || $this->type == 'product-install'
            || $this->type == 'product-customize' || $this->type == 'product-update' || $this->type == 'subwp-back'
        ) {
            $this->bought_products_status = true;
        } else {
            $this->bought_products_status = false;
        }
        /*     if ($this->type == 'author-product') {
            $this->author_products_status = true;
        } else {
            $this->author_products_status = false;
        } */
    }

    public function updatedLicence()
    {
        if (
            $this->type == 'product-help' || $this->type == 'product-install'
            || $this->type == 'product-customize' || $this->type == 'product-update' || $this->type == 'subwp-back'
        ) {
            foreach ($this->bought_products as $item) {
                if ($item->id == $this->licence && is_null($item->username)) {
                    //check username
                    $this->licence_select = $item;
                    $this->licence = '';
                    $this->username = '';
                    $this->domainModal = true;
                } elseif ($item->id == $this->licence && $item->support_at < now()) {
                    //check support
                    $this->licence_select = $item;
                    $this->licence = '';
                    $this->supportModal = true;
                } elseif ($item->id == $this->licence) {
                    $this->licence_select = $item;
                }
            }
        }
    }

    public function support($project_id)
    {
        $project = ModelsProject::find($project_id);
        $plan = $project->plan;

        $price = $plan->price * 15 / 100;
        
        $user = auth()->user();

        $factor = Factor::create([
            'user_id' => $user->id,
            'final_price' => round($price),
            'type' => 'support',
            'items' => [
                'support' => [
                    'month' => $plan->support,
                ],
                'project_id' => $project->id
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

        $this->emit('fail-alert');
    }

    public function Username($project_id)
    {
        $this->validate([
            'username' => 'required',
        ]);


        // set username
        ModelsProject::find($project_id)->update(['username' => $this->username]);

        // auto deploy to liara and install status
        


        $this->username = '';
        $this->init();
        $this->emit('success-alert');
        $this->domainModal = false;
    }

    public function urlAdded($url, $name)
    {
        $this->files[] = [
            'name' => $name,
            'url' => $url,
        ];
    }

    public function removeFile($key)
    {
        unset($this->files[$key]);
    }

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function save()
    {
        $data = $this->validate([
            'department' => 'required',
            'type' => 'required',
            'title' => 'required|string|min:6',
            'body' => 'required|min:10',
            'files' => 'nullable',
            //'product' => 'required_if:type,==,subwp-download',
            'licence' => 'required_if:type,==,product-help,product-install,product-customize,product-update,subwp-back',
        ]);

        $user = auth()->user();

        $expire_at = null;
 /*        if ($this->licence_select['quick_support']) {
            $expire_at = get_ticket_expire_at();
        } */

        $ticket = $user->tickets()->create([
            'title' => $data['title'],
            'department' => $data['department'],
            'type' => $data['type'],
            'project_id' => $data['licence'],
          //  'product_id' => $data['product'] ? $data['product'] : ($this->licence_select['id'] != '' ? $this->licence_select['id'] : null),
            'expire_at' => $expire_at,
        ]);

        $ticket->replies()->create([
            'user_id' => $user->id,
            'body' => $data['body'],
            'files' => $data['files'] ? $data['files'] : null,
        ]);


        session()->flash('success', 'تیکت شما با موفقیت ثبت شد');
        return redirect()->route('tickets');
    }

    public function render()
    {
        return view('livewire.site.profile.ticket-create')->layout('layouts.profile');
    }
}
