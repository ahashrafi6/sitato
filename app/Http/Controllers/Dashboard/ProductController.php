<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\MyFile;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $zones = Zone::all();
        $categories = Category::all();
        $tags = Tag::all();

        return view('dashboard.products.create' , compact('zones' , 'categories' , 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $this->validate($request , [
            'fa_title' => 'required|string',
            'fa_display' => 'required|string',
            'en_title' => 'required|string|unique:products,en_title',
            'en_display' => 'required|string',
            'author_id' => 'required|numeric',
            'zone_id' => 'required|numeric',
            'categories' => 'required',
            'tags' => 'nullable',
            'badges' => 'required',
            'services' => 'nullable',
            'description' => 'required',
            'body' => 'required',
            'demo' => 'nullable',
            'status' => 'required',
            'isSpecial' => 'required',
            'access' => 'required',
            'isOff' => 'required',
            'version' => 'required',
            'income_percent' => 'required|numeric',
            'price' => 'required|numeric',
            'offPrice' => 'nullable|numeric',
            'icon' => ' required|mimes:png,jpg,jpeg',
            'cover' => 'required|mimes:png,jpg,jpeg',
            'cover2' => 'required|mimes:png,jpg,jpeg',
        ]);

        unset($data['icon']);
        unset($data['cover']);
        unset($data['cover2']);
        unset($data['categories']);
        unset($data['tags']);

        $icon = MyFile::FtpUpload($request->file('icon'), 'images/products');
        $cover = MyFile::FtpUpload($request->file('cover'), 'images/products');
        $cover2 = MyFile::FtpUpload($request->file('cover2'), 'images/products');


        if ($request->expire_at) {
            $expire = Carbon::createFromTimestamp($request->expire_at / 1000)->toDateTimeString();
        } else {
            $expire = null;
        }

        $product = Product::create(array_merge($data , ['user_id' => auth()->user()->id, 'icon' => $icon, 'cover' => $cover, 'cover2' => $cover2 , 'expire_at' => $expire]));

        $product->categories()->sync($request->categories);

        if ($request->tags){
            $product->tags()->sync($request->tags);
        }

        return redirect(route('products.index'))->with([
            'success' => 'محصول جدید با موفقت ایجاد شد'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $zones = Zone::all();
        $categories = Category::all();
        $tags = Tag::all();

        return view('dashboard.products.edit' , compact('zones' , 'categories' , 'tags' , 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Product $product)
    {
        $data = $this->validate($request , [
            'fa_title' => 'required|string',
            'fa_display' => 'required|string',
            'en_title' => 'nullable|string|unique:products,en_title',
            'en_display' => 'required|string',
            'zone_id' => 'required|numeric',
            'categories' => 'required',
            'tags' => 'nullable',
            'badges' => 'required',
            'services' => 'nullable',
            'description' => 'required',
            'body' => 'required',
            'demo' => 'nullable',
            'status' => 'required',
            'isSpecial' => 'required',
            'access' => 'required',
            'isOff' => 'required',
            'version' => 'required',
            'income_percent' => 'required|numeric',
            'price' => 'required|numeric',
            'offPrice' => 'nullable|numeric',
            'icon' => ' nullable|mimes:png,jpg,jpeg',
            'cover' => 'nullable|mimes:png,jpg,jpeg',
            'cover2' => 'nullable|mimes:png,jpg,jpeg',
        ]);
        unset($data['icon']);
        unset($data['cover']);
        unset($data['cover2']);
        unset($data['categories']);
        unset($data['tags']);

        $en_title = $product->en_title;
        if ($data['en_title']){
            $en_title = $data['en_title'];
        }

        $icon = $product->icon; $cover = $product->cover; $cover2 = $product->cover2;
        if ($request->file('icon')){
            $icon = MyFile::FtpUpload($request->file('icon'), 'images/products');
        }
        if ($request->file('cover')){
            $cover = MyFile::FtpUpload($request->file('cover'), 'images/products');
        }
        if ($request->file('cover2')){
            $cover2 = MyFile::FtpUpload($request->file('cover2'), 'images/products');
        }

        if ($request->expire_at) {
            $expire = Carbon::createFromTimestamp($request->expire_at / 1000)->toDateTimeString();
        } else {
            $expire = null;
        }

        $product->update(array_merge($data , ['en_title' => $en_title, 'icon' => $icon, 'cover' => $cover, 'cover2' => $cover2 , 'expire_at' => $expire]));

        $product->categories()->sync($request->categories);

        if ($request->tags){
            $product->tags()->sync($request->tags);
        }

        return redirect(route('products.index'))->with([
            'success' => 'محصول با موفقت آپدیت شد'
        ]);
    }

    public function amazing(Product $product)
    {
        return view('dashboard.products.amazing' , compact('product'));
    }

    public function amazing_store(Request $request, Product $product)
    {
        $inputs = $this->validate($request, [
            'status' => 'required',
            'price' => 'required_if:status,==,1',
            'start_at' => 'required_if:status,==,1',
            'expire_at' => 'required_if:status,==,1',
            'capacity' => 'required',
        ]);


        $product->update([
            'isOff' => $inputs['status'],
            'offPrice' => $inputs['price'],
            'start_at' => $inputs['start_at'],
            'expire_at' => $inputs['expire_at'],
            'capacity' => $inputs['capacity'],
        ]);

        return response([
            'operator' => true,
        ]);
    }

}
