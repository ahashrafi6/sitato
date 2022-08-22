<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\MyFile;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('id', 'desc')->with(['parent'])->get();
        return view('dashboard.menus.index', compact('menus'));
    }


    public function create()
    {
        $parents = Menu::parents()->get();
        return view('dashboard.menus.create', compact('parents'));
    }


    public function store(Request $request)
    {
        $inputs = $this->validate($request, [
            'title' => 'required',
            'url' => 'required',
            'type' => 'required',
            'parent_id' => 'nullable|int',
            'description' => 'nullable|string',
            'info' => 'nullable|string',
            'icon' => 'nullable|mimes:png,jpeg,jpg',
        ]);

        unset($inputs['icon']);


        if ($request->file('icon')) {
            $icon = MyFile::FtpUpload($request->file('icon'), 'images/menus');
            Menu::create(array_merge($inputs, ['icon' => $icon]));
        } else {
            Menu::create($inputs);
        }

        return redirect(route('menus.index'))->with([
            'success' => 'آیتم جدید با موفقت ایجاد شد'
        ]);
    }


    public function edit(Menu $menu)
    {
        $parents = Menu::parents()->get();
        return view('dashboard.menus.edit', compact('menu', 'parents'));
    }


    public function update(Request $request, Menu $menu)
    {
        $inputs = $this->validate($request, [
            'title' => 'required',
            'url' => 'required',
            'type' => 'required',
            'parent_id' => 'nullable|int',
            'description' => 'nullable|string',
            'info' => 'nullable|string',
            'icon' => 'nullable|mimes:png,jpeg,jpg',
        ]);

        unset($inputs['icon']);

        if ($request->file('icon')) {
            $icon = MyFile::FtpUpload($request->file('icon'), 'images/menus', null, null, $menu->icon);
            $menu->update(array_merge($inputs, ['icon' => $icon]));
        } else {
            $menu->update($inputs);
        }

        return redirect(route('menus.index'))->with([
            'success' => 'آیتم با موفقت آپدیت شد'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if ($menu->icon) {
            MyFile::FtpDelete($menu->icon);
        }

        $menu->delete();

        return back()->with('success', 'آیتم با موفقیت حذف گردید!');
    }
}
