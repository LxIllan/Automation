@extends('layouts.base')

@section('content')

<!-- Breadcrumb -->
<div class="mb-3" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('customers.index') }}">Clientes</a>
        </li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
</div>
<!-- /.Breadcrumb -->

<!-- Page Header -->
<div class="row">
    <div class="col-12">
        <h3>Editar cliente</h3>
        <hr>
    </div>
</div>
<!-- /.Page Header -->

<!-- row -->
<div class="row">
    @include('layouts.errors')
    <div class="col-6">
        <form id="customerForm" action="{{ route('customers.update', $customer) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ $customer->name }}"
                    required>
                <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i></button>
            </div>
        </form>
    </div>
</div>
<!-- /row -->

@endsection