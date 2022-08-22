<?php

namespace App\Http\Livewire\Site;

use App\Http\Livewire\Site\Profile\Order;
use App\Models\Discount;
use App\Models\Factor;
use App\Models\Plan;
use Livewire\Component;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as Paymenter;


class Cart extends Component
{
    public $wallet = 0;
    public $using_wallet = false;

    public $discount_code;

    public function mount()
    {
        
    }

    // discount handle
    protected $rules = [
        'discount_code' => 'required|exists:discounts,code',
    ];

    public function deleteDiscount()
    {
        session()->put('cart.total.discount', 0);
        session()->put('cart.discounts', []);
    }

    public function productsExist($type, $products = [])
    {
        $exist = [
            'status' => false,
            'products' => [],
        ];
        if ($type == 'products') {
            $array = [];
            foreach ($products as $product) {
                if (session()->has("cart.items.{$product}")) {
                    $array[] = $product;
                    $exist = [
                        'status' => true,
                        'products' => $array,
                    ];
                }
            }
        } else {
            $exist = [
                'status' => true,
                'products' => [],
            ];
        }

        return $exist;
    }

    public function applyDiscount()
    {
    
        $this->validate();

        $discount = \App\Models\Discount::where('code', $this->discount_code)->whereType('cash')->first();

        //check exist
        if (!$discount) {
            return session()->flash('error', 'کد تخفیف وارد شده، معتبر نیست.');
        }

        // check discount exist on cart session
        foreach (session()->get("cart.discounts") as $item) {
            if ($item['id'] == $discount->id) {
                return session()->flash('error', 'این کد تخفیف از قبل اعمال شده است!');
            }
        }


        // check date range
        if (!is_null($discount->start_at) && !is_null($discount->expire_at)) {
            if ($discount->start_at > now()->toDateTimeString()) {
                return session()->flash('error', 'زمان استفاده از این تخفیف هنوز فرا نرسیده است!');
            }
            if ($discount->expire_at < now()->toDateTimeString()) {
                return session()->flash('error', 'زمان استفاده از این تخفیف تمام شده است!');
            }
        }

        // check products
        if (!is_null($discount->products)) {
            $product_exist = $this->productsExist('products', $discount->products);
        } else {
            $product_exist = $this->productsExist('all');
        }
        if (!$product_exist['status']) {
            return session()->flash('error', 'محصول مرتبط با کد تخفیف در سبد خرید شما وجود ندارد!');
        }


        // check capacity
        if (!is_null($discount->capacity) && ($discount->capacity - $discount->consumed) <= 0) {
            return session()->flash('error', 'ظرفیت کد تخفیف تمام شده است!');
        }

        // check per user
        if (!is_null($discount->capacity_per_user)) {
            $users = $discount->users;
            if ($users) {
                $counts = array_count_values($users);
                if ($discount->capacity_per_user <= $counts[auth()->user()->id]) {
                    return session()->flash('error', 'ظرفیت کد تخفیف برای شما تمام شده است!');
                }
            }
        }


        $apply = false;
        if ($product_exist['products']) {
            foreach ($product_exist['products'] as $product) {
                session()->put("cart.discounts.{$product}", [
                    'id' => $discount->id,
                    'product_id' => $product,
                    'title' => $discount->title,
                    'code' => $discount->code,
                    'discount' => $discount->discount,
                    'price' => (session()->get("cart.products.{$product}.price") * $discount->discount) / 100,
                ]);
                $apply = true;
            }
        } else {
            $products = session()->get('cart.items');
            foreach ($products as $product) {
                session()->put("cart.discounts.{$product['plan_id']}", [
                    'id' => $discount->id,
                    'product_id' => $product['plan_id'],
                    'title' => $discount->title,
                    'code' => $discount->code,
                    'discount' => $discount->discount,
                    'price' => (session()->get("cart.items.{$product['plan_id']}.price") * $discount->discount) / 100,
                ]);
                $apply = true;
            }
        }

        if ($apply) {
            Order::calculateTotals();
            $this->discount_code = '';
            return session()->flash('success', $discount->discount . '% تخفیف برای محصول یا محصولات خود دریافت کردید');
        }

        return session()->flash('error', 'امکان استفاده چند کد تخفیف مرتبط به یک محصول وجود ندارد!');
    }

    public function check_before_pay()
    {
        $cart = session()->get('cart');
        $now = now();
        foreach ($cart['discounts'] as $item) {
            if ($item['code'] != 'amazing' && $item['code'] != 'bundle') {
                $discount = Discount::find($item['id']);
                if ($discount) {
                    // check date range
                    if (!is_null($discount->expire_at)) {
                        if ($discount->expire_at < $now->toDateTimeString()) {
                            $id = $item['plan_id'];
                            session()->forget("cart.discounts.$id");
                        }
                    }


                    // check capacity
                    if (!is_null($discount->capacity) && ($discount->capacity - $discount->consumed) <= 0) {
                        $id = $item['plan_id'];
                        session()->forget("cart.discounts.$id");
                    }
                } else {
                    $id = $item['plan_id'];
                    session()->forget("cart.discounts.$id");
                }
            } else {
                if ($item['code'] == 'amazing') {
                    $product = Plan::find($item['plan_id']);

                    // check date range
                    if (!is_null($product->expire_at)) {
                        if ($product->expire_at < $now->toDateTimeString()) {
                            session()->forget("cart.discounts.$product->id");
                        }
                    }
    
                    // check capacity
                    if (!is_null($product->capacity) && ($product->capacity - $product->consumed) <= 0) {
                        session()->forget("cart.discounts.$product->id");
                    }
                }
            }
        }

        Order::calculateTotals();
        return true;
    }


    public function createFactor()
    {
        if ($this->check_before_pay()) {
            $cart = session()->get('cart');

            $user = auth()->user();
            $obj = cart_obj($cart['total']['price']);

            $factor = Factor::create([
                'user_id' => $user->id,
                'price' => $cart['total']['price'],
                'final_price' => $obj['total_price'],
                'discount' => [
                    'price' => $cart['discounts'] ? $cart['total']['discount'] : 0,
                    'items' => $cart['discounts'] ?? null,
                ],
                'items' => $cart['items'],
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
    }

    public function cartClear()
    {
        session()->forget('cart');
    }

    public function delete($id)
    {
        session()->forget("cart.items.$id");
        session()->forget("cart.discounts.$id");
        Order::calculateTotals();
    }


    public function render()
    {
        $products = session()->get('cart.items');
        $discount = session()->get('cart.total.discount');

         $obj = 0;
        if (session()->has('cart')) {
            $obj = cart_obj(session()->get('cart.total.price'));
        } 

        return view('livewire.site.cart', ['products' => $products,'obj' => $obj , 'discount' => $discount,])->layout('layouts.cart');
    }
}
