<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::latest()->paginate(10);
        return view('dashboard.sellers.index', compact('sellers'));
    }



    public function update(Request $request, Seller $seller)
    {
        $status = $request->status;

        $seller->update([
            'author_name' => $request->author_name,
            'author_slug' => $request->author_slug,
            'status' => $status,
            'description' => $request->description
        ]);


        if ($status == 'verified') {
            $seller->user()->update([
                'name' => $seller->name,
                'family' => $seller->family,
                'author_name' => $seller->author_name,
                'author_slug' => $seller->author_slug,
                'type' => 'author',
                'author_at' => now()
            ]);
        } else {
            $seller->user()->update([
                'author_name' => null,
                'author_slug' => null,
                'type' => 'user',
                'author_at' => null
            ]);
        }

        return redirect(route('sellers.index'))->with([
            'success' => 'آیتم با موفقت ویرایش شد'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        $seller->with('user');
        return view('dashboard.sellers.show', compact('seller'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        $seller->user->cards()->delete();
        $seller->delete();
        return back()->with('success', 'آیتم با موفقیت حذف گردید!');
    }
}
