@extends('layouts.gtri')

@section('titulo', 'GTRI Administración')

@section('nombre_modulo', 'Administración')

@section('nombre_sistema', 'Sistema Administración')


@section('menu')

    <x-rh.sidebar-link
        href="{{ route('administracion.dashboard') }}"
        active="administracion.dashboard"
    >

        <i class="bi bi-house-door me-2"></i>

        Inicio

    </x-rh.sidebar-link>


    <x-rh.sidebar-link
        href="{{ route('administracion.categorias.index') }}"
        active="administracion.categorias*"
    >

        <i class="bi bi-tags me-2"></i>

        Categorías

    </x-rh.sidebar-link>


    <x-rh.sidebar-link
        href="{{ route('administracion.productos.index') }}"
        active="administracion.productos*"
    >

        <i class="bi bi-box-seam me-2"></i>

        Productos

    </x-rh.sidebar-link>


    <x-rh.sidebar-link
        href="{{ route('administracion.proveedores.index') }}"
        active="administracion.proveedores*"
    >

        <i class="bi bi-truck me-2"></i>

        Proveedores

    </x-rh.sidebar-link>


    <x-rh.sidebar-link
        href="{{ route('administracion.compras.index') }}"
        active="administracion.compras*"
    >

        <i class="bi bi-cart-check me-2"></i>

        Compras

    </x-rh.sidebar-link>


    <x-rh.sidebar-link
        href="{{ route('administracion.activos.index') }}"
        active="administracion.activos*"
    >

        <i class="bi bi-pc-display me-2"></i>

        Activos

    </x-rh.sidebar-link>


    <x-rh.sidebar-link
        href="{{ route('administracion.asignaciones-activos.index') }}"
        active="administracion.asignaciones-activos*"
    >

        <i class="bi bi-person-check me-2"></i>

        Asignación de activos

    </x-rh.sidebar-link>


    <x-rh.sidebar-link
        href="{{ route('administracion.facturas.index') }}"
        active="administracion.facturas*"
    >

        <i class="bi bi-receipt me-2"></i>

        Facturación

    </x-rh.sidebar-link>


    <x-rh.sidebar-link
        href="{{ route('administracion.cobranzas.index') }}"
        active="administracion.cobranzas*"
    >

        <i class="bi bi-cash-stack me-2"></i>

        Cobranza

    </x-rh.sidebar-link>


    <x-rh.sidebar-link
        href="{{ route('administracion.prenominas.index') }}"
        active="administracion.prenominas*"
    >

        <i class="bi bi-calculator me-2"></i>

        Prenómina

    </x-rh.sidebar-link>

@endsection