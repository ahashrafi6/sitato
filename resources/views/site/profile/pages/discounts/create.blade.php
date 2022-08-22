@extends('site.profile.vue-master')

@section('body')
    <discount-create
        :products="{{ json_encode($products) }}">
    </discount-create>

@endsection
