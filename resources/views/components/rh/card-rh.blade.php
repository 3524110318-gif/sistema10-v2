<div

    class="bg-white rounded-4 p-4 mb-4"

    style="

        border: 1px solid #E7ECF1;

        box-shadow: 0 4px 14px rgba(15,23,42,.04);

    "

>

    @if(isset($titulo))

        <div class="mb-4">

            <h5 class="fw-bold mb-0">

                {{ $titulo }}

            </h5>

        </div>

    @endif

    {{ $slot }}

</div>