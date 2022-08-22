@extends('dashboard.master')


@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('wallet-gifts.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>min</label>
                                        <input name="min" type="text" class="form-control text-left"
                                               placeholder="به تومان" value="{{ old('min') }}" required dir="ltr">
                                        @include('dashboard.layouts.error' , ['item'=> 'min'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>max</label>
                                        <input name="max" type="text" class="form-control text-left"
                                               placeholder="به تومان" value="{{ old('max') }}" required dir="ltr">
                                        @include('dashboard.layouts.error' , ['item'=> 'max'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>درصد</label>
                                        <input name="percent" type="text" class="form-control" placeholder="درصد"
                                               value="{{ old('percent') }}" required>
                                        @include('dashboard.layouts.error' , ['item'=> 'percent'])
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label>درصد پیشرفت نوار</label>
                                        <input name="progress" type="text" class="form-control" placeholder="درصد"
                                               value="{{ old('progress') }}" required>
                                        @include('dashboard.layouts.error' , ['item'=> 'progress'])
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
