<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Notifications\WithdrawNotification;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function edit(withdraw $withdraw)
    {
        $withdraw->with('user');
        return view('dashboard.withdraws.edit', compact('withdraw'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, withdraw $withdraw)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $withdraw->update([
            'status' => $request->status,
            'description' => $request->description,
            'payment_at' => now(),
        ]);


        $user = $withdraw->user;
        if ($request->status == 'completed') {
            // notifications
            $user->notify(new WithdrawNotification());
        } else {
            $meta = get_user_meta($user);

            if ($withdraw->cate == 'income') {
                set_user_meta($user, ['current_income' => $meta['current_income'] + $withdraw->amount]);
            } else {
                set_user_meta($user, ['current_affiliate' => $meta['current_affiliate'] + $withdraw->amount]);
            }
        }

        return redirect(route('withdraws.index'))->with([
            'success' => 'آیتم با موفقت ویرایش شد'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(withdraw $withdraw)
    {
        $withdraw->delete();
        return back()->with('success', 'آیتم با موفقیت حذف گردید!');
    }
}
