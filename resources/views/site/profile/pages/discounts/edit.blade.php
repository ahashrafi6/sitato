@extends('site.profile.vue-master')

@section('body')
    <discount-edit
        :id="{{ json_encode($discount->id) }}"
        :title="{{ json_encode($discount->title) }}"
        :code="{{ json_encode($discount->code) }}"
        :discount="{{ json_encode($discount->discount) }}"
        :capacity="{{ json_encode($discount->capacity) }}"
        :capacity_per_user="{{ json_encode($discount->capacity_per_user) }}"
        :products="{{ json_encode($discount->products) }}"
        :start_at="{{ json_encode($discount->start_at) }}"
        :expire_at="{{ json_encode($discount->expire_at) }}"
        :product_lists="{{ json_encode($product_lists) }}"
    >
    </discount-edit>

@endsection
