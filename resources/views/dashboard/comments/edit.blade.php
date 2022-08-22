@extends('dashboard.master')

@section('content')
    <section>

        @include('dashboard.layouts.success-message')

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div style="background: #dedede; border-radius: 8px" class="p-1 mb-2">
                        <p class="p-0 m-0">{!! nl2br($comment->body) !!}</p>
                    </div>
                    @if(!$comment->status)
                        <form action="/dashboard/comments/{{ $comment->id }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row">

                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>وضعیت انتشار</label>
                                        <select class="form-control" name="status" required>
                                            <option value="1">تایید شده</option>
                                        </select>
                                        @include('dashboard.layouts.error' , ['item'=> 'status'])

                                        <button type="submit" class="btn btn-primary glow mt-1 mb-sm-0 mr-0 mr-sm-1">
                                            ذخیره
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <span class="text-success">این نظر تایید شده است.</span>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
