<section class="users-list-wrapper">
    <div class="users-list-filter px-1">
        <div class="row border rounded py-2 mb-2">
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="type">نوع</label>
                <fieldset class="form-group">
                    <select wire:model.lazy="type" class="form-control" id="type">
                        <option value="all">همه</option>
                        <option value="cash">فروش محصول</option>
                        <option value="cash_back">بازگشت فروش محصول</option>
                        <option value="support">فروش پشتیبانی</option>
                        <option value="support_back">بازگشت فروش پشتیبانی</option>
                        <option value="quick_support">فروش پشتیبانی سریع</option>
                        <option value="quick_support_back">بازگشت فروش پشتیبانی سریع</option>
                        <option value="gift">هدیه پلکانی</option>
                        <option value="gift_back">بازگشت هدیه پلکانی</option>
                        <option value="install">فروش سرویس نصب</option>
                        <option value="install_back">بازگشت فروش سرویس نصب</option>
                        <option value="subscribe">اشتراک</option>
                    </select>
                </fieldset>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="status">وضعیت</label>
                <fieldset class="form-group">
                    <select wire:model.lazy="status" class="form-control" id="status">
                        <option value="all">همه</option>
                        <option value="pending">در انتظار</option>
                        <option value="completed">انتقال داده شده</option>
                        <option value="returned">بازگشت داده شده</option>
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
                    @if(count($incomes) > 0)
                        <p class="text-center" wire:loading>در حال بارگذاری...</p>
                        <div wire:loading.remove class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>کاربر</th>
                                    <th>محصول</th>
                                    <th>مبلغ (تومان)</th>
                                    <th>نوع</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($incomes as $item)
                                    <tr>
                                        <td>{{ \App\Models\User::find($item['author_id'])->get_display_name() }}</td>
                                        <td>
                                            @if(isset($item['item']['product_id']))
                                                {{ \App\Models\Product::find($item['item']['product_id'])->fa_title }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($item['price']) }}</td>
                                        <td>
                                            @if($item['type'] == 'cash')
                                                <span>خرید</span>
                                            @else
                                                <span>اشتراک</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item['status'] == 'completed')
                                                <span class="badge badge-light-success">انتقال داده شده</span>
                                            @elseif($item['status'] == 'returned')
                                                <span class="badge badge-light-danger">بازگشت داده شده</span>
                                            @else
                                                <span class="badge badge-light-warning">در انتظار</span>
                                            @endif
                                        </td>
                                        <td>{{ f_date($item['created_at']) }}</td>
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
