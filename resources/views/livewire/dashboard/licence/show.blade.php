<section class="users-view">
    <div class="row">
        <div class="col-12 col-sm-7">
            <div class="media mb-2">
                <div class="media-body mt-n50">
                    <h4 class="media-heading">لایسنس</h4>
                    <span>نوع:</span>
                    @if($licence['type'] == 'cash')
                        <span>خرید</span>
                    @else
                        <span>اشتراک</span>
                    @endif

                    <span class="ml-1">تاریخ ثبت:</span>
                    <span>{{ f_date($licence['created_at']) }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
<!--            <a href="page-users-edit.html" class="btn btn-sm btn-danger">حذف لایسنس</a>-->
        </div>
    </div>


    <div class="row bg-white rounded mb-2 mx-25 p-2">
        <p class="m-0 p-0">توکن: {{ $licence['token'] }}</p>
    </div>

    <div class="row bg-white rounded mb-2 mx-25 text-center text-lg-left">
        <div class="col-12 col-md-6">
            <table class="table table-borderless line-height-2">
                <tbody>
                <tr>
                    <td>کاربر:</td>
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
                @if($licence['type'] == 'cash')
                    <tr>
                        <td>محصول:</td>
                        <td class="bold">{{ $product['fa_title'] }}</td>
                    </tr>
                @endif
                @if($licence['type'] == 'subscribe')
                    <tr>
                        <td>دامنه:</td>
                        <td class="bold">{{ $licence['domain'] }}</td>
                    </tr>
                    <tr>
                        <td>تعداد تغییر دامنه:</td>
                        <td class="bold">{{ $licence['switch_count'] }}</td>
                    </tr>
                    <tr>
                        <td>تعداد تمدید:</td>
                        <td class="bold">{{ $licence['renew_count'] }}</td>
                    </tr>
                    <tr>
                        <td>تعداد روز:</td>
                        <td class="bold">{{ $licence['day'] }}</td>
                    </tr>
                    <tr>
                        <td>تاریخ انقضا:</td>
                        <td class="bold">{{ f_date($licence['expire_at']) }}</td>
                    </tr>
                @endif
                <tr>
                    <td>شناسه فاکتور:</td>
                    <td class="bold">{{ $factor['resNumber'] }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</section>
