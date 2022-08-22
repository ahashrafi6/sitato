@extends('dashboard.master')

@section('content')
    <section>
        @include('dashboard.layouts.success-message')
           <div class="text-right">
               <a class="btn btn-primary mb-1" href="{{ route('tags.create') }}">تگ جدید</a>
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
                                    <th>ویرایش</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{{ $tag->fa_title }}</td>
                                        <td>{{ $tag->en_title }}</td>
                                        <td>{{ $tag->zone->fa_title }}</td>
                                        <td>
                                            <div class="d-flex items-center">
                                                <a href="{{ route('tags.edit' , ['tag' => $tag->slug]) }}"><i class="bx bx-edit-alt mr-1"></i></a>
                                                <div class="dropdown mr-1">
                                                  <span class="bx bx-trash font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                                 </span>
                                                    <div class="dropdown-menu">
                                                        <form action="{{ route('tags.destroy' , ['tag' => $tag->slug]) }}" method="POST">
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
