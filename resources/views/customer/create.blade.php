@extends('layouts.base')

@section('content')

<!-- Breadcrumb -->
<div class="mb-3" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('customers.index') }}">Clientes</a>
        </li>
        <li class="breadcrumb-item active">Nuevo</li>
    </ol>
</div>
<!-- /.Breadcrumb -->

<!-- Page Header -->
<div class="row">
    <div class="col-12">
        <h3>Nuevo cliente</h3>
        <hr>
    </div>
</div>
<!-- /.Page Header -->

<!-- row -->
<div class="row">
    @if ($errors->any())
    <div class="alert alert-success mt-2 alert-dismissible text-center">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-6">
        <form id="customerForm" action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}"
                    required>
                <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i></button>
            </div>
        </form>
    </div>
</div>
<!-- /row -->

@endsection