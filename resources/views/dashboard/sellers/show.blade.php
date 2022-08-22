@extends('dashboard.master')

@section('content')
    <section class="users-view">
        <div class="card">
            <div class="card-content">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <table class="table table-borderless line-height-2">
                                <tbody>
                                <tr>
                                    <td>نام و نام خانوادگی کاربر:</td>
                                    <td class="bold">{{ $seller->user->name . ' ' .  $seller->user->family}}</td>
                                </tr>
                                <tr>
                                    <td>ایمیل کاربر:</td>
                                    <td class="bold">{{ $seller->user->email }}</td>
                                </tr>
                                <tr>
                                    <td>موبایل کاربر:</td>
                                    <td class="bold">{{ $seller->user->phone }}</td>
                                </tr>
                                <tr>
                                    <td>مدارک کاربر:</td>
                                    <td class="bold">
                                        @if($seller->files)
                                            @foreach($seller->files as $key => $item)
                                                <a href="{{ $item['url'] }}" target="_blank" class="btn btn-secondary">فایل {{ $key + 1 }}</a>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-md-6">
                            <table class="table table-borderless line-height-2">
                                <tbody>
                            @foreach ($seller->user->cards as $item)
                                
                            <tr>
                                <td>نام صاحب حساب:</td>
                                <td>{{ $item->card_name }}</td>
                            </tr>
                            <tr>
                                <td>کارت ملی صاحب حساب</td>
                                <td>{{ $item->card_meli }}</td>
                            </tr>
                            <tr>
                                <td>نام بانک</td>
                                <td>{{ get_bank_list()[$item->bank_name] }}</td>
                            </tr>
                            <tr>
                                <td>شماره کارت</td>
                                <td>{{ $item->card_number }}</td>
                            </tr>
                            <tr>
                                <td>شماره شبا</td>
                                <td>{{ $item->card_sheba }}</td>
                            </tr>
                            @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="/dashboard/sellers/{{ $seller->id }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>عنوان فروشگاه</label>
                                    <input name="author_name" type="text" class="form-control"
                                           placeholder="عنوان فروشگاه" value="{{ $seller->author_name }}">
                                    @include('dashboard.layouts.error' , ['item'=> 'author_name'])
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>آدرس فروشگاه</label>
                                    <input name="author_slug" type="text" class="form-control"
                                           placeholder="آدرس فروشگاه" value="{{ $seller->author_slug }}">
                                    @include('dashboard.layouts.error' , ['item'=> 'author_slug'])
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>وضعیت</label>
                                    <select class="form-control" name="status">
                                        @foreach(\App\Models\Seller::STATUS as $key => $item)
                                            <option
                                                {{ $key == $seller->status ? 'selected' : '' }} value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @include('dashboard.layouts.error' , ['item'=> 'status'])
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>توضیح</label>
                                    <textarea name="description" class="form-control" placeholder="توضیح">{{ $seller->description }}</textarea>
                                    @include('dashboard.layouts.error' , ['item'=> 'description'])
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
