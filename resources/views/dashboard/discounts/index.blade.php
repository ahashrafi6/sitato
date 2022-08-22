@extends('dashboard.master')

@section('content')
    <section>
        @include('dashboard.layouts.success-message')
           <div class="text-right">
               <a class="btn btn-primary mb-1" href="{{ route('dashboard.discounts.create') }}">آیتم جدید</a>
           </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>کد</th>
                                    <th>درصد</th>
                                    <th>نوع</th>
                                    <th>ویرایش</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($discounts as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>%{{ $item->discount }}</td>
                                        <td>{{ \App\Models\Discount::TYPE[$item->type] }}</td>
                                        <td>
                                            <div class="d-flex items-center">
                                                <a href="{{ route('dashboard.discounts.edit' , ['discount' => $item->id]) }}"><i class="bx bx-edit-alt mr-1"></i></a>
                                                <div class="dropdown mr-1">
                                                  <span class="bx bx-trash font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                                 </span>
                                                    <div class="dropdown-menu">
                                                        <form action="{{ route('dashboard.discounts.destroy' , ['discount' => $item->id]) }}" method="POST">
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
                                {{ $discounts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>



@endsection
