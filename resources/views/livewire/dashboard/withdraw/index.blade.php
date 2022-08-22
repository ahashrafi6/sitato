<section class="users-list-wrapper">
    <div class="users-list-filter px-1">
        <div class="row border rounded py-2 mb-2">
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="cate">دسته</label>
                <fieldset class="form-group">
                    <select wire:model.lazy="cate" class="form-control" id="cate">
                        <option value="all">همه</option>
                        <option value="income">درآمد</option>
                        <option value="affiliate">همکاری در فروش</option>
                    </select>
                </fieldset>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="type">وضعیت</label>
                <fieldset class="form-group">
                    <select wire:model.lazy="status" class="form-control" id="type">
                        <option value="all">همه</option>
                        <option value="pending">در انتظار</option>
                        <option value="completed">انجام شده</option>
                        <option value="failed">رد شده</option>
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
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>کاربر</th>
                                <th>مبلغ (تومان)</th>
                                <th>دسته</th>
                                <th>نوع</th>
                                <th>وضعیت</th>
                                <th>زمان ثبت</th>
                                <th>زمان تسویه</th>
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($withdraws as $item)
                                <tr>
                                    <td>{{ $item->user->get_display_name() }}</td>
                                    <td>{{ number_format($item->amount) }}</td>
                                    <td>{{ \App\Models\Withdraw::CATE[$item->cate] }}</td>
                                    <td>{{ \App\Models\Withdraw::TYPE[$item->type] }}</td>
                                    <td>
                                        @if($item->status == 'completed')
                                            <span class="badge badge-light-success">انجام شده</span>
                                        @elseif($item->status == 'failed')
                                            <span class="badge badge-light-danger">رد شده</span>
                                        @else
                                            <span class="badge badge-light-warning">در انتظار</span>
                                        @endif
                                    </td>
                                    <td>{{ f_date($item->created_at) }}</td>
                                    <td>
                                        @if($item->payment_at)
                                            {{ f_date($item->payment_at) }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex items-center">
                                            <a href="{{ route('withdraws.edit' , ['withdraw' => $item->id]) }}">
                                                <i class="bx bx-edit-alt mr-1"></i></a>
                                            @if($item->status != 'completed')
                                                <div class="dropdown mr-1">
                                                  <span
                                                      class="bx bx-trash font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                      role="menu">
                                                 </span>
                                                    <div class="dropdown-menu">
                                                        <form
                                                            action="{{ route('withdraws.destroy' , ['withdraw' => $item->id]) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">حذف شود؟
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $withdraws->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


