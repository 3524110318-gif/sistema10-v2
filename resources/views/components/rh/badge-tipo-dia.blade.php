@if ($tipo == 'laboral')

    <span class="badge bg-success">

        Laboral

    </span>

@elseif ($tipo == 'descanso')

    <span class="badge bg-warning text-dark">

        Descanso

    </span>

@elseif ($tipo == 'festivo')

    <span class="badge bg-danger">

        Festivo

    </span>

@else

    <span class="badge bg-info">

        Vacaciones

    </span>

@endif