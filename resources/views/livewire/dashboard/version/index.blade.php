<section class="users-list-wrapper">
    <div class="users-list-filter px-1">
        <div class="row border rounded py-2 mb-2">
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="type">وضعیت</label>
                <fieldset class="form-group">
                    <select wire:model.lazy="status" class="form-control" id="type">
                        <option value="all">همه</option>
                        @foreach(\App\Models\Version::STATUS as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
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
                                <th>محصول</th>
                                <th>نسخه</th>
                                <th>وضعیت</th>
                                <th>زمان ثبت</th>
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($versions as $item)
                                <tr>
                                    <td>{{ $item->product->fa_title }}</td>
                                    <td>{{ $item->version }}</td>
                                    <td>
                                        @if($item->status == 'verified')
                                            <span class="badge badge-light-success">تایید شده</span>
                                        @elseif($item->status == 'fail')
                                            <span class="badge badge-light-danger">رد شده</span>
                                        @else
                                            <span class="badge badge-light-warning">در انتظار</span>
                                        @endif
                                    </td>
                                    <td>{{ f_date($item->created_at) }}</td>
                                    <td>
                                        <div class="d-flex items-center">
                                            <a href="{{ route('versions.edit' , ['version' => $item->id]) }}">
                                                <i class="bx bx-edit-alt mr-1"></i></a>

                                            @if($item->status != 'verified')
                                                <div class="dropdown mr-1">
                                                  <span
                                                      class="bx bx-trash font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                      role="menu">
                                                 </span>
                                                    <div class="dropdown-menu">
                                                        <form
                                                            action="{{ route('versions.destroy' , ['version' => $item->id]) }}"
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
                            {{ $versions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


