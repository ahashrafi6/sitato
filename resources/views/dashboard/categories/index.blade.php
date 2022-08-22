@extends('dashboard.master')

@section('content')
    <section>
        @include('dashboard.layouts.success-message')
           <div class="text-right">
               <a class="btn btn-primary mb-1" href="{{ route('categories.create') }}">دسته بندی جدید</a>
           </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>نام</th>
                                    <th>en</th>
                                    <th>حوزه</th>
                                    <th>پدر</th>
                                    <th>ویرایش</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $cate)
                                    <tr>
                                        <td>{{ $cate->fa_title }}</td>
                                        <td>{{ $cate->en_title }}</td>
                                        <td>{{ $cate->zone->fa_title }}</td>
                                        <td>{{ $cate->parent ? $cate->parent->fa_title : '' }}</td>
                                        <td>
                                            <div class="d-flex items-center">
                                                <a href="{{ route('categories.edit' , ['category' => $cate->slug]) }}"><i class="bx bx-edit-alt mr-1"></i></a>
                                                <div class="dropdown mr-1">
                                                  <span class="bx bx-trash font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                                 </span>
                                                    <div class="dropdown-menu">
                                                        <form action="{{ route('categories.destroy' , ['category' => $cate->slug]) }}" method="POST">
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
                        </div>
                    </div>
                </div>
            </div>
    </section>



@endsection
