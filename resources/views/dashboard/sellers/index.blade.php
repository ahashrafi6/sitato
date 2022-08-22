@extends('dashboard.master')

@section('content')
    <section>
        @include('dashboard.layouts.success-message')
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>کاربر</th>
                                <th>وضعیت</th>
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sellers as $item)
                                <tr>
                                    <td>{{ $item->user->email }}</td>
                                    <td>
                                        @if($item->status == 'verified')
                                            <span class="badge badge-light-success">تایید شده</span>
                                        @elseif($item->status == 'failed')
                                            <span class="badge badge-light-danger">رد شده</span>
                                        @else
                                            <span class="badge badge-light-warning">در انتظار بررسی</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex items-center">
                                            <a href="{{ route('sellers.show' , ['seller' => $item->id]) }}"><i
                                                    class="bx bx-edit-alt mr-1"></i></a>
                                            <div class="dropdown mr-1">
                                                  <span
                                                      class="bx bx-trash font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                      role="menu">
                                                 </span>
                                                <div class="dropdown-menu">
                                                    <form
                                                        action="{{ route('sellers.destroy' , ['seller' => $item->id]) }}"
                                                        method="POST">
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
                            {{ $sellers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
