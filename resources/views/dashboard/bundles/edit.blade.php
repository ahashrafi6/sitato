@extends('dashboard.master')

@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="/dashboard/bundles/{{ $bundle->slug }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>حوزه</label>
                                    <select class="form-control" name="zone_id" required>
                                        @foreach($zones as $zone)
                                            <option value="{{ $zone->id }}">{{ $zone->fa_title }}</option>
                                        @endforeach
                                    </select>
                                    @include('dashboard.layouts.error' , ['item'=> 'zone_id'])
                                </div>
                            </div>
                   
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>عنوان</label>
                                        <input name="fa_title" type="text" class="form-control text-left"
                                               placeholder="عنوان" value="{{ $bundle->fa_title }}" required dir="ltr">
                                        @include('dashboard.layouts.error' , ['item'=> 'fa_title'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label>عنوان انگلیسی</label>
                                            <span
                                                class="font-small-2 text-primary">انتخاب شده: {{ $bundle->en_title }}</span>
                                        </div>
                                        <input name="en_title" type="text" class="form-control"
                                               placeholder="عنوان انگلیسی" value=""
                                               dir="ltr">
                                        @include('dashboard.layouts.error' , ['item'=> 'en_title'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>عنوان انگلیسی (نمایشی)</label>
                                        <input name="en_display" type="text" class="form-control"
                                               placeholder="عنوان انگلیسی" value="{{ $bundle->en_display }}" required
                                               dir="ltr">
                                        @include('dashboard.layouts.error' , ['item'=> 'en_display'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>توضیح کوتاه</label>
                                        <textarea name="description" class="form-control" placeholder="توضیح"
                                                  required>{{ $bundle->description }}</textarea>
                                        @include('dashboard.layouts.error' , ['item'=> 'description'])
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>محتوا</label>
                                        <textarea class="sub-editor" name="body">{{ $bundle->body }}</textarea>
                                        @include('dashboard.layouts.error' , ['item'=> 'body'])
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <label>وضعیت انتشار</label>
                                    <select class="form-control" name="status" required>
                                        @foreach(\App\Models\Product::STATUS as $key => $item)
                                            <option
                                                value="{{ $key }}" {{ $key == $bundle->status ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @include('dashboard.layouts.error' , ['item'=> 'status'])
                                </div>
                            </div>
                
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>آیکون</label>
                                        <input type="file" name="icon" class="form-control">
                                        @include('dashboard.layouts.error' , ['item'=> 'icon'])
                                        <img class="pt-3" src="{{ img_url($bundle->icon) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>کاور اصلی</label>
                                        <input type="file" name="cover" class="form-control">
                                        @include('dashboard.layouts.error' , ['item'=> 'cover'])
                                        <a href="{{ img_url($bundle->cover) }}" target="_blank">
                                            <img class="pt-3"
                                                 width="150px"
                                                 src="{{ img_url($bundle->cover) }}"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>کاور دوم</label>
                                        <input type="file" name="cover2" class="form-control">
                                        @include('dashboard.layouts.error' , ['item'=> 'cover2'])
                                        <a href="{{ img_url($bundle->cover2) }}" target="_blank">
                                            <img class="pt-3"
                                                 width="150px"
                                                 src="{{ img_url($bundle->cover2) }}"></a>
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

    <script>

    </script>
@endsection
