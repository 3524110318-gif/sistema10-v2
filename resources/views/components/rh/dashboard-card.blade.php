<div class="col-md-4">

    @if(isset($url))

        <a
            href="{{ $url }}"
            class="text-decoration-none"
        >

    @endif

    <div class="card bg-{{ $color }} text-{{ $text ?? 'white' }} mb-4 shadow rounded-4">

        <div class="card-body d-flex justify-content-between align-items-center">

            <div>

                <h5>

                    {{ $titulo }}

                </h5>

                <h1 class="display-4 fw-bold">

                    {{ $valor }}

                </h1>

            </div>

            <div style="font-size: 60px;">

                {{ $icono }}

            </div>

        </div>

    </div>

    @if(isset($url))

        </a>

    @endif

</div>
