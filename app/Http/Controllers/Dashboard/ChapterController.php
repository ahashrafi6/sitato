<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Helpers\MyFile;
use Carbon\Carbon;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();

        return view('dashboard.chapters.create' , compact('courses'));
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
            'en_title' => 'required|string|unique:chapters,en_title',
            'course_id' => 'required|numeric',
            'description' => 'required',
            'body' => 'required',
            'status' => 'required',
            'kind' => 'required',
            'type' => 'required',
            'minute' => 'required',
            'second' => 'required',
        ]);

        if ($request->release_at) {
            $date = Carbon::createFromTimestamp($request->release_at / 1000)->toDateTimeString();
        } else {
            $date = now();
        }

        $product = Chapter::create(array_merge($data , ['release_at' => $date]));

        return redirect(route('chapters.index'))->with([
            'success' => 'جلسه جدید با موفقت ایجاد شد'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Chapter $chapter)
    {
        $courses = Course::all();
        $parents = $chapter->course->chapters()->whereKind('cate')->get();

        return view('dashboard.chapters.edit' , compact('courses', 'chapter' , 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chapter $chapter)
    {
        $data = $this->validate($request , [
            'fa_title' => 'required|string',
            'en_title' => 'nullable|string|unique:chapters,en_title',
            'course_id' => 'required|numeric',
            'description' => 'required',
            'parent_id' => 'nullable|numeric',
            'body' => 'required',
            'status' => 'required',
            'kind' => 'required',
            'type' => 'required',
            'minute' => 'required',
            'second' => 'required',
        ]);

        $en_title = $chapter->en_title;
        if ($data['en_title']){
            $en_title = $data['en_title'];
        }

        if ($request->release_at) {
            $date = Carbon::createFromTimestamp($request->release_at / 1000)->toDateTimeString();
        } else {
            $date = $chapter->created_at;
        }
    

        $chapter->update(array_merge($data , ['en_title' => $en_title, 'release_at' => $date]));

        return redirect(route('chapters.index'))->with([
            'success' => 'جلسه با موفقت آپدیت شد'
        ]);
    }
}
