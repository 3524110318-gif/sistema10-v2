@extends('layouts.gtri')

@section('titulo', 'GTRI RH')

@section('nombre_modulo', 'Recursos Humanos')

@section('nombre_sistema', 'Sistema RH')


@section('menu')

    {{-- INICIO --}}
    <x-rh.sidebar-link
        href="{{ route('rh.dashboard') }}"
        active="rh.dashboard"
    >

        <i class="bi bi-house-door me-2"></i>

        Inicio

    </x-rh.sidebar-link>


    {{-- EMPLEADOS --}}
    <x-rh.sidebar-link
        href="{{ route('rh.empleados') }}"
        active="rh.empleados*"
    >

        <i class="bi bi-people me-2"></i>

        Empleados

    </x-rh.sidebar-link>


    {{-- VACACIONES --}}
    <x-rh.sidebar-link
        href="{{ route('rh.vacaciones.index') }}"
        active="rh.vacaciones*"
    >

        <i class="bi bi-calendar2-week me-2"></i>

        Vacaciones

    </x-rh.sidebar-link>


    {{-- RECLUTAMIENTO --}}
    <x-rh.sidebar-link
        href="{{ route('rh.prospectos.index') }}"
        active="rh.prospectos*"
    >

        <i class="bi bi-person-badge me-2"></i>

        Reclutamiento

    </x-rh.sidebar-link>


    {{-- CALENDARIO LABORAL --}}
    <x-rh.sidebar-link
        href="{{ route('rh.calendario.index') }}"
        active="rh.calendario*"
    >

        <i class="bi bi-calendar-event me-2"></i>

        Calendario laboral

    </x-rh.sidebar-link>


    {{-- INCIDENCIAS --}}
    <x-rh.sidebar-link
        href="{{ route('rh.incidencias.index') }}"
        active="rh.incidencias*"
    >

        <i class="bi bi-exclamation-triangle me-2"></i>

        Incidencias

    </x-rh.sidebar-link>

@endsection