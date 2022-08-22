@extends('dashboard.master')

@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="/dashboard/products/{{ $product->slug }}" method="POST" enctype="multipart/form-data">
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
                                        <label>دسته بندی</label>
                                        <select multiple class="select2 form-control" name="categories[]">
                                            @foreach($categories as $item)
                                                <option
                                                    value="{{ $item->id }}" {{ in_array($item->id , $product->categories()->pluck('category_id')->toArray()) ? 'selected' : '' }}>{{ $item->fa_title }}</option>
                                            @endforeach
                                        </select>
                                        @include('dashboard.layouts.error' , ['item'=> 'categories'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>تگ ها</label>
                                        <select multiple class="select2 form-control" name="tags[]">
                                            @foreach($tags as $item)
                                                <option
                                                    value="{{ $item->id }}" {{ in_array($item->id , $product->tags()->pluck('tag_id')->toArray()) ? 'selected' : '' }}>{{ $item->fa_title }}</option>
                                            @endforeach
                                        </select>
                                        @include('dashboard.layouts.error' , ['item'=> 'tags'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>عنوان</label>
                                        <input name="fa_title" type="text" class="form-control text-left"
                                               placeholder="عنوان" value="{{ $product->fa_title }}" required dir="ltr">
                                        @include('dashboard.layouts.error' , ['item'=> 'fa_title'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>عنوان سئو</label>
                                        <input name="fa_display" type="text" class="form-control text-left"
                                               placeholder="عنوان" value="{{ $product->fa_display }}" required dir="ltr">
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
                                                class="font-small-2 text-primary">انتخاب شده: {{ $product->en_title }}</span>
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
                                               placeholder="عنوان انگلیسی" value="{{ $product->en_display }}" required
                                               dir="ltr">
                                        @include('dashboard.layouts.error' , ['item'=> 'en_display'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>آدرس پیشنمایش</label>
                                        <input name="demo" type="text" class="form-control"
                                               placeholder="آدرس پیشنمایش" value="{{ $product->demo }}" required
                                               dir="ltr">
                                        @include('dashboard.layouts.error' , ['item'=> 'demo'])
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>توضیح کوتاه</label>
                                        <textarea name="description" class="form-control" placeholder="توضیح"
                                                  required>{{ $product->description }}</textarea>
                                        @include('dashboard.layouts.error' , ['item'=> 'description'])
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>مدال ها</label>
                                        <select multiple class="select2 form-control" name="badges[]">
                                            @foreach(\App\Models\Product::BADGES as $key => $item)
                                                <option value="{{ $key }}" {{ $product->badges ? (in_array($key , $product->badges) ? 'selected' : '') : '' }}>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @include('dashboard.layouts.error' , ['item'=> 'badges'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>سرویس ها</label>
                                        <select multiple class="select2 form-control" name="services[]">
                                            @foreach(\App\Models\Product::SERVICES as $key => $item)
                                                <option value="{{ $key }}" {{ $product->services ? (in_array($key , $product->services) ? 'selected' : '') : '' }}>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @include('dashboard.layouts.error' , ['item'=> 'services'])
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>محتوا</label>
                                        <textarea class="sub-editor" name="body">{{ $product->body }}</textarea>
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
                                                value="{{ $key }}" {{ $key == $product->status ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @include('dashboard.layouts.error' , ['item'=> 'status'])
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <label>نوع دسترسی</label>
                                    <select class="form-control" name="access" required>
                                        @foreach(\App\Models\Product::ACCESS as $key => $item)
                                            <option
                                                value="{{ $key }}" {{ $key == $product->access ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @include('dashboard.layouts.error' , ['item'=> 'access'])
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <label>محصول ویژه</label>
                                    <select class="form-control" name="isSpecial" required>
                                        <option value="0" {{ !$product->status ? 'selected' : '' }}>خیر</option>
                                        <option value="1" {{ $product->status ? 'selected' : '' }}>بله</option>
                                    </select>
                                    @include('dashboard.layouts.error' , ['item'=> 'isSpecial'])
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>نسخه</label>
                                        <input name="version" type="text" class="form-control" placeholder="1.0.5"
                                               value="{{ $product->version }}" required>
                                        @include('dashboard.layouts.error' , ['item'=> 'version'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>حق فروشنده</label>
                                        <input name="income_percent" type="text" class="form-control" placeholder="درصد"
                                               value="{{ $product->income_percent }}" required>
                                        @include('dashboard.layouts.error' , ['item'=> 'income_percent'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>قیمت</label>
                                        <input name="price" type="text" class="form-control" placeholder="قیمت به تومان"
                                               value="{{ $product->price }}" required>
                                        @include('dashboard.layouts.error' , ['item'=> 'price'])
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>آیکون</label>
                                        <input type="file" name="icon" class="form-control">
                                        @include('dashboard.layouts.error' , ['item'=> 'icon'])
                                        <img class="pt-3" src="{{ img_url($product->icon) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>کاور اصلی</label>
                                        <input type="file" name="cover" class="form-control">
                                        @include('dashboard.layouts.error' , ['item'=> 'cover'])
                                        <a href="{{ img_url($product->cover) }}" target="_blank">
                                            <img class="pt-3"
                                                 width="150px"
                                                 src="{{ img_url($product->cover) }}"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>کاور دوم</label>
                                        <input type="file" name="cover2" class="form-control">
                                        @include('dashboard.layouts.error' , ['item'=> 'cover2'])
                                        <a href="{{ img_url($product->cover2) }}" target="_blank">
                                            <img class="pt-3"
                                                 width="150px"
                                                 src="{{ img_url($product->cover2) }}"></a>
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
        //date picker shamsi
        $('.shamsi-datepicker-list').datepicker({
            dateFormat: "@",
            showOtherMonths: true,
            selectOtherMonths: true,
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            onSelect: function (txt, obj) {
                $('#expire_at').val(txt);
            },
        });

    </script>
@endsection
