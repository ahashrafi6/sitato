<section>
    <div class="text-right">
        <a class="btn btn-primary mb-1" href="{{ route('bundles.create') }}">پکیج جدید</a>
    </div>
    @include('dashboard.layouts.success-message')
    <div class="users-list-filter px-1">
        <div class="row border rounded py-2 mb-2">
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="type">وضعیت</label>
                <fieldset class="form-group">
                    <select wire:model.lazy="status" class="form-control" id="type">
                        <option value="all">همه</option>
                        @foreach(\App\Models\Bundle::STATUS as $key => $type)
                            <option value="{{ $key }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>نام</th>
                            <th>قیمت</th>
                            <th>فروش</th>
                            <th>ویرایش</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bundles as $item)
                            <tr>
                                <td>{{ $item->fa_title }}</td>
                                <td>{{ number_format($item->offPrice) }}</td>
                                <td>{{ number_format($item->sale) }}</td>
                                <td>
                                    <div class="d-flex items-center">
                                        <a href="{{ route('bundles.edit' , ['bundle' => $item->slug]) }}"><i class="bx bx-edit-alt mr-1"></i></a>
                                        <a href="{{ route('bundles.product' , ['bundle' => $item->slug]) }}"><i class="bx bx-star mr-1"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $bundles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
