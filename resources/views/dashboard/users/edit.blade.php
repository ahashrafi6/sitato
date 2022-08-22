@extends('dashboard.master')

@section('content')
    @include('dashboard.layouts.success-message')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <ul class="nav nav-tabs mb-2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                            <i class="bx bx-user mr-25"></i><span class="d-none d-sm-block">حساب کاربری</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                            <i class="bx bx-info-circle mr-25"></i><span class="d-none d-sm-block">اطلاعات</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" id="author-tab" data-toggle="tab" href="#author" aria-controls="author" role="tab" aria-selected="true">
                            <i class="bx bx-user mr-25"></i><span class="d-none d-sm-block">فروشگاه</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
                        <form action="{{ route('users.update' , ['user' => $user->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>نام</label>
                                            <input name="name" type="text" class="form-control text-left" placeholder="نام" value="{{ $user->name }}" required dir="ltr">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>نام خانوادگی</label>
                                            <input name="family" type="text" class="form-control" placeholder="نام خانوادگی" value="{{ $user->family }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>ایمیل</label>
                                            <input type="email" class="form-control text-left disabled" disabled placeholder="ایمیل" value="{{ $user->email }}" required dir="ltr">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>موبایل</label>
                                            <input type="text" class="form-control text-left" placeholder="موبایل" name="phone" value="{{ $user->phone }}" required dir="ltr">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>نام کاربری</label>
                                            <input type="text" class="form-control text-left disabled" disabled placeholder="نام کاربری" value="{{ $user->username }}" required dir="ltr">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>نوع نمایش نام</label>
                                        <select class="form-control" name="display_name_type" required>
                                            <option value="full" {{ $user->display_name_type == 'full' ? 'selected' : '' }}>نام کامل</option>
                                            <option value="username" {{ $user->display_name_type == 'username' ? 'selected' : '' }}>نام کاربری</option>
                                            <option value="author_name" {{ $user->display_name_type == 'author_name' ? 'selected' : '' }}>نام فروشگاه</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">ذخیره تغییرات</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade show" id="information" aria-labelledby="information-tab" role="tabpanel">
                        <form action="{{ route('users.update' , ['user' => $user->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>کد ملی</label>
                                        <input class="form-control text-left" type="text" dir="ltr" name="national_code" value="{{ $user->national_code }}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>جنسیت</label>
                                        <select class="form-control" name="gender" required>
                                            <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>مرد</option>
                                            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>زن</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>روز</label>
                                                <input class="form-control text-left" type="text" name="day" value="{{ $user->day }}" dir="ltr">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>ماه</label>
                                                <input class="form-control text-left" type="text" name="month" value="{{ $user->month }}" dir="ltr">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>سال</label>
                                                <input class="form-control text-left" type="text" name="year" value="{{ $user->year }}" dir="ltr">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">ذخیره تغییرات</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade show" id="author" aria-labelledby="author-tab" role="tabpanel">
                        <form action="{{ route('users.update' , ['user' => $user->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-12">
                                    <h6>وضعیت فروشندگی: {!! !is_null($user->author_at) ? '<span class="text-success">فعال</span>' : '<span class="text-danger">غیر فعال</span>' !!}</h6>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>نام فروشگاه</label>
                                            <input name="author_name" type="text" class="form-control text-left" placeholder="نام فروشگاه" value="{{ $user->author_name }}" dir="ltr">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>زیر عنوان فروشگاه</label>
                                            <input name="author_sub_name" type="text" class="form-control" placeholder="زیر عنوان فروشگاه" value="{{ $user->author_sub_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>توضیح کوتاه فروشگاه</label>
                                            <input name="author_description" type="text" class="form-control" placeholder="توضیح کوتاه فروشگاه" value="{{ $user->author_description }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">ذخیره تغییرات</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
