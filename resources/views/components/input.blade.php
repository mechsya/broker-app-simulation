<label class="text-white/70" for="{{ $name }}">{{ $label }}</label>
<input type="{{ !isset($type) ? 'text' : $type }}" id="{{ $name }}" name="{{ $name }}"
    {{ isset($required) ? 'required' : '' }} {{ isset($readonly) ? 'readonly' : '' }} value="{{ @$value }}"
    placeholder="{{ isset($placeholder) ? $placeholder : "Enter $label" }}"
    class="text-white/50 w-full mt-2 border border-white/30 outline-none rounded-lg p-3 bg-black mb-4">
