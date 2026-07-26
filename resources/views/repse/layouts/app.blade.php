@extends('layouts.gtri')

@section('titulo', 'GTRI REPSE')

@section('nombre_modulo', 'REPSE')

@section('nombre_sistema', 'Sistema REPSE')

@section('menu')

    <x-rh.sidebar-link
        href="{{ route('repse.dashboard') }}"
        active="repse.dashboard"
    >

        <i class="bi bi-house-door me-2"></i>

        Inicio

    </x-rh.sidebar-link>

    <x-rh.sidebar-link
        href="{{ route('expedientes.index') }}"
        active="expedientes.*"
    >

        <i class="bi bi-folder2-open me-2"></i>

        Expedientes REPSE

    </x-rh.sidebar-link>

    <x-rh.sidebar-link
        href="{{ route('repse.generador.index') }}"
        active="repse.generador.*"
    >

        <i class="bi bi-file-earmark-zip me-2"></i>

        Generador Mensual

    </x-rh.sidebar-link>

@endsection