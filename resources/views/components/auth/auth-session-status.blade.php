@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 bg-green-100 border border-green-300 px-3 py-2 rounded-md']) }}>
        {{ $status }}
    </div>
@endif
