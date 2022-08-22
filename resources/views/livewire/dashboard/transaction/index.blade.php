<section class="users-list-wrapper">
    <div class="users-list-filter px-1">
        <div class="row border rounded py-2 mb-2">
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="type">نوع</label>
                <fieldset class="form-group">
                    <select wire:model.lazy="type" class="form-control" id="type">
                        <option value="all">همه</option>
                        <option value="asc">افزایش</option>
                        <option value="desc">کسر</option>
                    </select>
                </fieldset>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="source">دسته</label>
                <fieldset class="form-group">
                    <select wire:model.lazy="source" class="form-control" id="cate">
                        <option value="all">همه</option>
                        <option value="wallet">اعتبار</option>
                        <option value="gift">اعتبار هدیه</option>
                        <option value="income">درآمد</option>
                        <option value="affiliate">همکاری در فروش</option>
                    </select>
                </fieldset>
            </div>
<!--            <div class="col-12 col-sm-6 col-lg-3">
                <label for="reason">دلیل</label>
                <fieldset class="form-group">
                    <select wire:model.lazy="reason" class="form-control" id="cate">
                        <option value="all">همه</option>
                        <option value="wallet">اعتبار</option>
                        <option value="gift">اعتبار هدیه</option>
                        <option value="support">پشتیبانی</option>
                        <option value="quick_support">همکاری در فروش</option>
                        <option value="install">نصب</option>
                        <option value="product">محصول</option>
                        <option value="affiliate">همکاری در فروش</option>
                        <option value="subscribe">اشتراک</option>
                    </select>
                </fieldset>
            </div>-->
        </div>
    </div>
    @include('dashboard.layouts.success-message')
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if(count($transactions) > 0)
                        <p class="text-center" wire:loading>در حال بارگذاری...</p>
                        <div wire:loading.remove class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>کاربر</th>
                                    <th>نوع</th>
                                    <th>دسته</th>
                                    <th>مبلغ (تومان)</th>
                                    <th>تاریخ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $item)
                                    <tr>
                                        <td>{{ \App\Models\User::find($item['user_id'])->get_display_name() }}</td>
                                        <td>
                                            @if($item['type'] == 'asc')
                                                <span>افزایش</span>
                                            @else
                                                <span>کسر</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item['source'] == 'wallet')
                                                <span>اعتبار</span>
                                            @elseif($item['source'] == 'income')
                                                <span>پشتیبانی</span>
                                            @elseif($item['source'] == 'income')
                                                <span>فروش</span>
                                            @elseif($item['source'] == 'affiliate')
                                                <span>اشتراک</span>
                                            @endif
                                        </td>

                                        <td>{{ number_format($item['price']) }}</td>
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
