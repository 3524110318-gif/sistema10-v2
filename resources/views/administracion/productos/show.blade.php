@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-box-seam me-2"></i>

                    Detalle del producto

                </h2>

                <p class="gtri-page-subtitle">

                    Información general del producto seleccionado.

                </p>

            </div>

            <a
                href="{{ route('administracion.productos.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>

        </div>

    </div>


    {{-- INFORMACIÓN GENERAL --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Información general

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Código

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $producto->codigo }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Nombre

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $producto->nombre }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Categoría

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $producto->categoria->nombre ?? 'Sin categoría' }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Tipo de producto

                </label>

                <div class="pt-2">

                    @if($producto->tipo_producto == 'activo')

                        <span class="badge gtri-badge-primary">

                            <i class="bi bi-box-seam me-1"></i>

                            Activo

                        </span>

                    @else

                        <span class="badge gtri-badge-info">

                            <i class="bi bi-basket me-1"></i>

                            Consumible

                        </span>

                    @endif

                </div>

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Unidad de medida

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $producto->unidad_medida }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Estado

                </label>

                <div class="pt-2">

                    @if($producto->estado == 'activo')

                        <span class="badge gtri-badge-success">

                            <i class="bi bi-check-circle me-1"></i>

                            Activo

                        </span>

                    @else

                        <span class="badge gtri-badge-danger">

                            <i class="bi bi-x-circle me-1"></i>

                            Inactivo

                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- INVENTARIO --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Inventario

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    En bodega

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $enBodega }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    En uso

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $enUso }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Total

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $total }}"
                    readonly
                >

            </div>

            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Stock mínimo

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $producto->stock_minimo }}"
                    readonly
                >

            </div>

            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Stock máximo

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $producto->stock_maximo ?? 'No definido' }}"
                    readonly
                >

            </div>

        </div>

    </div>


    {{-- COSTOS --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Costos

        </div>

        <div class="row g-4">

            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Precio de compra

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="${{ number_format(
                        $producto->precio_compra,
                        2
                    ) }}"
                    readonly
                >

            </div>

            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Precio promedio

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="${{ number_format(
                        $producto->precio_promedio,
                        2
                    ) }}"
                    readonly
                >

            </div>

        </div>

    </div>


    {{-- DESCRIPCIÓN --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>04</span>

            Descripción

        </div>

        <textarea
            class="form-control gtri-textarea"
            rows="4"
            readonly
        >{{ $producto->descripcion ?: 'Sin descripción registrada.' }}</textarea>

    </div>


    <div class="d-flex justify-content-end gap-2">

        <a
            href="{{ route(
                'administracion.productos.edit',
                $producto
            ) }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-pencil-square me-1"></i>

            Editar producto

        </a>

        <a
            href="{{ route('administracion.productos.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

    </div>

</div>

@endsection