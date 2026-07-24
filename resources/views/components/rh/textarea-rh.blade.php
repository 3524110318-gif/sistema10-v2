@props([
    'label',
    'name',
    'placeholder' => ''
])

<div class="mb-4">

    <label
        for="{{ $name }}"
        class="form-label fw-semibold"
        style="color:#CBD5E1;"
    >
        {{ $label }}
    </label>

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control gtri-textarea"
        placeholder="{{ $placeholder }}"
    >{{ old($name, trim($slot ?? '')) }}</textarea>

</div>