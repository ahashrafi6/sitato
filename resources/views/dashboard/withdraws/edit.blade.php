@extends('dashboard.master')

@section('content')
    <section>

        @include('dashboard.layouts.success-message')

        <div class="card">
            <div class="card-content">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <table class="table table-borderless line-height-2">
                                <tbody>
                                <tr>
                                    <td>نام و نام خانوادگی کاربر:</td>
                                    <td class="bold">{{ $withdraw->user->name . ' ' .  $withdraw->user->family}}</td>
                                </tr>
                                <tr>
                                    <td>ایمیل کاربر:</td>
                                    <td class="bold">{{ $withdraw->user->email }}</td>
                                </tr>
                                <tr>
                                    <td>موبایل کاربر:</td>
                                    <td class="bold">{{ $withdraw->user->phone }}</td>
                                </tr>
                                <tr>
                                    <td>نام نمایشی کاربر:</td>
                                    <td class="bold">{{ $withdraw->user->get_display_name() }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-md-6">
                            <table class="table table-borderless line-height-2">
                                <tbody>
                                <tr>
                                    <td>نوع:</td>
                                    <td>{{ \App\Models\Withdraw::CATE[$withdraw->cate] }}</td>
                                </tr>
                                <tr>
                                    <td>نام صاحب حساب:</td>
                                    <td>{{ $withdraw->bank_card['card_name'] }}</td>
                                </tr>
                                <tr>
                                    <td>کارت ملی صاحب حساب</td>
                                    <td>{{ $withdraw->bank_card['card_meli'] }}</td>
                                </tr>
                                <tr>
                                    <td>نام بانک</td>
                                    <td>{{ get_bank_list()[$withdraw->bank_card['bank_name']] }}</td>
                                </tr>
                                <tr>
                                    <td>شماره حساب</td>
                                    <td>{{ $withdraw->bank_card['card_number'] }}</td>
                                </tr>
                                <tr>
                                    <td>شماره کارت</td>
                                    <td>{{ $withdraw->bank_card['card_serial'] }}</td>
                                </tr>
                                <tr>
                                    <td>شماره شبا</td>
                                    <td>IR{{ $withdraw->bank_card['card_sheba'] }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row bg-white rounded mb-2 mx-25 text-center text-lg-left">
            <div class="col-12 col-sm-3 p-1 p-sm-2">
                <h6 class="text-primary mb-0 primary-font">مبلغ (تومان): <span
                        class="font-large-1 align-middle">{{ number_format($withdraw->amount) }}</span>
                </h6>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if($withdraw->status == 'pending')
                        <form action="/dashboard/withdraws/{{ $withdraw->id }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row">

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>وضعیت</label>
                                        <select class="form-control" name="status" required>
                                            <option value="completed">انجام شده</option>
                                            <option value="failed">رد شده</option>
                                        </select>
                                        @include('dashboard.layouts.error' , ['item'=> 'status'])

                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>توضیح</label>
                                        <textarea name="description" class="form-control"
                                                  placeholder="توضیح">{{ $withdraw->description }}</textarea>
                                        @include('dashboard.layouts.error' , ['item'=> 'description'])
                                    </div>
                                </div>

                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">ذخیره
                                    </button>
                                </div>
                            </div>
                        </form>
                    @elseif($withdraw->status == 'completed')
                        <span class="text-success">درخواست تسویه با موفقیت انجام شده است.</span>
                        <p class="mt-2">{{ $withdraw->description }}</p>
                    @else
                        <span class="text-danger">درخواست تسویه رد شده است</span>
                        <p class="mt-2">{{ $withdraw->description }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
