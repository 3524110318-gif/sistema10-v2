@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-cart-plus me-2"></i>

                    Nueva compra

                </h2>

                <p class="gtri-page-subtitle">

                    Registre una nueva compra realizada a un proveedor.

                </p>

            </div>

            <a
                href="{{ route('administracion.compras.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>

        </div>

    </div>


    <div class="gtri-card">

        <form
            action="{{ route('administracion.compras.store') }}"
            method="POST"
        >

            @csrf

            @include('administracion.compras._form')

        </form>

    </div>

</div>

@endsection