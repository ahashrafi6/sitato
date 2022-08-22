@extends('dashboard.master')

@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="/dashboard/menus/{{ $menu->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>عنوان</label>
                                        <input name="title" type="text" class="form-control text-left"
                                               placeholder="عنوان" value="{{ $menu->title }}" required dir="ltr">
                                        @include('dashboard.layouts.error' , ['item'=> 'title'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>لینک</label>
                                        <input name="url" type="text" class="form-control" placeholder="عنوان انگلیسی"
                                               value="{{ $menu->url }}" required>
                                        @include('dashboard.layouts.error' , ['item'=> 'url'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>نوع</label>
                                    <select class="form-control" name="type">
                                        <option value="simple" {{ $menu->type == 'simple' ? 'selected' : ''  }}>ساده</option>
                                        <option value="mega" {{ $menu->type == 'mega' ? 'selected' : ''  }}>مگامنو</option>
                                    </select>
                                    @include('dashboard.layouts.error' , ['item'=> 'type'])
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>پدر</label>
                                    <select class="form-control" name="parent_id">
                                        <option value="">ندارد</option>
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}" {{ $parent->id == $menu->parent_id ? 'selected' : '' }}>{{ $parent->title }}</option>
                                        @endforeach
                                    </select>
                                    @include('dashboard.layouts.error' , ['item'=> 'parent_id'])
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>توضیح کوتاه</label>
                                        <input name="description" type="text" class="form-control"
                                               placeholder="توضیح کوتاه" value="{{ $menu->description }}">
                                        @include('dashboard.layouts.error' , ['item'=> 'description'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>اطلاعات</label>
                                        <input name="info" type="text" class="form-control" placeholder="توضیح کوتاه"
                                               value="{{ $menu->info }}">
                                        @include('dashboard.layouts.error' , ['item'=> 'info'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>آیکون</label>
                                        <input name="icon" type="file" class="form-control">
                                        @include('dashboard.layouts.error' , ['item'=> 'icon'])
                                        @if($menu->icon)
                                            <img src="{{ img_url($menu->icon) }}" width="100px" height="100px">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                                    ویرایش
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection
