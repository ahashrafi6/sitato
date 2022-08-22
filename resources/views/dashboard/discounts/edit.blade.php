
@extends('dashboard.vue-master')

@section('content')

    <discount-edit
        :id="{{ json_encode($discount->id) }}"
        :title="{{ json_encode($discount->title) }}"
        :code="{{ json_encode($discount->code) }}"
        :discount="{{ json_encode($discount->discount) }}"
        :capacity="{{ json_encode($discount->capacity) }}"
        :capacity_per_user="{{ json_encode($discount->capacity_per_user) }}"
        :type="{{ json_encode($discount->type) }}"
        :start_at="{{ json_encode($discount->start_at) }}"
        :expire_at="{{ json_encode($discount->expire_at) }}"
    >

@endsection
