<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Product;
use Livewire\Component;

class DetailCreate extends Component
{
    public Product $product;

    public $demo;

    public $icon;
    public $mini_cover;
    public $cover;
    public $cover2;

    protected $listeners = ['iconAdded', 'minicoverAdded', 'coverAdded', 'cover2Added'];

    public function mount()
    {
        $this->demo = $this->product->demo;
        $this->icon = $this->product->icon;
        $this->mini_cover = $this->product->mini_cover;
        $this->cover = $this->product->cover;
        $this->cover2 = $this->product->cover2;
    }

    public function iconAdded($url)
    {
        $this->icon = $url;
    }

    public function minicoverAdded($url)
    {
        $this->mini_cover = $url;
    }

    public function coverAdded($url)
    {
        $this->cover = $url;
    }

    public function cover2Added($url)
    {
        $this->cover2 = $url;
    }

    public function send()
    {
        $this->validate([
            'demo' => 'required',
            'icon' => 'required',
            'mini_cover' => 'required',
            'cover' => 'required',
            'cover2' => 'required',
        ]);

        $this->product->details()->create([
            'demo' => $this->demo,
            'icon' => $this->icon,
            'cover' => $this->cover,
            'cover2' => $this->cover2,
            'mini_cover' => $this->mini_cover,

        ]);

        session()->flash('success', 'درخواست بروزرسانی با موفقیت ثبت شد');
        return redirect()->route('profile.details');
    }

    public function render()
    {
        return view('livewire.site.profile.detail-create')->layout('layouts.profile');
    }
}
