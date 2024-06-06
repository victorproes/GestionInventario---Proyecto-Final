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

@section('options')
@endsection

@section('preference')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Proveedores
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel de Administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Proveedores</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Proveedores</h4>
                            <div class="col-lg-6">
                                <div class="text-lg-right mb-4">
                                    <a href="{{ route('providers.create') }}" class="btn btn-primary"><i
                                            class="fas fa-plus"></i> Agregar Proveedor</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>CIF</th>
                                        <th>Dirección</th>
                                        <th>Telefono</th>
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
                                    @foreach ($providers as $provider)
                                        <tr>
                                            <th scope="row">{{ $provider->id }}</th>
                                            <td><a href="{{ route('providers.show', $provider) }}">{{ $provider->name }}</a>
                                            </td>
                                            <td><a
                                                    href="{{ route('providers.show', $provider) }}">{{ $provider->email }}</a>
                                            </td>
                                            <td><a href="{{ route('providers.show', $provider) }}">{{ $provider->cif }}</a>
                                            </td>
                                            <td><a
                                                    href="{{ route('providers.show', $provider) }}">{{ $provider->address }}</a>
                                            </td>
                                            <td><a
                                                    href="{{ route('providers.show', $provider) }}">{{ $provider->phone }}</a>
                                            </td>
                                            <td>{{ $provider->description }}</td>
                                            <td style="width:100px;">
                                                {!! Form::open([
                                                    'route' => ['providers.destroy', $provider],
                                                    'method' => 'DELETE',
                                                    'id' => 'delete-form-' . $provider->id,
                                                ]) !!}
                                                <a class="jsgrid-button jsgrid-edit-button" href="{{route('providers.show',$provider)}}"><i class="far fa-eye"></i></a>
                                                <a class="jsgrid-button jsgrid-edit-button"
                                                    href="{{ route('providers.edit', $provider) }}" title="Editar"><i
                                                        class="far fa-edit"></i></a>
                                                <button type="button"
                                                    class="jsgrid-button jsgrid-delete-button unstyled-button"
                                                    onclick="confirmDelete({{ $provider->id }})" title="Eliminar"><i
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
    {!!Html::script('melody/js/data-table.js')!!}
    {!!Html::script('melody/js/sweetalert2@11')!!}
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

        setTimeout(function() {
        $(".alert-success").fadeOut();
    }, 3000); // Oculta el mensaje de éxito después de 3 segundos
    </script>
@endsection
