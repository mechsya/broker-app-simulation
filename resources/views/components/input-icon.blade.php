@if (isset($label))
    <div class="my-2">
        <label class="text-white/70 " for="{{ $name }}">{{ $label }}</label>
    </div>
@endif

<div class="flex text-white/70 w-full items-center h-[50px] relative border rounded-lg overflow-hidden border-white/30">
    <div class="bg-background outline-none p-4 border-r border-white/30  rounded-l-lg h-[50px] lg:h-[50px]">
        {!! $icon !!}
    </div>
    <input type="{{ !isset($type) ? 'text' : $type }}" id="{{ $name }}" name="{{ $name }}"
        {{ isset($required) ? 'required' : '' }} value="{{ @$value }}" {{ isset($readonly) ? 'readonly' : '' }}
        class="text-white/50 w-full mt-2 h-[50px] outline-none rounded-r-lg p-3 bg-black mb-2">
</div>
