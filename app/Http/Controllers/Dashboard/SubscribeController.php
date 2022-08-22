<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\MyFile;
use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $subscribes = Subscribe::all();
        return view('dashboard.subscribe.index' , compact('subscribes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.subscribe.create');
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
            'fa_title' => 'required',
            'en_title' => 'required|unique:subscribes,en_title',
            'day' => 'required|int',
            'gift' => 'nullable|int',
            'price' => 'required|int',
            'offPrice' => 'nullable|int',
            'items' => 'nullable|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|mimes:png,jpeg,jpg',
        ]);

        unset($inputs['icon']);

        if ($request->file('icon')){
            $icon = MyFile::FtpUpload($request->file('icon'), 'images/menus');
            Subscribe::create(array_merge($inputs , ['icon' => $icon]));
        }else{
            Subscribe::create($inputs);
        }

        return redirect(route('subscribe.index'))->with([
            'success' => 'آیتم جدید با موفقت ایجاد شد'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Subscribe $subscribe)
    {
        return view('dashboard.subscribe.edit' , compact('subscribe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Subscribe $subscribe)
    {
        $inputs = $this->validate($request , [
            'fa_title' => 'required',
            'day' => 'required|int',
            'gift' => 'nullable|int',
            'price' => 'required|int',
            'offPrice' => 'nullable|int',
            'items' => 'nullable|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|mimes:png,jpeg,jpg',
        ]);

        unset($inputs['icon']);

        if ($request->file('icon')){
            $icon = MyFile::FtpUpload($request->file('icon'), 'images/subscribe',$subscribe->icon);
            $subscribe->update(array_merge($inputs , ['icon' => $icon]));
        }else{
            $subscribe->update($inputs);
        }

        return redirect(route('subscribe.index'))->with([
            'success' => 'آیتم با موفقت آپدیت شد'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Subscribe $subscribe)
    {
        if ($subscribe->icon){
            MyFile::FtpDelete($subscribe->icon);
        }

        $subscribe->delete();

        return back()->with('success','آیتم با موفقیت حذف گردید!');
    }
}
