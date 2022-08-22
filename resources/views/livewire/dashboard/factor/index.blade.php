<section class="users-list-wrapper">
    <div class="users-list-filter px-1">
        <div class="row border rounded py-2 mb-2">
            <div class="col-12 col-sm-6 col-lg-3">
                <fieldset class="form-group">
                    <label for="resNumber">شناسه فاکتور</label>
                    <input wire:model.lazy="resNumber" type="text" class="form-control" id="resNumber"
                           placeholder="شناسه را وارد کنید">
                </fieldset>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="type">نوع فاکتور</label>
                <fieldset class="form-group">
                    <select wire:model.lazy="type" class="form-control" id="type">
                        <option value="all">همه</option>
                        <option value="cart">خرید</option>
                        <option value="subscribe">خرید اشتراک</option>
                        <option value="renew">تمدید اشتراک</option>
                        <option value="support">تمدید پشتیبانی</option>
                        <option value="install">سرویس نصب</option>
                        <option value="quick_support">سرویس پشتیبانی سریع</option>
                    </select>
                </fieldset>
            </div>
        </div>
    </div>
    @include('dashboard.layouts.success-message')
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if(count($factors) > 0)
                        <p class="text-center" wire:loading>در حال بارگذاری...</p>
                        <div wire:loading.remove class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>نوع</th>
                                    <th>مبلغ کل (تومان)</th>
                                    <th>وضعیت پرداخت</th>
                                    <!--                                    <th>وضعیت لایسنس</th>
                                                                        <th>وضعیت محاسبه درآمد</th>-->
                                    <th>درگاه</th>
                                    <th>تاریخ ثبت</th>
                                    <th>ویرایش</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($factors as $item)
                                    <tr>
                                        <td>{{ $item['resNumber'] }}</td>
                                        <td>
                                            @if($item['type'] == 'cart')
                                                <span>خرید</span>
                                            @elseif($item['type'] == 'subscribe')
                                                <span>خرید اشتراک</span>
                                            @elseif($item['type'] == 'renew')
                                                <span>تمدید اشتراک</span>
                                            @elseif($item['type'] == 'install')
                                                <span>سرویس نصب</span>
                                            @elseif($item['type'] == 'support')
                                                <span>تمدید پشتیبانی</span>
                                            @elseif($item['type'] == 'quick_support')
                                                <span>سرویس پشتیبانی سریع</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($item['final_price']) }}</td>
                                        <td>
                                            @if($item['status'])
                                                <span class="badge badge-light-success">پرداخت شده</span>
                                            @else
                                                <span class="badge badge-light-danger">در انتظار پرداخت</span>
                                            @endif
                                        </td>
                                        <!--                                        <td>

                                                                                        <span class="badge badge-light-success">لایسنس شده</span>

                                                                                        <span :wire:key="$item['id']"
                                                                                              wire:click="Licenced('licence' , '')"
                                                                                              data-toggle="tooltip" data-placement="bottom"
                                                                                              data-original-title="تغییر به لایسنس شده"
                                                                                              class="badge badge-light-danger cursor-pointer">در انتظار</span>

                                                                                </td>-->
                                        <!--                                        <td>

                                                                                        <span class="badge badge-light-success">محاسبه شده</span>

                                                                                        <span :wire:key="$item['id']"
                                                                                              wire:click="Incomed('income' , '')"
                                                                                              data-toggle="tooltip" data-placement="bottom"
                                                                                              data-original-title="تغییر به محاسبه شده"
                                                                                              class="badge badge-light-danger cursor-pointer">در انتظار</span>

                                                                                </td>-->
                                        <td>{{ $item['terminal'] }}</td>
                                        <td>{{ f_date($item['created_at']) }}</td>
                                        <td>
                                            <div class="d-flex items-center">
                                                <a href="{{ route('factors.show' , ['factor' => $item['id']]) }}"><i
                                                        class="bx bx-edit-alt mr-1"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <span class="badge badge-light line-height-2 mx-1 font-size-base">1</span>
                                <a class="cursor-pointer btn btn-primary text-white" wire:click="prev()">قبلی</a>
                                <span
                                    class="badge badge-success line-height-2 mx-1 font-size-base">{{ $current_page }}</span>
                                <a class="cursor-pointer btn btn-primary text-white" wire:click="next()">بعدی</a>
                                <span
                                    class="badge badge-light line-height-2 mx-1 font-size-base">{{ $last_page }}</span>
                            </div>
                        </div>
                    @else
                        <p>آیتمی یافت نشد!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


