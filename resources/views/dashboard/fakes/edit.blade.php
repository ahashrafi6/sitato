
@extends('dashboard.vue-master')

@section('content')

    <fake-edit
        :id="{{ json_encode($fakeproduct->id) }}"
        :cash="{{ json_encode($fakeproduct->cash) }}"
        :subscribe="{{ json_encode($fakeproduct->subscribe) }}"
        :per_cash="{{ json_encode($fakeproduct->per_cash) }}"
        :per_subscribe="{{ json_encode($fakeproduct->per_subscribe) }}"
        :minute="{{ json_encode($fakeproduct->minute) }}"
        :type="{{ json_encode($fakeproduct->type) }}"
    >

@endsection
