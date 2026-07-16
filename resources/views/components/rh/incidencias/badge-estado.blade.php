@if ($estado == 'pendiente')

    <span class="badge bg-warning text-dark">

        Pendiente

    </span>

@elseif ($estado == 'justificada')

    <span class="badge bg-success">

        Justificada

    </span>

@else

    <span class="badge bg-danger">

        Injustificada

    </span>

@endif