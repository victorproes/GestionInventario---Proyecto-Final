@extends('layouts.admin')

@section('title', 'Gestión de clientes')

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
                Clientes
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel de Administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Clientes</h4>
                            <div class="col-lg-6">
                                <div class="text-lg-right mb-4">
                                    <a href="{{ route('clients.create') }}" class="btn btn-primary"><i
                                            class="fas fa-plus"></i> Agregar Cliente</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Dni</th>
                                        <th>Teléfono</th>
                                        <th>Correo electronico</th>
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
                                    @foreach ($clients as $client)
                                        <tr>
                                            <th scope="row">{{ $client->id }}</th>
                                            <td><a
                                                    href="{{ route('clients.show', $client) }}">{{ $client->name }}</a>
                                            </td>
                                            <td>{{ $client->dni }}</td>
                                            <td>{{ $client->phone }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td style="width:50px;">
                                                {!! Form::open([
                                                    'route' => ['clients.destroy', $client],
                                                    'method' => 'DELETE',
                                                    'id' => 'delete-form-' . $client->id,
                                                ]) !!}
                                                <a class="jsgrid-button jsgrid-edit-button"
                                                    href="{{ route('clients.edit', $client) }}" title="Editar"><i
                                                        class="far fa-edit"></i></a>
                                                <button type="button"
                                                    class="jsgrid-button jsgrid-delete-button unstyled-button"
                                                    onclick="confirmDelete({{ $client->id }})" title="Eliminar"><i
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

        // Ocultar automáticamente los mensajes de éxito y error después de 3 segundos
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, 3000);
    </script>
@endsection
