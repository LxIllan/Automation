@extends('layouts.base')

@section('content')

<!-- Breadcrumb -->
<div class="mb-3" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Inventarios</li>
    </ol>
</div>
<!-- /.Breadcrumb -->

<!-- Page Header -->
<div class="row">
    <div class="col-12">
        <h3>Inventarios</h3>
        <hr>
    </div>
</div>
<!-- /.Page Header -->

<!-- row -->
<div class="row">
    <div class="text-center">
        <a href="{{ route('inventories.create') }}" class='btn btn-primary btn-sm'><span
                class='fa fa-fw fa-plus'></span></a>
    </div>
</div>
<!-- /row -->


@if (session('success'))
<div class="alert alert-success mt-2 alert-dismissible text-center">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong>{{ session('success') }}</strong>
</div>
@endif

<!-- row -->
<div class="row">
    <div class="table-responsive">
        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th>Inventario</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventories as $inventory)
                <tr>
                    <td>
                        <a class="text-decoration-none" href="{{ route('inventories.show', $inventory) }}">
                            {{ $inventory->name }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('inventories.edit', $inventory) }}" class='btn btn-light btn-sm'>
                            <span class='fa fa-fw fa-edit'></span>
                        </a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('inventories.destroy', $inventory) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class='btn btn-secondary btn-sm'>
                                <span class='fa fa-fw fa-trash'></span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- /row -->

@endsection