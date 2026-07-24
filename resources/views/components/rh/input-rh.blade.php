<div class="mb-4">

    <label
        class="form-label fw-semibold"
        style="color: #CBD5E1;"
    >
        {{ $label }}
    </label>

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value ?? '') }}"
        class="form-control gtri-input"
    >

    @error($name)

        <div class="invalid-feedback d-block">

            {{ $message }}

        </div>

    @enderror

</div>