@props([
    'label',
    'name',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
])

<div>

    <label
        for="{{ $name }}"
        class="form-label"
    >

        {{ $label }}

    </label>

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'form-control gtri-input'
        ]) }}
    >

    @error($name)

        <div class="text-danger small mt-1">

            {{ $message }}

        </div>

    @enderror

</div>