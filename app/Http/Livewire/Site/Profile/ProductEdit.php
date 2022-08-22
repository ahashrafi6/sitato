<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Category;
use App\Models\Product;
use App\Rules\WordCount;
use Livewire\Component;

class ProductEdit extends Component
{
    public Product $product;

    public $categories;

    public $fa_title;
    public $en_title;
    public $category;
    public $body;
    public $demo;
    public $version;
    public $price;

    public $icon;
    public $mini_cover;
    public $cover;
    public $cover2;

    public $access = 'cash';

    public $main_file = [];
    public $cash_file = [];
    public $subscribe_file = [];
    public $help_file = [];

    public $publish = false;

    protected $listeners = ['iconAdded' , 'minicoverAdded', 'coverAdded', 'cover2Added', 'mainfileAdded', 'cashfileAdded', 'subscribefileAdded', 'helpfileAdded'];


    public function mount()
    {
        if ($this->product->status != 'draft'){
            abort(404);
        }

        $this->categories = Category::whereNull('parent_id')->get();

        $this->fa_title = $this->product->fa_title;
        $this->en_title = $this->product->en_title;
        $this->category = $this->product->categories[0]['id'];
        $this->body = $this->product->body;
        $this->demo = $this->product->demo;
        $this->version = $this->product->version;
        $this->price = $this->product->price;
        $this->access = $this->product->access;
        $this->icon = $this->product->icon;
        $this->cover = $this->product->cover;
        $this->cover2 = $this->product->cover2;
        $this->mini_cover = $this->product->mini_cover;
        $this->main_file = $this->product->files['main_file'];
        $this->cash_file = $this->product->files['cash_file'];
        $this->subscribe_file = $this->product->files['subscribe_file'];
        $this->help_file = $this->product->files['help_file'];
    }

    public function mainfileAdded($name , $key)
    {
        $this->main_file['name'] = $name;
        $this->main_file['key'] = $key;
    }

    public function cashfileAdded($name , $key)
    {
        $this->cash_file['name'] = $name;
        $this->cash_file['key'] = $key;
    }

    public function subscribefileAdded($name , $key)
    {
        $this->subscribe_file['name'] = $name;
        $this->subscribe_file['key'] = $key;
    }

    public function helpfileAdded($name , $key)
    {
        $this->help_file['name'] = $name;
        $this->help_file['key'] = $key;
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
        if ($this->publish) {
            $this->validate([
                'fa_title' => 'required|string',
                'en_title' => 'required|string|unique:products,en_title,' . $this->product->id,
                'category' => 'required',
               // 'body' => [new WordCount(400)],
                'demo' => 'required',
                'version' => 'required',
                'price' => 'required',
                'access' => 'required|in:cash,subscribe,full',
                'icon' => 'required',
                'mini_cover' => 'required',
                'cover' => 'required',
                'cover2' => 'required',
                'main_file' => 'required',
                'cash_file' => 'required',
                //'cash_file' => 'required_if:access,==,cash,full',
                //'subscribe_file' => 'required_if:access,==,subscribe,full',
                'help_file' => 'required',
            ]);
        } else {
            $this->validate([
                'fa_title' => 'required|string',
                'en_title' => 'required|string|unique:products,en_title,' . $this->product->id,
                'price' => 'required',
                'category' => 'required',
            ]);
        }

        $files = [
            'main_file' => $this->main_file ?? null,
            'cash_file' => $this->cash_file ?? null,
            'subscribe_file' => $this->subscribe_file ?? null,
            'help_file' => $this->help_file ?? null,
        ];

        $this->product->update([
            'fa_title' => $this->fa_title,
            'en_title' => $this->en_title,
            'body' => $this->body,
            'demo' => $this->demo,
            'version' => $this->version,
            'price' => $this->price,
            'access' => $this->access,
            'icon' => $this->icon,
            'cover' => $this->cover,
            'cover2' => $this->cover2,
            'mini_cover' => $this->mini_cover,
            'files' => $files,
            'status' => $this->publish ? 'pending' : 'draft',
        ]);

        $this->product->categories()->sync($this->category);

        session()->flash('success', 'محصول شما با موفقیت ویرایش شد');
        return redirect()->route('profile.products');

    }

    public function render()
    {
        return view('livewire.site.profile.product-edit')->layout('layouts.profile');
    }
}
