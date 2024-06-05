@extends('layouts.admin')

@section('title', 'Gestión de productos')

@section('styles')
    <style type="text/css">
        .unstyled-button {
            border: none;
            padding: 0;
            background: none;
        }
    </style>
@endsection

@section('options')
@endsection

@section('preference')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Productos
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel de Administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Productos</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Productos</h4>
                            <div class="col-lg-6">
                                <div class="text-lg-right mb-4">
                                    <a href="{{ route('products.create') }}" class="btn btn-primary"><i
                                            class="fas fa-plus"></i> Agregar Producto</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Stock</th>
                                        <th>Estado</th>
                                        <th>Categoría</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <th scope="row">{{ $product->id }}</th>
                                            <td><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                            </td>
                                            <td>{{ $product->stock }}</td>
                                            @if ($product->status == 'ACTIVE')
                                                <td>
                                                    <a class="jsgrid-button btn btn-success"
                                                        href="{{ route('change.status.products', $product) }}">Activo <i
                                                            class="fas fa-check"></i></a>
                                                </td>
                                            @else
                                                <td>
                                                    <a class="jsgrid-button btn btn-danger"
                                                        href="{{ route('change.status.products', $product) }}">Desactivado <i
                                                            class="fas fa-times"></i></a>
                                                </td>
                                            @endif
                                            <td>{{ $product->category->name }}</td>
                                            <td style="width:50px;">
                                                {!! Form::open([
                                                    'route' => ['products.destroy', $product],
                                                    'method' => 'DELETE',
                                                    'id' => 'delete-form-' . $product->id,
                                                ]) !!}
                                                <a class="jsgrid-button jsgrid-edit-button" href="{{route('products.show',$product)}}"><i class="far fa-eye"></i></a>
                                                <a class="jsgrid-button jsgrid-edit-button"
                                                    href="{{ route('products.edit', $product) }}" title="Editar"><i
                                                        class="far fa-edit"></i></a>
                                                <button type="button"
                                                    class="jsgrid-button jsgrid-delete-button unstyled-button"
                                                    onclick="confirmDelete({{ $product->id }})" title="Eliminar"><i
                                                        class="far fa-trash-alt"></i></button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('melody/js/data-table.js') !!}
    {!! Html::script('melody/js/sweetalert2@11') !!}
    <script>
        function confirmDelete(categoryId) {
            console.log(categoryId);
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario de eliminación
                    document.getElementById('delete-form-' + categoryId).submit();
                }
            });
        }
    </script>
@endsection
