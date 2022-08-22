<section class="users-list-wrapper">
    <div class="users-list-filter px-1">
        <div class="row border rounded py-2 mb-2">
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="status">وضعیت</label>
                <fieldset class="form-group">
                    <select wire:model.lazy="status" class="form-control" id="status">
                        <option value="all">همه</option>
                        <option value="pending">در انتظار</option>
                        <option value="completed">انجام شده</option>
                        <option value="fail">رد شده</option>
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
                    @if(count($installs) > 0)
                        <p class="text-center" wire:loading>در حال بارگذاری...</p>
                        <div wire:loading.remove class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>کاربر</th>
                                    <th>محصول</th>
                                    <th>دامنه</th>
                                    <th>مبلغ</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($installs as $item)
                                    <tr>
                                        <td>{{ \App\Models\User::find($item['user_id'])->get_display_name() }}</td>
                                        <td>{{ \App\Models\Product::find($item['product_id'])->fa_title }}</td>
                                        <td>{{ $item['domain'] }}</td>
                                        <td>{{ number_format($item['price']) }}</td>
                                        <td>
                                            @if($item['status'] == 'completed')
                                                <span class="badge badge-light-success">انجام شده</span>
                                            @elseif($item['status'] == 'fail')
                                                <span class="badge badge-light-danger">رد شده</span>
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
                                <span class="badge badge-success line-height-2 mx-1 font-size-base">{{ $current_page }}</span>
                                <a class="cursor-pointer btn btn-primary text-white" wire:click="next()">بعدی</a>
                                <span class="badge badge-light line-height-2 mx-1 font-size-base">{{ $last_page }}</span>
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
