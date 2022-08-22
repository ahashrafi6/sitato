@props(['name'])

@error ($name)
<div class="flex items-center dir-rtl mt-1">
    <i class="fad fa-exclamation-circle text-sm text-red-300 pl-1"></i>
    <p class="text-red-500 text-xs">{{ $message }}</p>
</div>
@enderror
