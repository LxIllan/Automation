@extends('layouts.base')

@section('content')
<!-- Breadcrumb -->
<div class="mb-3" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a class="text-decoration-none"
                href="{{ route('inventories.index') }}">Inventarios</a>
        </li>
        <li class="breadcrumb-item active">Nuevo</li>
    </ol>
</div>
<!-- /.Breadcrumb -->

<!-- Page Header -->
<div class="row">
    <div class="col-12">
        <h3>Nuevo inventario</h3>
        <hr>
    </div>
</div>
<!-- /.Page Header -->

<!-- row -->
<div class="row">
    @include('layouts.errors')
    <div class="col-6">
        <form id="customerForm" action="{{ route('inventories.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" placeholder="Nombre" id="name" name="name"
                            value="{{ old('name') }}">
                        <label for="name">Nombre</label>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control mt-2" placeholder="Descripción" id="description"
                            name="description">{{ old('description') }}</textarea>
                        <label for="description">Descripción</label>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /row -->

@endsection