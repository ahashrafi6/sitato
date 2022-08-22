<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Product;
use Livewire\Component;

class VersionCreate extends Component
{
    public Product $product;

    public $version;
    public $access;

    public $main_file = [];
    public $cash_file = [];
    public $subscribe_file = [];
    public $help_file = [];


    protected $listeners = ['mainfileAdded', 'cashfileAdded', 'subscribefileAdded', 'helpfileAdded'];

    public function mount()
    {
        $this->access = $this->product->access;
        $this->version = $this->product->version;
    }

    public function mainfileAdded($name, $key)
    {
        $this->main_file['name'] = $name;
        $this->main_file['key'] = $key;
    }

    public function cashfileAdded($name, $key)
    {
        $this->cash_file['name'] = $name;
        $this->cash_file['key'] = $key;
    }

    public function subscribefileAdded($name, $key)
    {
        $this->subscribe_file['name'] = $name;
        $this->subscribe_file['key'] = $key;
    }

    public function helpfileAdded($name, $key)
    {
        $this->help_file['name'] = $name;
        $this->help_file['key'] = $key;
    }


    public function send()
    {
        $this->validate([
            'version' => 'required',
            'access' => 'required|in:cash,subscribe,full',
            'main_file' => 'required',
            'cash_file' => 'required',
            //'cash_file' => 'required_if:access,==,cash,full',
            //'subscribe_file' => 'required_if:access,==,subscribe,full',
            'help_file' => 'required',
        ]);

        $files = [
            'main_file' => $this->main_file ?? null,
            'cash_file' => $this->cash_file ?? null,
           // 'subscribe_file' => $this->subscribe_file ?? null,
            'help_file' => $this->help_file ?? null,
        ];


        $this->product->versions()->create([
            'version' => $this->version,
            'access' => $this->access,
            'files' => $files,
        ]);

        session()->flash('success', 'بروزرسانی با موفقیت ارسال شد');
        return redirect()->route('profile.versions');

    }

    public function render()
    {
        return view('livewire.site.profile.version-create')->layout('layouts.profile');
    }
}
