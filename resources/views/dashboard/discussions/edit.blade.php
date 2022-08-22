@extends('dashboard.master')

@section('content')
    <section>

        @include('dashboard.layouts.success-message')

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div style="background: #dedede; border-radius: 8px" class="p-1 mb-2">
                        <p class="p-0 m-0">{!! nl2br($discussion->body) !!}</p>
                    </div>
                    <form action="/dashboard/discussions/{{ $discussion->id }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">

                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <label>وضعیت انتشار</label>
                                    <select class="form-control" name="status" required>
                                        <option {{ $discussion->status == 0 ? 'selected' : '' }} value="0">تایید نشده</option>
                                        <option {{ $discussion->status == 1 ? 'selected' : '' }} value="1">تایید شده</option>
                                    </select>
                                    @include('dashboard.layouts.error' , ['item'=> 'status'])
                                    <button type="submit" class="btn btn-primary glow mt-1 mb-sm-0 mr-0 mr-sm-1">
                                        ذخیره
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @foreach($discussion->replies as $item)
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="mb-2">
                            <span>پاسخ توسط: {{ $item->user->get_display_name() }}</span>
                        </div>
                        <div>
                            {!! nl2br($item->body) !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('discussions.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <label>پاسخ جدید</label>
                                    <textarea name="body" class="form-control" placeholder="متن خود را بنویسید ..."
                                              required>{{ old('body') }}</textarea>
                                    @include('dashboard.layouts.error' , ['item'=> 'body'])
                                </div>
                            </div>


                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                <input type="hidden" name="discussion_id" value="{{ $discussion->id }}">
                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                                    ثبت پاسخ
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
