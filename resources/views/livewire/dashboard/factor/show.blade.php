<section class="users-view">
    <!-- users view media object start -->
    <div class="row">
        <div class="col-12 col-sm-7">
            <div class="media mb-2">
                <div class="media-body mt-n50">
                    <h4 class="media-heading"><span class="users-view-username text-muted font-medium-1 ">فاکتور </span><span
                            class="users-view-name">{{ $factor['resNumber'] }}</span><span
                            class="text-muted font-medium-1"></span></h4>
                    <span>نوع:</span>
                    @if($factor['type'] == 'cart')
                        <span>خرید</span>
                    @elseif($factor['type'] == 'subscribe')
                        <span>خرید اشتراک</span>
                    @elseif($factor['type'] == 'renew')
                        <span>تمدید اشتراک</span>
                    @elseif($factor['type'] == 'install')
                        <span>سرویس نصب</span>
                    @elseif($factor['type'] == 'support')
                        <span>تمدید پشتیبانی</span>
                    @elseif($factor['type'] == 'quick_support')
                        <span>سرویس پشتیبانی سریع</span>
                    @endif

                    <span class="ml-1">وضعیت:</span>
                    @if($factor['status'])
                        <span class="text-success">پرداخت شده</span>
                    @else
                        <span class="text-danger">در انتظار پرداخت</span>
                    @endif


                </div>
            </div>
        </div>
        <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
            <!--            <a href="#" class="btn btn-sm mr-25 border">حذف فاکتور</a>-->
        </div>
    </div>

    @if($factor['type'] == 'support' || $factor['type'] == 'install' || $factor['type'] == 'quick_support')
        <div class="card p-2">
            <span>محصول: {{ \App\Models\Product::find($factor['services']['product_id'])->fa_title }}</span>
        </div>
    @endif

    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
                    @if(!is_null($factor['total_price']))
                        <div class="col-12 col-sm-4 p-1 p-sm-2">
                            <h6 class="text-primary mb-0 primary-font">مبلغ اولیه : <span
                                    class="font-large-1 align-middle">{{ number_format($factor['total_price']) }}</span>
                            </h6>
                        </div>
                    @endif

                    <div class="col-12 col-sm-4 p-1 p-sm-2">
                        <h6 class="text-primary mb-0 primary-font">مبلغ کل : <span
                                class="font-large-1 align-middle">{{ number_format($factor['final_price']) }}</span>
                        </h6>
                    </div>
                    <div class="col-12 col-sm-4 p-1 p-sm-2">
                        <h6 class="text-primary mb-0 primary-font">تعداد آیتم ها: <span
                                class="font-large-1 align-middle">{{ $factor['count'] }}</span></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <table class="table table-borderless line-height-2">
                            <tbody>
                            <tr>
                                <td>نام کاربر:</td>
                                <td class="bold">{{ $user->get_display_name() }}</td>
                            </tr>
                            <tr>
                                <td>ایمیل کاربر:</td>
                                <td class="bold">{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>موبایل کاربر:</td>
                                <td class="bold">{{ $user->phone }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 col-md-6">
                        <table class="table table-borderless line-height-2">
                            <tbody>
                            <tr>
                                <td>درگاه:</td>
                                <td>{{ $factor['terminal'] }}</td>
                            </tr>
                            <tr>
                                <td>کد پیگیری درگاه:</td>
                                <td>{{ $factor['refNumber'] }}</td>
                            </tr>
                            <tr>
                                <td>تاریخ ثبت:</td>
                                <td>{{ f_date($factor['created_at']) }}</td>
                            </tr>
                            <tr>
                                <td>تاریخ پرداخت:</td>
                                <td>{{ f_date($factor['payment_at']) }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!is_null($factor['subscribe']))
        <div class="row bg-white rounded mb-2 mx-25 text-center text-lg-left">
            <div class="col-12 col-sm-3 p-1 p-sm-2">
                <h6 class="text-danger mb-0 primary-font">پلن: <span
                        class="font-large-1 align-middle">{{ $factor['subscribe']['title'] }}</span>
                </h6>
            </div>
            <div class="col-12 col-sm-3 p-1 p-sm-2">
                <h6 class="text-danger mb-0 primary-font">روز: <span
                        class="font-large-1 align-middle">{{ $factor['subscribe']['day'] }}</span>
                </h6>
            </div>
            <div class="col-12 col-sm-3 p-1 p-sm-2">
                <h6 class="text-danger mb-0 primary-font">روز هدیه: <span
                        class="font-large-1 align-middle">{{ $factor['subscribe']['gift'] }}</span>
                </h6>
            </div>
            <div class="col-12 col-sm-3 p-1 p-sm-2">
                <h6 class="text-danger mb-0 primary-font">دامنه: <span
                        class="font-large-1 align-middle">{{ $factor['subscribe']['domain'] }}</span>
                </h6>
            </div>
        </div>
    @endif

    <div class="row bg-white rounded mb-2 mx-25 text-center text-lg-left">
        @if($factor['type'] == 'cart')
            @if($factor['services'] && !is_null($factor['services']['extendSupport']))
                <div class="col-12 col-sm-3 p-1 p-sm-2">
                    <h6 class="text-primary mb-0 primary-font">6 ماه بیشتر: <span
                            class="font-large-1 align-middle">{{ number_format($factor['services']['extendSupport']['price']) }}</span>
                    </h6>
                </div>
            @endif
            @if($factor['services'] && !is_null($factor['services']['quickSupport']))
                <div class="col-12 col-sm-3 p-1 p-sm-2">
                    <h6 class="text-primary mb-0 primary-font">پشتیبانی سریع: <span
                            class="font-large-1 align-middle">{{ number_format($factor['services']['quickSupport']['price']) }}</span>
                    </h6>
                </div>
            @endif
            @if($factor['services'] && !is_null($factor['services']['productInstall']))
                <div class="col-12 col-sm-3 p-1 p-sm-2">
                    <h6 class="text-primary mb-0 primary-font">سرویس نصب: <span
                            class="font-large-1 align-middle">{{ number_format($factor['services']['productInstall']['price']) }}</span>
                    </h6>
                </div>
            @endif
        @endif

        @if(!is_null($factor['discount']))
            <div class="col-12 col-sm-3 p-1 p-sm-2">
                <h6 class="text-danger mb-0 primary-font">تخفیف کل: <span
                        class="font-large-1 align-middle">{{ number_format($factor['discount']['price']) }}</span>
                </h6>
            </div>
        @endif
        @if(!is_null($factor['wallet_gift']))
            <div class="col-12 col-sm-3 p-1 p-sm-2">
                <h6 class="text-warning mb-0 primary-font">هدیه پلکانی: <span
                        class="font-large-1 align-middle">{{ number_format($factor['wallet_gift']['price']) }}</span>
                </h6>
            </div>
        @endif
        @if(!is_null($factor['gift']))
            <div class="col-12 col-sm-3 p-1 p-sm-2">
                <h6 class="text-warning mb-0 primary-font">پرداختی توسط اعتبار هدیه: <span
                        class="font-large-1 align-middle">{{ number_format($factor['gift']['consumed']) }}</span>
                </h6>
            </div>
        @endif
    </div>
    @if($factor['type'] == 'cart')
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th>آیدی</th>
                                        <th>محصول</th>
                                        <th>فروشنده</th>
                                        <th>تعداد</th>
                                        <th>قیمت</th>
                                        <th>6ماه پشتیبانی بیشتر</th>
                                        <th>پشتیبانی سریع</th>
                                        <th>سرویس نصب</th>
                                        <th>تخفیف</th>
                                        <th>سهم</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($factor['items'] as $item)
                                        <tr>
                                            <td>{{ $item['id'] }}</td>
                                            <td>{{ \App\Models\Product::find($item['product_id'])->fa_title }}</td>
                                            <td>{{ \App\Models\User::find($item['author_id'])->get_display_name() }}</td>
                                            <td>{{ $item['count'] }}</td>
                                            <td>{{ number_format($item['price']) }}</td>
                                            <td>
                                                @if(!is_null($item['extend_support']))
                                                    {{ number_format($item['extend_support']) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if(!is_null($item['quick_support']))
                                                    {{ number_format($item['quick_support']) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if(!is_null($item['product_install']))
                                                    {{ number_format($item['product_install']) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if(!is_null($item['discount']))
                                                    {{ $item['discount'] }}
                                                @endif
                                            </td>
                                            <td>فروشنده: {{ $item['income_percent'] }}%
                                                سایت: {{ 100 - $item['income_percent'] }}%
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</section>
