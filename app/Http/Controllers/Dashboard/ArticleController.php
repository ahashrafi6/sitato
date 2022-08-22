<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\MyFile;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ArticleCategory::all();
        return view('dashboard.articles.create' , compact('categories'));
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
            'fa_title' => 'required|string',
            'fa_display' => 'required|string',
            'en_title' => 'required|string|unique:products,en_title',
            'category_id' => 'required',
            'description' => 'required',
            'body' => 'required',
            'status' => 'required',
            'cover' => 'required|mimes:png,jpg,jpeg',
        ]);

        unset($data['cover']);

        $cover = MyFile::FtpUpload($request->file('cover'), 'images/articles');


        Article::create(array_merge($data , ['user_id' => auth()->user()->id, 'cover' => $cover , 'study' => ReadingTime($data['body'])]));


        return redirect(route('articles.index'))->with([
            'success' => 'مقاله جدید با موفقت ایجاد شد'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = ArticleCategory::all();
        return view('dashboard.articles.edit' , compact('categories' , 'article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $data = $this->validate($request , [
            'fa_title' => 'required|string',
            'fa_display' => 'required|string',
            'en_title' => 'nullable|string|unique:products,en_title',
            'category_id' => 'required',
            'description' => 'required',
            'body' => 'required',
            'status' => 'required',
            'cover' => 'nullable|mimes:png,jpg,jpeg',
        ]);

        unset($data['cover']);


        $en_title = $article->en_title;
        if ($data['en_title']){
            $en_title = $data['en_title'];
        }

        $cover = $article->cover;
        if ($request->file('cover')){
            $cover = MyFile::FtpUpload($request->file('cover'), 'images/articles');
        }


        $article->update(array_merge($data , ['en_title' => $en_title, 'cover' => $cover, 'study' => ReadingTime($data['body'])]));


        return redirect(route('articles.index'))->with([
            'success' => 'مقاله با موفقت آپدیت شد'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return back()->with('success', 'آیتم با موفقیت حذف گردید!');
    }
}
