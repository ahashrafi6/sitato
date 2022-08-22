<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Fakeproduct;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class FakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fakes = Fakeproduct::latest()->paginate(10);
        return view('dashboard.fakes.index', compact('fakes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.fakes.create');
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
            'cash' => 'required|',
            'subscribe' => 'required',
            'per_cash' => 'required',
            'per_subscribe' => 'required',
            'minute' => 'required',
            'product_id' => 'required',
            'type' => 'required',
        ]);

        unset($inputs['product_id']);

        Fakeproduct::create(array_merge($inputs, ['product_id' => $request->get('product_id')['id'] , 'next_at' => now()]));

        return response([
            'operator' => true,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fakeproduct  $fake
     * @return \Illuminate\Http\Response
     */
    public function edit(Fakeproduct $fakeproduct)
    {
        $fakeproduct->load('product');
        return view('dashboard.fakes.edit', compact('fakeproduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fakeproduct  $fake
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fakeproduct $fakeproduct)
    {
        $inputs = $this->validate($request, [
            'cash' => 'required',
            'subscribe' => 'required',
            'per_cash' => 'required',
            'per_subscribe' => 'required',
            'minute' => 'required',
            'type' => 'required',
        ]);


        $fakeproduct->update($inputs);


        return response([
            'operator' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fakeproduct  $fake
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fakeproduct $fakeproduct)
    {
        $fakeproduct->delete();

        return back()->with('success', 'آیتم با موفقیت حذف گردید!');
    }
}
