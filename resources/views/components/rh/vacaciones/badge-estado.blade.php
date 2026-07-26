@if ($estado == 'pendiente')

    <span class="badge bg-warning text-dark">

        Pendiente

    </span>

@elseif ($estado == 'aprobada')

    <span class="badge bg-success">

        Aprobada

    </span>

@elseif ($estado == 'rechazada')

    <span class="badge bg-danger">

        Rechazada

    </span>

@elseif ($estado == 'cancelada')

    <span class="badge bg-secondary">

        Cancelada

    </span>

@else

    <span class="badge bg-dark">

        Desconocido

    </span>

@endif