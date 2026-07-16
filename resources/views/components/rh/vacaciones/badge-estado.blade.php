@if ($estado == 'pendiente')

    <span class="badge bg-warning text-dark">

        Pendiente

    </span>

@elseif ($estado == 'aprobada')

    <span class="badge bg-success">

        Aprobada

    </span>

@else

    <span class="badge bg-danger">

        Rechazada

    </span>

@endif