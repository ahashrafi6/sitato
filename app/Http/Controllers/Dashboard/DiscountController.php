<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::latest()->paginate(10);
        return view('dashboard.discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $inputs = $this->validate($request, [
            'title' => 'required',
            'code' => 'required|unique:discounts,code',
            'discount' => 'required|int',
            'capacity' => 'nullable|int',
            'capacity_per_user' => 'nullable|int',
            'products' => 'nullable',
            'type' => 'required',
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
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        $products = Product::find($discount->products);
        return view('dashboard.discounts.edit', compact('discount', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Discount $discount)
    {
        $inputs = $this->validate($request, [
            'title' => 'required',
            'discount' => 'required|int',
            'capacity' => 'nullable|int',
            'capacity_per_user' => 'nullable|int',
            'type' => 'required',
            'start_at' => 'required',
            'expire_at' => 'required',
        ]);


        $discount->update($inputs);


        return response([
            'operator' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return back()->with('success', 'آیتم با موفقیت حذف گردید!');
    }
}
