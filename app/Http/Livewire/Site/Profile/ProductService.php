<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Product;
use Livewire\Component;

class ProductService extends Component
{
    public Product $product;

    public $extend_support;
    public $quick_support;
    public $product_install;

    public function mount()
    {
        if ($this->product->access == 'subscribe'){
            abort(404);
        }

        $this->extend_support = $this->product->isService('extend_support');
        $this->quick_support = $this->product->isService('quick_support');
        $this->product_install = $this->product->isService('product_install');
    }


    public function active($type)
    {
        $services = $this->product->services;
        array_push($services , $type);

        $this->product->update([
            'services' => $services
        ]);
        $this->$type = true;
        $this->emit('success-alert');
    }

    public function disable($type)
    {
        $services = $this->product->services;
        array_splice($services, array_search(58, $services ), 1);

        $this->product->update([
            'services' => $services
        ]);
        $this->$type = false;
        $this->emit('success-alert');
    }

    public function render()
    {
        return view('livewire.site.profile.product-service')->layout('layouts.profile');
    }
}
