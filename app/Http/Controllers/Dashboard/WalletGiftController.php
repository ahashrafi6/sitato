<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\WalletGift;
use Illuminate\Http\Request;

class WalletGiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $wallet_gifts = WalletGift::all();
        return view('dashboard.wallet-gifts.index' , compact('wallet_gifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.wallet-gifts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $inputs = $this->validate($request , [
            'min' => 'required|int',
            'max' => 'required|int',
            'percent' => 'required|int',
            'progress' => 'required|int',
        ]);

        WalletGift::create($inputs);

        return redirect(route('wallet-gifts.index'))->with([
            'success' => 'آیتم جدید با موفقت ایجاد شد'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WalletGift  $walletGift
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(WalletGift $walletGift)
    {
        return view('dashboard.wallet-gifts.edit' , compact('walletGift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WalletGift  $walletGift
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, WalletGift $walletGift)
    {
        $inputs = $this->validate($request , [
            'min' => 'required|int',
            'max' => 'required|int',
            'percent' => 'required|int',
            'progress' => 'required|int',
        ]);

        $walletGift->update($inputs);

        return redirect(route('wallet-gifts.index'))->with([
            'success' => 'آیتم با موفقت آپدیت شد'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WalletGift  $walletGift
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(WalletGift $walletGift)
    {
        $walletGift->delete();

        return back()->with('success','آیتم با موفقیت حذف گردید!');
    }
}
