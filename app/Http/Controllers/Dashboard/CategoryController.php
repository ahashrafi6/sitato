<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->with(['parent' , 'zone'])->get();
        return view('dashboard.categories.index' , compact('categories'));
    }


    public function create()
    {
        $parents = Category::parents()->get();
        return view('dashboard.categories.create' , compact('parents'));
    }


    public function store(Request $request)
    {
        $data = $this->validate($request , [
            'fa_title' => 'required',
            'en_title' => 'required',
            'body' => 'nullable',
            'parent_id' => 'nullable|int',
        ]);

        Category::create(array_merge($data , ['zone_id' => 1]));

        return redirect(route('categories.index'))->with([
            'success' => 'دسته بندی جدید با موفقت ایجاد شد'
        ]);
    }


    public function edit(Category $category)
    {
        $parents = Category::parents()->get();
        return view('dashboard.categories.edit' , compact('category' , 'parents'));
    }


    public function update(Request $request, Category $category)
    {
        $data = $this->validate($request , [
            'fa_title' => 'required',
            'en_title' => 'required',
            'body' => 'nullable',
            'parent_id' => 'nullable|int',
        ]);

        $category->update($data);

        return redirect(route('categories.index'))->with([
            'success' => 'دسته بندی با موفقت آپدیت شد'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success','دسته بندی با موفقیت حذف گردید!');
    }
}
