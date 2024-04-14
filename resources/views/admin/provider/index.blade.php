@extends('layouts.admin')

@section('title', 'Gestión de categorías')

@section('styles')
<style type="text/css">
    .unstyled-button{
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
                            <div class="btn-group">
                                <a type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('providers.create') }}">Agregar</a>
                                    
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
                                        <th>Cif</th>
                                        <th>Address</th>
                                        <th>Teléfono</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($providers as $provider)
                                        <tr>
                                            <th scope="row">{{ $provider->id }}</th>
                                            <td><a href="{{ route('providers.show', $provider) }}">{{ $provider->name }}</a></td>
                                            <td><a href="{{ route('providers.show', $provider) }}">{{ $provider->email }}</a></td>
                                            <td><a href="{{ route('providers.show', $provider) }}">{{ $provider->cif }}</a></td>
                                            <td><a href="{{ route('providers.show', $provider) }}">{{ $provider->address }}</a></td>
                                            <td><a href="{{ route('providers.show', $provider) }}">{{ $provider->phone }}</a></td>
                                            <td>{{ $provider->description }}</td>
                                            <td style="width:50px;">
                                                <td style="width:50px;">
                                                    {!! Form::open(['route' => ['providers.destroy', $provider], 'method' => 'DELETE']) !!}
                                                    <a class="jsgrid-button jsgrid-edit-button" href="{{ route('providers.edit', $provider) }}" title="Editar"><i class="far fa-edit"></i></a>
                                                    <button type="submit" class="jsgrid-button jsgrid-delete-button unstyled-button" title="Eliminar"><i class="far fa-trash-alt"></i></button>
                                                    {!! Form::close() !!}
                                                </td>
                                                
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
@endsection
