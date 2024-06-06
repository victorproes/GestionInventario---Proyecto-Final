@extends('layouts.admin')

@section('title', 'Gestión de categorías')

@section('styles')
    <style type="text/css">
        .unstyled-button {
            border: none;
            padding: 0;
            background: none;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Categorías</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel de Administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Categorías</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Categorías</h4>
                            <div class="col-lg-6">
                                <div class="text-lg-right mb-4">
                                    <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar Categoría</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
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
                                    @foreach ($categories as $category)
                                        <tr>
                                            <th scope="row">{{ $category->id }}</th>
                                            <td><a
                                                    href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                                            </td>
                                            <td>{{ $category->description }}</td>
                                            <td style="width:50px;">
                                                {!! Form::open([
                                                    
                                                    'route' => ['categories.destroy', $category],
                                                    'method' => 'DELETE',
                                                    'id' => 'delete-form-' . $category->id,
                                                ]) !!}
                                                
                                                 <a class="jsgrid-button jsgrid-edit-button" href="{{route('categories.show',$category)}}"><i class="far fa-eye"></i></a>
                                                <a class="jsgrid-button jsgrid-edit-button"
                                                    href="{{ route('categories.edit', $category) }}" title="Editar"><i
                                                        class="far fa-edit"></i></a>
                                                <button type="button"
                                                    class="jsgrid-button jsgrid-delete-button unstyled-button"
                                                    onclick="confirmDelete({{ $category->id }})" title="Eliminar"><i
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
                confirmButtonText: 'Sí, eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + categoryId).submit();
                }
            });
        }

        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, 3000);
    </script>
@endsection
