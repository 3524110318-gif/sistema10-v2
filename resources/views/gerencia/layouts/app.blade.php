@extends('layouts.gtri')

@section('titulo', 'GTRI Gerencia')

@section('nombre_modulo', 'Gerencia')

@section('nombre_sistema', 'Sistema Gerencial')


@section('menu')

    <x-rh.sidebar-link
        href="{{ route('gerencia.dashboard') }}"
        active="gerencia.dashboard"
    >

        <i class="bi bi-house-door me-2"></i>

        Inicio

    </x-rh.sidebar-link>

    <x-rh.sidebar-link
        href="{{ route('gerencia.nomina-vip.index') }}"
        active="gerencia.nomina-vip.*"
    >

        <i class="bi bi-cash-stack me-2"></i>

        Nómina VIP

    </x-rh.sidebar-link>

    <x-rh.sidebar-link
        href="{{ route('gerencia.codigos.index') }}"
        active="gerencia.codigos.*"
    >

        <i class="bi bi-shield-lock me-2"></i>

        Control de Accesos

    </x-rh.sidebar-link>

    <x-rh.sidebar-link
        href="{{ route('gerencia.carpeta-flash.index') }}"
        active="gerencia.carpeta-flash.*"
    >

        <i class="bi bi-folder2-open me-2"></i>

        Carpeta Flash

    </x-rh.sidebar-link>

@endsection