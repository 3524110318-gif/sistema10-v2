<div class="col-md-6 mb-4">

    <div class="card shadow-sm border-0 rounded-4 h-100">

        <div class="card-body">

            <h4 class="mb-3">

                {{ $documento }}

            </h4>


            @if ($archivoSubido)

                <span class="badge bg-success mb-3">

                    Entregado

                </span>

            @else

                <span class="badge bg-warning text-dark mb-3">

                    Pendiente

                </span>

            @endif


            {{ $slot }}

        </div>

    </div>

</div>
