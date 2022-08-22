@extends('dashboard.vue-master')

@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    
                    <bundle-products :model="{{ json_encode(\App\Models\Bundle::class) }}" :id="{{ json_encode($bundle->id) }}" :products="{{ json_encode($bundle->products ?? []) }}"></bundle-products>

                </div>
            </div>
        </div>
    </section>
@endsection
