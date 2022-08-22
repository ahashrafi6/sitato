<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Product;
use Livewire\Component;

class ProductLicense extends Component
{
    public Product $product;

    public function mount()
    {

    }


    public function render()
    {
        return view('livewire.site.profile.product-license')->layout('layouts.profile');
    }
}
