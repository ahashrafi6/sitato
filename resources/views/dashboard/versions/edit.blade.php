@extends('dashboard.master')

@section('content')
    <section>

        @include('dashboard.layouts.success-message')

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <span>محصول: </span><a target="_blank"
                                           href="{{ $version->product->path() }}">{{ $version->product->fa_title }}</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div>
                        <span>نسخه</span>
                        @if($version->version != $version->product->version)
                            <span
                                class="text-success font-small-2">تغییر کرده (قبلی: {{ $version->product->version }})</span>
                        @endif
                    </div>
                    <span>{{ $version->version }}</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <p class="font-small-2">{{ $version->files['main_file']['name'] }}</p>
                            <a href="{{ download_s3($version->files['main_file']['key']) }}" target="_blank" class="btn btn-secondary">فایل اصلی</a>
                        </div>
                        @if(isset($version->files['cash_file']))
                            <div class="col-12 col-md-3">
                                <p class="font-small-2">{{ $version->files['cash_file']['name'] }}</p>
                                <a href="{{ download_s3($version->files['cash_file']['key']) }}" target="_blank" class="btn btn-secondary">فایل بروزرسان (نقدی)</a>
                            </div>
                        @endif
                        @if(isset($version->files['subscribe_file']))
                            <div class="col-12 col-md-3">
                                <p class="font-small-2">{{ $version->files['subscribe_file']['name'] }}</p>
                                <a href="{{ download_s3($version->files['subscribe_file']['key']) }}" target="_blank" class="btn btn-secondary">فایل بروزرسان (اشتراک)</a>
                            </div>
                        @endif
                        @if(isset($version->files['help_file']))
                        <div class="col-12 col-md-3">
                            <p class="font-small-2">{{ $version->files['help_file']['name'] }}</p>
                            <a href="{{ download_s3($version->files['help_file']['key']) }}" target="_blank" class="btn btn-secondary">فایل راهنما</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if($version->status == 'pending')
                        <form action="/dashboard/versions/{{ $version->id }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row">

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>وضعیت</label>
                                        <select class="form-control" name="status" required>
                                            <option value="verified">تایید شده</option>
                                            <option value="fail">رد شده</option>
                                        </select>
                                        @include('dashboard.layouts.error' , ['item'=> 'status'])

                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>توضیح</label>
                                        <textarea name="description" class="form-control"
                                                  placeholder="توضیح">{{ $version->description }}</textarea>
                                        @include('dashboard.layouts.error' , ['item'=> 'description'])
                                    </div>
                                </div>

                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">ویرایش
                                    </button>
                                </div>
                            </div>
                        </form>
                    @elseif($version->status == 'verified')
                        <span class="text-success">درخواست بروزرسانی با موفقیت تایید شده است.</span>
                        <p class="mt-2">{{ $version->description }}</p>
                    @else
                        <span class="text-danger">درخواست بروزرسانی رد شده است.</span>
                        <p class="mt-2">{{ $version->description }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
