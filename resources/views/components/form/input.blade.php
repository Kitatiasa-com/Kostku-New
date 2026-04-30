@props([
'label' => '',
'name',
'type' => 'text',
'placeholder' => '',
'value' => '',
'required',
'readonly' => false,
])

<div class="space-y-2">

    @if($label)
    <label
        for="{{ $name }}"
        class="block text-sm font-medium text-neutral">
        {{ $label }}
    </label>
    @endif

    <input
        id="{{ $name }}"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        required
        @readonly($readonly)

        {{ $attributes->merge([
            'class' => '
                w-full
                rounded-md
                border
                border-[#888888]
                px-4
                py-3
                focus:outline-none
                focus:ring-1
                focus:ring-primary
                focus:border-primary
                placeholder:text-neutral
            '
        ]) }}>

    @error($name)
    <p class="text-sm text-red-500">
        {{ $message }}
    </p>
    @enderror

</div>