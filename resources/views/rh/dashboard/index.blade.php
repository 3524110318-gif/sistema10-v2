@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h1 class="mb-4">

        Bienvenido a RH

    </h1>


    <div class="row">

        <x-rh.dashboard-card
            titulo="Empleados activos"
            :valor="$empleados_activos"
            color="success"
            icono="👤"
        />


        <x-rh.dashboard-card
            titulo="Vacaciones pendientes"
            :valor="$vacaciones_pendientes"
            color="warning"
            text="dark"
            icono="🌴"
        />


        <x-rh.dashboard-card
            titulo="Incidencias pendientes"
            :valor="$incidencias_pendientes"
            color="info"
            icono="⚠️"
        />


        <x-rh.dashboard-card
            titulo="Expedientes incompletos"
            :valor="$expedientes_incompletos"
            color="secondary"
            icono="📁"
            :url="route('rh.expedientes.incompletos')"

        />


        <x-rh.dashboard-card
            titulo="Empleados inactivos"
            :valor="$empleados_inactivos"
            color="danger"
            icono="❌"
        />


        <x-rh.dashboard-card
            titulo="Total empleados"
            :valor="$total_empleados"
            color="primary"
            icono="📊"
        />

    </div>

</div>

@endsection
