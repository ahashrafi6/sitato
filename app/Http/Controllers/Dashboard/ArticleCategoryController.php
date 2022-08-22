<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ArticleCategory::orderBy('id', 'desc')->get();
        return view('dashboard.article-categories.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.article-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request , [
            'fa_title' => 'required',
            'en_title' => 'required',
            'body' => 'nullable',
        ]);

        ArticleCategory::create($data);

        return redirect(route('article-categories.index'))->with([
            'success' => 'دسته بندی جدید با موفقت ایجاد شد'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleCategory $articleCategory)
    {
        return view('dashboard.article-categories.edit' , compact('articleCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArticleCategory $articleCategory)
    {
        $data = $this->validate($request , [
            'fa_title' => 'required',
            'en_title' => 'required',
            'body' => 'nullable',
        ]);

        $articleCategory->update($data);

        return redirect(route('article-categories.index'))->with([
            'success' => 'دسته بندی با موفقت آپدیت شد'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleCategory $articleCategory)
    {
        $articleCategory->delete();
        return back()->with('success','دسته بندی با موفقیت حذف گردید!');
    }
}
