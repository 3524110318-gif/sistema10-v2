@extends('layouts.gtri')

@section('titulo', 'GTRI Operaciones')

@section('nombre_modulo', 'Operaciones')

@section('nombre_sistema', 'Sistema Operaciones')


@section('menu')

    {{-- INICIO --}}
    <x-rh.sidebar-link
        href="{{ route('operaciones.dashboard') }}"
        active="operaciones.dashboard"
    >

        <i class="bi bi-house-door me-2"></i>

        Inicio

    </x-rh.sidebar-link>


    {{-- CLIENTES --}}
    <x-rh.sidebar-link
        href="{{ route('operaciones.clientes.index') }}"
        active="operaciones.clientes*"
    >

        <i class="bi bi-people me-2"></i>

        Clientes

    </x-rh.sidebar-link>


    {{-- CONTRATOS --}}
    <x-rh.sidebar-link
        href="{{ route('operaciones.contratos.index') }}"
        active="operaciones.contratos*"
    >

        <i class="bi bi-file-earmark-text me-2"></i>

        Contratos

    </x-rh.sidebar-link>


    {{-- SERVICIOS --}}
    <x-rh.sidebar-link
        href="{{ route('operaciones.servicios.index') }}"
        active="operaciones.servicios*"
    >

        <i class="bi bi-building me-2"></i>

        Servicios

    </x-rh.sidebar-link>


    {{-- PLAZAS OPERATIVAS --}}
    <x-rh.sidebar-link
        href="{{ route('operaciones.plazas.index') }}"
        active="operaciones.plazas*"
    >

        <i class="bi bi-geo-alt me-2"></i>

        Plazas Operativas

    </x-rh.sidebar-link>


    {{-- ASIGNACIONES --}}
    <x-rh.sidebar-link
        href="{{ route('operaciones.asignaciones.index') }}"
        active="operaciones.asignaciones*"
    >

        <i class="bi bi-person-check me-2"></i>

        Asignaciones

    </x-rh.sidebar-link>


    {{-- SUPERVISIONES --}}
    <x-rh.sidebar-link
        href="{{ route(
            'operaciones.supervisiones.index'
        ) }}"
        active="operaciones.supervisiones*"
    >

        <i class="bi bi-clipboard-check me-2"></i>

        Supervisiones

    </x-rh.sidebar-link>


    {{-- EVIDENCIAS --}}
    <x-rh.sidebar-link
        href="{{ route(
            'operaciones.evidencias.index'
        ) }}"
        active="operaciones.evidencias*"
    >

        <i class="bi bi-camera me-2"></i>

        Evidencias

    </x-rh.sidebar-link>


    {{-- INCIDENCIAS --}}
    <x-rh.sidebar-link
        href="{{ route(
            'operaciones.incidencias.index'
        ) }}"
        active="operaciones.incidencias*"
    >

        <i class="bi bi-exclamation-triangle me-2"></i>

        Incidencias

    </x-rh.sidebar-link>


    {{-- DOBLETES --}}
    <x-rh.sidebar-link
        href="{{ route(
            'operaciones.dobletes.index'
        ) }}"
        active="operaciones.dobletes*"
    >

        <i class="bi bi-clock-history me-2"></i>

        Dobletes

    </x-rh.sidebar-link>


    {{-- VEHÍCULOS --}}
    <x-rh.sidebar-link
        href="{{ route(
            'operaciones.vehiculos.index'
        ) }}"
        active="operaciones.vehiculos*"
    >

        <i class="bi bi-car-front me-2"></i>

        Vehículos

    </x-rh.sidebar-link>


    {{-- MANTENIMIENTOS --}}
    <x-rh.sidebar-link
        href="{{ route(
            'operaciones.mantenimientos.index'
        ) }}"
        active="operaciones.mantenimientos*"
    >

        <i class="bi bi-wrench-adjustable me-2"></i>

        Mantenimientos

    </x-rh.sidebar-link>

@endsection