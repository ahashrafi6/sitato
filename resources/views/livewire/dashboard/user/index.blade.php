<section class="users-list-wrapper">
        <div class="users-list-filter px-1">
                <div class="row border rounded py-2 mb-2">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <fieldset class="form-group">
                            <label for="email">ایمیل</label>
                            <input wire:model.lazy="email" type="text" class="form-control" id="email" placeholder="ایمیل را وارد کنید">
                        </fieldset>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <fieldset class="form-group">
                            <label for="phone">موبایل</label>
                            <input wire:model.lazy="phone" type="text" class="form-control" id="phone" placeholder="موبایل را وارد کنید">
                        </fieldset>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <fieldset class="form-group">
                            <label for="username">نام کاربری</label>
                            <input wire:model.lazy="username" type="text" class="form-control" id="username" placeholder="نام کاربری را وارد کنید">
                        </fieldset>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <label for="type">نوع کاربری</label>
                        <fieldset class="form-group">
                            <select wire:model.lazy="type" class="form-control" id="type">
                                <option value="all">همه</option>
                                <option value="user">کاربر</option>
                                <option value="author">فروشنده</option>
                                <option value="admin">مدیر</option>
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
                                    <th>نام</th>
                                    <th>ایمیل</th>
                                    <th>موبایل</th>
                                    <th>نام کاربری</th>
                                    <th>نقش</th>
                                    <th>تایید ایمیل</th>
                                    <th>تایید موبایل</th>
                                    <th>ویرایش</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name . ' ' . $user->family}}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ \App\Models\User::TYPE[$user->type] }}</td>
                                        <td>
                                            @if(!is_null($user->email_verified_at))
                                                <span :wire:key="$user->id" wire:click="verifyEmail('unverified' , '{{ $user->id }}')" data-toggle="tooltip" data-placement="bottom" data-original-title="تغییر به عدم تایید" class="badge badge-light-success cursor-pointer">تایید</span>
                                            @else
                                                <span :wire:key="$user->id" wire:click="verifyEmail('verified' , '{{ $user->id }}')" data-toggle="tooltip" data-placement="bottom" data-original-title="تغییر به تایید" class="badge badge-light-danger cursor-pointer">عدم تایید</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!is_null($user->phone_verified_at))
                                                <span :wire:key="$user->id" wire:click="verifyPhone('unverified' , '{{ $user->id }}')" data-toggle="tooltip" data-placement="bottom" data-original-title="تغییر به عدم تایید" class="badge badge-light-success cursor-pointer">تایید</span>
                                            @else
                                                <span :wire:key="$user->id" wire:click="verifyPhone('verified' ,'{{ $user->id }}')" data-toggle="tooltip" data-placement="bottom" data-original-title="تغییر به تایید" class="badge badge-light-danger cursor-pointer">عدم تایید</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex items-center">
                                                <a href="{{ route('users.edit' , ['user' => $user->id]) }}"><i class="bx bx-edit-alt mr-1"></i></a>
                                                <div class="dropdown mr-1">
                                                  <span class="bx bx-trash font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                                 </span>
                                                    <div class="dropdown-menu">
                                                        <form action="{{ route('users.destroy' , ['user' => $user->id]) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                                <button type="submit" class="dropdown-item">حذف شود؟</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="dropdown mr-1">
                                                  <span class="bx bx-dots-vertical font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                                 </span>
                                                    <div class="dropdown-menu">
                                                            <a href="{{ route('users.login' , ['user' => $user->id]) }}" class="dropdown-item">لاگین با این کاربر</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                           <div class="d-flex justify-content-end">
                               {{ $users->links() }}
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


