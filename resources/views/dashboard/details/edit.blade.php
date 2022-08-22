@extends('dashboard.master')

@section('content')
    <section>

        @include('dashboard.layouts.success-message')

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <span>محصول: </span><a target="_blank"
                                           href="{{ $detail->product->path() }}">{{ $detail->product->fa_title }}</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div>
                        <span>دمو</span>
                        @if($detail->demo != $detail->product->demo)
                            <span class="text-success font-small-2">تغییر کرده</span>
                        @endif
                    </div>
                    <a href="{{ $detail->demo }}" target="_blank">{{ $detail->demo }}</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <a href="{{ img_url($detail->icon) }}" target="_blank">
                                <img src="{{ img_url($detail->icon) }}" style="width: 80px">
                                @if($detail->icon != $detail->product->icon)
                                    <p class="text-success font-small-2">تغییر کرده</p>
                                @endif
                            </a>
                        </div>
                        <div class="col-12 col-md-3">
                            <a href="{{ img_url($detail->mini_cover) }}" target="_blank">
                                <img src="{{ img_url($detail->mini_cover) }}" style="width: 130px">
                                @if($detail->mini_cover != $detail->product->mini_cover)
                                    <p class="text-success font-small-2">تغییر کرده</p>
                                @endif
                            </a>
                        </div>
                        <div class="col-12 col-md-3">
                            <a href="{{ img_url($detail->cover) }}" target="_blank">
                                <img src="{{ img_url($detail->cover) }}" style="width: 200px">
                                @if($detail->cover != $detail->product->cover)
                                    <p class="text-success font-small-2">تغییر کرده</p>
                                @endif
                            </a>
                        </div>
                        <div class="col-12 col-md-3">
                            <a href="{{ img_url($detail->cover2) }}" target="_blank">
                                <img src="{{ img_url($detail->cover2) }}" style="width: 200px">
                                @if($detail->cover2 != $detail->product->cover2)
                                     <p class="text-success font-small-2">تغییر کرده</p>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if($detail->status == 'pending')
                        <form action="/dashboard/details/{{ $detail->id }}" method="POST">
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
                                                  placeholder="توضیح">{{ $detail->description }}</textarea>
                                        @include('dashboard.layouts.error' , ['item'=> 'description'])
                                    </div>
                                </div>

                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">ویرایش
                                    </button>
                                </div>
                            </div>
                        </form>
                    @elseif($detail->status == 'verified')
                        <span class="text-success">درخواست بروزرسانی جزئیات با موفقیت تایید شده است.</span>
                        <p class="mt-2">{{ $detail->description }}</p>
                    @else
                        <span class="text-danger">درخواست بروزرسانی جزئیات رد شده است.</span>
                        <p class="mt-2">{{ $detail->description }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
