@extends('dashboard.master')

@section('content')
    <section>

        @include('dashboard.layouts.success-message')

        <div class="card">
            <div class="card-content">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <table class="table table-borderless line-height-2">
                                <tbody>
                                <tr>
                                    <td>نام:</td>
                                    <td class="bold">{{ $contact->name}}</td>
                                </tr>
                                <tr>
                                    <td>ایمیل:</td>
                                    <td class="bold">{{ $contact->email }}</td>
                                </tr>
                                <tr>
                                    <td>موبایل:</td>
                                    <td class="bold">{{ $contact->phone }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row bg-white rounded mb-2 mx-25 text-center text-lg-left">
            <div class="col-12 p-2">
                <p>{{ $contact->message }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if($contact->status == 'pending')
                        <form action="/dashboard/contacts/{{ $contact->id }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row">

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>وضعیت</label>
                                        <select class="form-control" name="status" required>
                                            <option value="completed">بررسی شده</option>
                                        </select>
                                        @include('dashboard.layouts.error' , ['item'=> 'status'])

                                    </div>
                                </div>

                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">ذخیره
                                    </button>
                                </div>
                            </div>
                        </form>
                    @elseif($contact->status == 'completed')
                        <span class="text-success">این پیام از قبل بررسی شده است.</span>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
