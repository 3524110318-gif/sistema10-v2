<div class="mb-4">

    <label class="form-label fw-semibold text-dark mb-2">

        {{ $label }}

    </label>

    <input

        type="{{ $type }}"

        name="{{ $name }}"

        value="{{ old($name, $value ?? '') }}"

        placeholder="{{ $placeholder ?? '' }}"

        @isset($required)
            required
        @endisset

        class="form-control rounded-4 {{ $errors->has($name) ? 'is-invalid' : '' }}"

        style="

            height: 52px;

            background: #FFFFFF;

            border: 1.5px solid #DCE3EA;

            box-shadow: 0 2px 6px rgba(0,0,0,0.03);

            transition: all .2s ease;

        "

    >

    @error($name)

        <div class="invalid-feedback d-block">

            {{ $message }}

        </div>

    @enderror

</div>