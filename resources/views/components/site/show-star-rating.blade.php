@props(['isSmall' => false , 'ave' => 0])

<div class="flex space-x-1 rating dir-ltr">
    <label class="relative star-item">
        <span class="absolute -bottom-7 w-max bg-yellow-400 rounded-md py-1 px-2 text-xs font-bold tooltip">خیلی بد</span>
        <svg class="block {{ $isSmall ? 'w-5 h-5' : 'w-8 h-8' }}" fill="{{ $ave >= 1 ? '#FACC15' : '#E4E4E7' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
    </label>
    <label class="relative star-item">
        <span class="absolute -bottom-7 w-max bg-yellow-400 rounded-md py-1 px-2 text-xs font-bold tooltip">بد</span>
        <svg class="block {{ $isSmall ? 'w-5 h-5' : 'w-8 h-8' }}" fill="{{ $ave >= 2 ? '#FACC15' : '#E4E4E7' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
    </label>
    <label class="relative star-item">
        <span class="absolute -bottom-7 w-max bg-yellow-400 rounded-md py-1 px-2 text-xs font-bold tooltip">متوسط</span>
        <svg class="block {{ $isSmall ? 'w-5 h-5' : 'w-8 h-8' }}" fill="{{ $ave >= 3 ? '#FACC15' : '#E4E4E7' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
    </label>
    <label class="relative star-item">
        <span class="absolute -bottom-7 w-max bg-yellow-400 rounded-md py-1 px-2 text-xs font-bold tooltip">خوب</span>
        <svg class="block {{ $isSmall ? 'w-5 h-5' : 'w-8 h-8' }}" fill="{{ $ave >= 4 ? '#FACC15' : '#E4E4E7' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
    </label>
    <label class="relative star-item">
        <span class="absolute -bottom-7 w-max bg-yellow-400 rounded-md py-1 px-2 text-xs font-bold tooltip">عالی</span>
        <svg class="block {{ $isSmall ? 'w-5 h-5' : 'w-8 h-8' }}" fill="{{ $ave >= 5 ? '#FACC15' : '#E4E4E7' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
    </label>
</div>
