<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\MyFile;
use App\Http\Controllers\Controller;
use App\Models\Bundle;
use App\Models\Zone;
use Illuminate\Http\Request;

class BundleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $zones = Zone::all();
    
        return view('dashboard.bundles.create', compact('zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'fa_title' => 'required|string',
            'en_title' => 'required|string|unique:bundles,en_title',
            'en_display' => 'required|string',
            'zone_id' => 'required|numeric',
            'description' => 'required',
            'body' => 'required',
            'status' => 'required',
            'icon' => ' required|mimes:png,jpg,jpeg',
            'cover' => 'required|mimes:png,jpg,jpeg',
            'cover2' => 'required|mimes:png,jpg,jpeg',
        ]);

        unset($data['icon']);
        unset($data['cover']);
        unset($data['cover2']);

        $icon = MyFile::FtpUpload($request->file('icon'), 'images/bundles');
        $cover = MyFile::FtpUpload($request->file('cover'), 'images/bundles');
        $cover2 = MyFile::FtpUpload($request->file('cover2'), 'images/bundles');

        $bundle = Bundle::create(array_merge($data, ['user_id' => auth()->user()->id, 'icon' => $icon, 'cover' => $cover, 'cover2' => $cover2]));
        

        return redirect(route('bundles.index'))->with([
            'success' => 'پکیج جدید با موفقیت ایجاد شد'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Bundle $bundle)
    {
        $zones = Zone::all();

        return view('dashboard.bundles.edit', compact('zones', 'bundle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Bundle $bundle)
    {
        $data = $this->validate($request, [
            'fa_title' => 'required|string',
            'en_title' => 'nullable|string|unique:bundles,en_title',
            'en_display' => 'required|string',
            'zone_id' => 'required|numeric',
            'description' => 'required',
            'body' => 'required',
            'status' => 'required',
            'icon' => ' nullable|mimes:png,jpg,jpeg',
            'cover' => 'nullable|mimes:png,jpg,jpeg',
            'cover2' => 'nullable|mimes:png,jpg,jpeg',
        ]);
        unset($data['icon']);
        unset($data['cover']);
        unset($data['cover2']);

        $en_title = $bundle->en_title;
        if ($data['en_title']) {
            $en_title = $data['en_title'];
        }

        $icon = $bundle->icon;
        $cover = $bundle->cover;
        $cover2 = $bundle->cover2;
        if ($request->file('icon')) {
            $icon = MyFile::FtpUpload($request->file('icon'), 'images/bundles');
        }
        if ($request->file('cover')) {
            $cover = MyFile::FtpUpload($request->file('cover'), 'images/bundles');
        }
        if ($request->file('cover2')) {
            $cover2 = MyFile::FtpUpload($request->file('cover2'), 'images/bundles');
        }

        $bundle->update(array_merge($data, ['en_title' => $en_title, 'icon' => $icon, 'cover' => $cover, 'cover2' => $cover2]));


        return redirect(route('bundles.index'))->with([
            'success' => 'پکیج با موفقیت آپدیت شد'
        ]);
    }

    public function bundle(Bundle $bundle)
    {
        return view('dashboard.bundles.product', compact('bundle'));
    }
}
