@extends('layouts.gtri')

@section('titulo', 'GTRI Comercial')

@section('nombre_modulo', 'Comercial')

@section('nombre_sistema', 'Sistema Comercial')

@section('menu')

    <x-rh.sidebar-link
        href="{{ route('comercial.dashboard') }}"
        active="comercial.dashboard"
    >

        <i class="bi bi-house-door me-2"></i>

        Inicio

    </x-rh.sidebar-link>

    <x-rh.sidebar-link
        href="{{ route('comercial.prospectos.index') }}"
        active="comercial.prospectos*"
    >

        <i class="bi bi-person-lines-fill me-2"></i>

        Prospectos

    </x-rh.sidebar-link>

    <x-rh.sidebar-link
        href="{{ route('comercial.clientes.index') }}"
        active="comercial.clientes*"
    >

        <i class="bi bi-buildings me-2"></i>

        Clientes

    </x-rh.sidebar-link>

    <x-rh.sidebar-link
        href="{{ route('comercial.cotizaciones.index') }}"
        active="comercial.cotizaciones*"
    >

        <i class="bi bi-file-earmark-text me-2"></i>

        Cotizaciones

    </x-rh.sidebar-link>

    <x-rh.sidebar-link
        href="{{ route('comercial.contratos.index') }}"
        active="comercial.contratos*"
    >

        <i class="bi bi-file-earmark-check me-2"></i>

        Contratos

    </x-rh.sidebar-link>

@endsection
