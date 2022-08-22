<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Zone;
use Illuminate\Http\Request;
use App\Helpers\MyFile;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zones = Zone::all();

        return view('dashboard.courses.create' , compact('zones'));
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
            'en_display' => 'required|string',
            'author_id' => 'required|numeric',
            'zone_id' => 'required|numeric',
            'description' => 'required',
            'body' => 'required',
            'status' => 'required',
            'isSpecial' => 'required',
            'access' => 'required',
            'income_percent' => 'required|numeric',
            'price' => 'required|numeric',
            'icon' => ' required|mimes:png,jpg,jpeg',
            'cover' => 'required|mimes:png,jpg,jpeg',
            'cover2' => 'required|mimes:png,jpg,jpeg',
        ]);

        unset($data['icon']);
        unset($data['cover']);
        unset($data['cover2']);

        $icon = MyFile::FtpUpload($request->file('icon'), 'images/courses');
        $cover = MyFile::FtpUpload($request->file('cover'), 'images/courses');
        $cover2 = MyFile::FtpUpload($request->file('cover2'), 'images/courses');


        $product = Course::create(array_merge($data , ['user_id' => auth()->user()->id, 'icon' => $icon, 'cover' => $cover, 'cover2' => $cover2]));

        return redirect(route('courses.index'))->with([
            'success' => 'دوره جدید با موفقت ایجاد شد'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $zones = Zone::all();

        return view('dashboard.courses.edit' , compact('zones', 'course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $data = $this->validate($request , [
            'fa_title' => 'required|string',
            'fa_display' => 'required|string',
            'en_title' => 'nullable|string|unique:products,en_title',
            'en_display' => 'required|string',
            'zone_id' => 'required|numeric',
            'description' => 'required',
            'body' => 'required',
            'status' => 'required',
            'isSpecial' => 'required',
            'access' => 'required',
            'income_percent' => 'required|numeric',
            'price' => 'required|numeric',
            'icon' => ' nullable|mimes:png,jpg,jpeg',
            'cover' => 'nullable|mimes:png,jpg,jpeg',
            'cover2' => 'nullable|mimes:png,jpg,jpeg',
        ]);
        unset($data['icon']);
        unset($data['cover']);
        unset($data['cover2']);

        $en_title = $course->en_title;
        if ($data['en_title']){
            $en_title = $data['en_title'];
        }

        $icon = $course->icon; $cover = $course->cover; $cover2 = $course->cover2;
        if ($request->file('icon')){
            $icon = MyFile::FtpUpload($request->file('icon'), 'images/courses');
        }
        if ($request->file('cover')){
            $cover = MyFile::FtpUpload($request->file('cover'), 'images/courses');
        }
        if ($request->file('cover2')){
            $cover2 = MyFile::FtpUpload($request->file('cover2'), 'images/courses');
        }



        $course->update(array_merge($data , ['en_title' => $en_title, 'icon' => $icon, 'cover' => $cover, 'cover2' => $cover2]));

        return redirect(route('courses.index'))->with([
            'success' => 'دوره با موفقت آپدیت شد'
        ]);
    }

    public function amazing(Course $course)
    {
        return view('dashboard.courses.amazing' , compact('course'));
    }

    public function amazing_store(Request $request, Course $course)
    {
        $inputs = $this->validate($request, [
            'status' => 'required',
            'price' => 'required_if:status,==,1',
            'start_at' => 'required_if:status,==,1',
            'expire_at' => 'required_if:status,==,1',
            'capacity' => 'required',
        ]);


        $course->update([
            'isOff' => $inputs['status'],
            'offPrice' => $inputs['price'],
            'start_at' => $inputs['start_at'],
            'expire_at' => $inputs['expire_at'],
            'capacity' => $inputs['capacity'],
        ]);

        return response([
            'operator' => true,
        ]);
    }
}
