@extends('dashboard.master')

@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('chapters.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>دوره</label>
                                    <select class="form-control" name="course_id" required>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->fa_title }}</option>
                                        @endforeach
                                    </select>
                                    @include('dashboard.layouts.error' , ['item'=> 'course_id'])
                                </div>
                            </div>
                          
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>عنوان</label>
                                        <input name="fa_title" type="text" class="form-control text-left"
                                               placeholder="عنوان" value="{{ old('fa_title') }}" required dir="ltr">
                                        @include('dashboard.layouts.error' , ['item'=> 'fa_title'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>عنوان انگلیسی</label>
                                        <input name="en_title" type="text" class="form-control"
                                               placeholder="عنوان انگلیسی" value="{{ old('en_title') }}" required
                                               dir="ltr">
                                        @include('dashboard.layouts.error' , ['item'=> 'en_title'])
                                    </div>
                                </div>
                            </div>
                          
                
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>توضیح کوتاه</label>
                                        <textarea name="description" class="form-control" placeholder="توضیح"
                                                  required>{{ old('description') }}</textarea>
                                        @include('dashboard.layouts.error' , ['item'=> 'description'])
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>محتوا</label>
                                        <textarea class="sub-editor" name="body">{{ old('body') }}</textarea>
                                        @include('dashboard.layouts.error' , ['item'=> 'body'])
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <label>وضعیت انتشار</label>
                                    <select class="form-control" name="status" required>
                                        @foreach(\App\Models\Chapter::STATUS as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @include('dashboard.layouts.error' , ['item'=> 'status'])
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <label>نوع دسترسی</label>
                                    <select class="form-control" name="type" required>
                                        @foreach(\App\Models\Chapter::TYPE as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @include('dashboard.layouts.error' , ['item'=> 'access'])
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <label>نوع</label>
                                    <select class="form-control" name="kind" required>
                                        @foreach(\App\Models\Chapter::KIND as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @include('dashboard.layouts.error' , ['item'=> 'access'])
                                </div>
                            </div>
                       
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>دقیقه</label>
                                        <input name="minute" type="text" class="form-control" placeholder="دقیقه"
                                               value="{{ old('minute') }}" required>
                                        @include('dashboard.layouts.error' , ['item'=> 'minute'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>ثانیه</label>
                                        <input name="second" type="text" class="form-control" placeholder="ثانیه"
                                               value="{{ old('second') }}" required>
                                        @include('dashboard.layouts.error' , ['item'=> 'second'])
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">ایجاد
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <x-tinymce-config/>
@endsection
