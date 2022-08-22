<section>
    <div class="text-right">
        <a class="btn btn-primary mb-1" href="{{ route('articles.create') }}">مقاله جدید</a>
    </div>
    @include('dashboard.layouts.success-message')
    <div class="users-list-filter px-1">
        <div class="row border rounded py-2 mb-2">
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="type">وضعیت</label>
                <fieldset class="form-group">
                    <select wire:model.lazy="status" class="form-control" id="type">
                        <option value="all">همه</option>
                        @foreach(\App\Models\Article::STATUS as $key => $type)
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
                            <th>عنوان</th>
                            <th>دسته</th>
                            <th>وضعیت</th>
                            <th>ویرایش</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $item)
                            <tr>
                                <td>{{ $item->fa_title }}</td>
                                <td>{{ $item->category->fa_title }}</td>
                                <td>
                                    @if($item['status'] == 'published')
                                        <span class="badge badge-light-success">منتشر شده</span>
                                    @elseif($item['status'] == 'pending')
                                        <span class="badge badge-light-warning">در حال بررسی</span>
                                    @elseif($item['status'] == 'draft')
                                        <span class="badge badge-light-primary">پیش نویس</span>
                                    @else
                                        <span class="badge badge-light-danger">رد شده</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex items-center">
                                        <a href="{{ route('articles.edit' , ['article' => $item->slug]) }}"><i class="bx bx-edit-alt mr-1"></i></a>
                                        <div class="dropdown mr-1">
                                                  <span class="bx bx-trash font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                                 </span>
                                            <div class="dropdown-menu">
                                                <form action="{{ route('articles.destroy' , ['article' => $item->slug]) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">حذف شود؟</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
