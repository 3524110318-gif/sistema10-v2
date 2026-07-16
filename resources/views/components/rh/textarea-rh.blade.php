<div class="mb-4">

    <label class="form-label fw-semibold text-dark mb-2">

        {{ $label }}

    </label>

    <textarea

        name="{{ $name }}"

        rows="{{ $rows ?? 3 }}"

        placeholder="{{ $placeholder ?? '' }}"

        class="form-control rounded-4"

        style="

            background: #FFFFFF;

            border: 1.5px solid #DCE3EA;

            box-shadow: 0 2px 6px rgba(0,0,0,0.03);

            transition: all .2s ease;

        "

    >{{ $slot }}</textarea>

</div>