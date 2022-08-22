<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Plan;
use App\Models\Server;
use Livewire\Component;


class Order extends Component
{
    public $per = [
        '1' => 'ماهانه',
        '3' => '۳ ماهه',
        // '12' => 'سالانه',
    ];

    public $plans;
    public $servers;


    public $plan_select = 2;
    public $per_select = 1;
    public $server_select = 3;

    //public $username;
    /* 

    protected $rules = [
        'username' => 'required|unique:projects,username',
    ];
    

    public function updated($field)
    {
        $this->validateOnly($field);
    } */

    public function mount()
    {
        $this->servers = Server::all();
        $this->plans = Plan::all();
    }


    public function getPlanPrice()
    {
        $plan = $this->plans->find($this->plan_select);
        if ($plan->isOff()) {
            return $plan->offPrice;
        }

        return $plan->price;
    }

    public function getServerPrice()
    {
        return $this->servers->find($this->server_select)->price;
    }


    public function addToCart()
    {
        $this->initCart();

        if ($this->plan_select && $this->server_select) {
            $plan = $this->plans->find($this->plan_select);
            $server = $this->servers->find($this->server_select);

            // offPrice

            if ($plan->isOff()) {
                // add offprice same as discount
                $percent = get_discount_percent($plan->price, $plan->offPrice);

                session()->put("cart.discounts.{$plan->id}", [
                    'id' => 0,
                    'plan_id' => $plan->id,
                    'title' => 'شگفت انگیز',
                    'code' => 'amazing',
                    'discount' => $percent,
                    'price' => $plan->price - $plan->offPrice,
                ]);
            }


            // product
            if (!session()->has("cart.items.{$plan->id}")) {
                session()->put("cart.items.{$plan->id}", [
                    'product_id' => $plan->product_id,
                    'plan_id' => $plan->id,
                    'server_id' => $server->id,
                    'count' => 1,
                    'price' => $plan->price + ($server->price * $this->per_select),
                    'plan' => $plan,
                    'server' => $server,
                    'per' => $this->per_select
                    ]);
            }


            // Total Calculate
            self::calculateTotals();
        }

        return redirect(route('cart'));
    }


    public static function calculateTotals()
    {
        $items = collect(session('cart.items'));
        $discounts = collect(session('cart.discounts'));

        session()->put('cart.total', [
            'price' => $items->sum('price'),
            'count' => $items->sum('count'),
            'discount' => $discounts->sum('price'),
        ]);
    }

    public function initCart()
    {
        // Create First Cart Session
        if (!session()->has('cart')) {
            session()->put('cart', [
                'items' => [],
                'discounts' => [],
                'total' => [
                    'price' => 0,
                    'count' => 0,
                    'discount' => 0,
                ],
            ]);
        }
    }


    public function render()
    {

        return view('livewire.site.profile.order')->layout('layouts.profile');
    }
}
