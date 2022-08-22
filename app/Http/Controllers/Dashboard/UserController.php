<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return view('dashboard.users.edit' , compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect(route('users.index'))->with([
            'success' => 'آپدیت با موفقیت انجام شد'
        ]);
    }


    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success','کاربر با موفقیت حذف گردید!');
    }

    public function login(User $user)
    {
        Auth::loginUsingId($user->id);
        return redirect('/');
    }
}
