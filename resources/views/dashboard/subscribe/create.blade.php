@extends('dashboard.master')


@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('subscribe.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
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
                                        <label>عنوان لاتین</label>
                                        <input name="en_title" type="text" class="form-control text-left"
                                               placeholder="عنوان لاتین" value="{{ old('en_title') }}" required dir="ltr">
                                        @include('dashboard.layouts.error' , ['item'=> 'en_title'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>تعداد روز</label>
                                        <input name="day" type="text" class="form-control" placeholder="روز"
                                               value="{{ old('day') }}" required>
                                        @include('dashboard.layouts.error' , ['item'=> 'day'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>تعدا روز هدیه</label>
                                        <input name="gift" type="text" class="form-control" placeholder="روز"
                                               value="{{ old('gift') }}" required>
                                        @include('dashboard.layouts.error' , ['item'=> 'gift'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>قیمت</label>
                                        <input name="price" type="text" class="form-control" placeholder="به تومان"
                                               value="{{ old('price') }}" required>
                                        @include('dashboard.layouts.error' , ['item'=> 'price'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>قیمت تخفیف</label>
                                        <input name="offPrice" type="text" class="form-control" placeholder="به تومان"
                                               value="{{ old('offPrice') }}">
                                        @include('dashboard.layouts.error' , ['item'=> 'offPrice'])
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>ویژگی ها</label>
                                        <textarea name="items" class="form-control"
                                                  placeholder="با کاما (,) جداشوند">{{ old('items') }}</textarea>
                                        @include('dashboard.layouts.error' , ['item'=> 'items'])
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>توضیح کوتاه</label>
                                        <input name="description" type="text" class="form-control" placeholder="توضیح کوتاه"
                                               value="{{ old('description') }}">
                                        @include('dashboard.layouts.error' , ['item'=> 'description'])
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>آیکون</label>
                                        <input name="icon" type="file" class="form-control">
                                        @include('dashboard.layouts.error' , ['item'=> 'icon'])
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                                    ایجاد
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
