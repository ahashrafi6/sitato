<section>

    <div class="card">
        <div class="card-content">
            <div class="card-body">

                <div class="row">
                    <div class="col-12 col-md-6">
                        <table class="table table-borderless line-height-2">
                            <tbody>
                            <tr>
                                <td>نام و نام خانوادگی کاربر:</td>
                                <td class="bold">{{ $user->name . ' ' .  $user->family}}</td>
                            </tr>
                            <tr>
                                <td>ایمیل کاربر:</td>
                                <td class="bold">{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>موبایل کاربر:</td>
                                <td class="bold">{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <td>نام نمایشی کاربر:</td>
                                <td class="bold">{{ $user->get_display_name() }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 col-md-6">
                        <table class="table table-borderless line-height-2">
                            <tbody>
                            <tr>
                                <td>نوع بازگشت: </td>
                                <td>
                                    @if($refund['type'] == 'cash_back')
                                        <span>بازگشت فروش محصول</span>
                                    @elseif($refund['type'] == 'support_back')
                                        <span>بازگشت فروش پشتیبانی</span>
                                    @elseif($refund['type'] == 'quick_support_back')
                                        <span>بازگشت فروش پشتیبانی سریع</span>
                                    @elseif($refund['type'] == 'install_back')
                                        <span>بازگشت فروش سرویس نصب</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>زمان ثبت درخواست</td>
                                <td>{{ f_date($refund['created_at']) }}</td>
                            </tr>
                            <tr>
                                <td>توضیح کاربر</td>
                                <td>{{ $refund['description'] }}</td>
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
            <h6 class="text-primary mb-0 primary-font">مبلغ: <span
                    class="font-large-1 align-middle">{{ number_format($refund['price']) }}</span>
            </h6>
        </div>
    </div>

    <div class="card">
        <div class="card-content">
            <div class="card-body">
                @if($refund['status'] == 'pending')
                    <form method="POST" wire:submit.prevent="send">
                        @csrf

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>وضعیت</label>
                                    <select wire:model.defer="status" class="form-control" name="status" required>
                                        <option value="">انتخاب ...</option>
                                        <option value="completed">انجام شده</option>
                                        <option value="fail">رد شده</option>
                                    </select>
                                    <x-auth.auth-validation-error name="status"/>
                                </div>
                            </div>

                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">ذخیره
                                </button>
                            </div>
                        </div>
                    </form>
                @elseif($refund['status'] == 'completed')
                    <span class="text-success">درخواست بازگشت با موفقیت انجام شده است.</span>
                @else
                    <span class="text-danger">درخواست بازگشت رد شده است</span>
                @endif
            </div>
        </div>
    </div>
</section>
