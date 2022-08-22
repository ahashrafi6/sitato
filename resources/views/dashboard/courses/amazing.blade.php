@extends('dashboard.vue-master')

@section('content')


    <amazing-product
        :slug="{{ json_encode($product->slug) }}"
        :price="{{ json_encode($product->offPrice) }}"
        :status="{{ json_encode($product->isOff ? '1' : '0') }}"
        :start_at="{{ json_encode($product->start_at) }}"
        :expire_at="{{ json_encode($product->expire_at) }}"
        :capacity="{{ json_encode($product->capacity) }}"
    >

@endsection
