<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;

class Seller extends Component
{
    public $email;
    public $phone;
    public $name;
    public $family;
    public $phone_verified_at;

    public $author_name;
    public $author_slug;

    public $card_name;
    public $card_meli;
    public $bank_name;
    public $card_number;
    public $card_sheba;
    public $card_serial;

    public $files = [];
    public $seller;

    protected $listeners = ['urlAdded'];

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

    public function mount()
    {
        $this->getUser();
    }

    public function getUser()
    {
        $user = auth()->user();
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->name = $user->name;
        $this->family = $user->family;
        $this->phone_verified_at = $user->phone_verified_at;


        $seller = $user->sellers()->latest()->first();
        if ($seller) {
            if ($seller->status != 'verified') {
                $this->seller = $seller;
            }
        }
    }

    public function send()
    {
        $data = $this->validate([
            'name' => 'required|string',
            'family' => 'required|string',
            'author_name' => 'required|string',
            'author_slug' => 'required|string|unique:users,author_slug',
            'card_name' => 'required|string',
            'card_meli' => 'required|digits:10',
            'bank_name' => 'required|string',
            'card_serial' => 'required',
            'card_number' => 'required|digits:16',
            'card_sheba' => 'required|digits:24',
            'files' => 'required',
        ]);

        auth()->user()->sellers()->create([
           'name' => $data['name'] ,
           'family' => $data['family'] ,
           'author_name' => $data['author_name'] ,
           'author_slug' => $data['author_slug'] ,
           'files' => $data['files'] ,
        ]);
        auth()->user()->cards()->create([
            'title' => 'حساب اصلی',
            'card_name' => $data['card_name'],
            'card_meli' => $data['card_meli'],
            'bank_name' => $data['bank_name'],
            'card_serial' => $data['card_serial'],
            'card_number' => $data['card_number'],
            'card_sheba' => $data['card_sheba'],
        ]);


        $this->emit('success-alert');
        $this->getUser();
    }

    public function render()
    {
        return view('livewire.site.profile.seller')->layout('layouts.profile');
    }
}
