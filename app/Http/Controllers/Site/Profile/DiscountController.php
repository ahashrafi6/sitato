<?php

namespace App\Http\Controllers\Site\Profile;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = auth()->user()->products;
        return view('site.profile.pages.discounts.create' , compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $this->validate($request, [
            'title' => 'required',
            'code' => 'required|min:4|regex:/^[a-z0-9_-]*$/|unique:discounts,code',
            'discount' => 'required|int',
            'capacity' => 'nullable|int',
            'capacity_per_user' => 'nullable|int',
            'products' => 'required',
            'start_at' => 'required',
            'expire_at' => 'required',
        ]);

        auth()->user()->discounts()->create($inputs);

        return response([
            'operator' => true,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        $product_lists = auth()->user()->products;
        return view('site.profile.pages.discounts.edit' , compact('product_lists' , 'discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        $inputs = $this->validate($request, [
            'title' => 'required',
            'capacity' => 'nullable|int',
            'capacity_per_user' => 'nullable|int',
            'products' => 'required',
            'start_at' => 'required',
            'expire_at' => 'required',
        ]);


        $discount->update($inputs);


        return response([
            'operator' => true,
        ]);
    }
}
