@extends('dashboard.master')

@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="/dashboard/articles/{{ $article->slug }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>دسته بندی</label>
                                        <select class="select2 form-control" name="category_id">
                                            @foreach($categories as $item)
                                                <option
                                                    value="{{ $item->id }}" {{ $item->id == $article->category_id ? 'selected' : '' }}>{{ $item->fa_title }}</option>
                                            @endforeach
                                        </select>
                                        @include('dashboard.layouts.error' , ['item'=> 'categories'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>عنوان</label>
                                        <input name="fa_title" type="text" class="form-control text-left"
                                               placeholder="عنوان" value="{{ $article->fa_title }}" required dir="ltr">
                                        @include('dashboard.layouts.error' , ['item'=> 'fa_title'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>عنوان سئو</label>
                                        <input name="fa_display" type="text" class="form-control text-left"
                                               placeholder="عنوان" value="{{ $article->fa_display }}" required dir="ltr">
                                        @include('dashboard.layouts.error' , ['item'=> 'fa_display'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label>عنوان انگلیسی</label>
                                            <span
                                                class="font-small-2 text-primary">انتخاب شده: {{ $article->en_title }}</span>
                                        </div>
                                        <input name="en_title" type="text" class="form-control"
                                               placeholder="عنوان انگلیسی" value=""
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
                                                  required>{{ $article->description }}</textarea>
                                        @include('dashboard.layouts.error' , ['item'=> 'description'])
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>محتوا</label>
                                        <textarea class="sub-editor" name="body">{{ $article->body }}</textarea>
                                        @include('dashboard.layouts.error' , ['item'=> 'body'])
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <label>وضعیت انتشار</label>
                                    <select class="form-control" name="status" required>
                                        @foreach(\App\Models\Article::STATUS as $key => $item)
                                            <option
                                                value="{{ $key }}" {{ $key == $article->status ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @include('dashboard.layouts.error' , ['item'=> 'status'])
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>کاور</label>
                                        <input type="file" name="cover" class="form-control">
                                        @include('dashboard.layouts.error' , ['item'=> 'cover'])
                                        <a href="{{ img_url($article->cover) }}" target="_blank">
                                            <img class="pt-3"
                                                 width="150px"
                                                 src="{{ img_url($article->cover) }}"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">ویرایش
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
