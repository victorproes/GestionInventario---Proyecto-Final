@extends('layouts.admin')
@section('title', 'Información del cliente')
@section('styles')
@endsection
@section('create')
@endsection
@section('options')
@endsection
@section('preference')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ $client->name }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class=" breadcrumb-item"><a href="#">Panel administrador</a></li>
                    <li class=" breadcrumb-item"><a href="{{ route('clients.index') }}">Clientes</a></li>
                    <li class=" breadcrumb-item active" aria-current="page">{{ $client->name }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="border-bottom text-center pb-4">
                                    <h3>{{ $client->name }}</h3>
                                    <div class="d-flex justify-content-between">
                                    </div>
                                </div>
                                <div class="py-4">
                                    <div class="list-group">
                                        <button type="button" class="list-group-item list-group-item-action active btn btn-success">
                                            Sobre cliente
                                        </button>
                                        <button type="button"
                                            class="list-group-item list-group-item-action">Historial de compras</button>
                                        {{-- <button type="button" class="list-group-item list-group-item-action">Registrar
                                            cliente</button> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 pl-lg-5">
                                <div class="d-flex justify-content-between">
                                </div>
                                <h3>Información de cliente</h3>

                                <div class="profile-feed">
                                    <div class="d-flex align-items-start profile-feed-item">
                                        <div class="form-group col-md-6">
                                            <strong><i class="fab fa-product-hunt mr-1"></i>Nombre</strong>
                                            <p class="text-muted">{{ $client->name }}</p>


                                            <hr>
                                            <strong><i class="fas fa-address-card mr-1"></i>Numero de DNI</strong>
                                            <p class="text-muted">{{ $client->dni }}</p>
                                            <hr>
                                            <strong><i class="fas fa-address-card mr-1"></i>Numero de CIF</strong>
                                            <p class="text-muted">{{ $client->cif }}</p>
                                            <hr>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <strong><i class="fas fa-phone mr-1"></i>Teléfono</strong>
                                            <p class="text-muted">{{ $client->phone }}</p>
                                            <hr>
                                            <strong><i class="fas fa-envelope mr-1"></i>Correo</strong>
                                            <p class="text-muted">{{ $client->email }}</p>
                                            <hr>
                                            <strong><i class="fas fa-map-marked-alt mr-1"></i>Dirección</strong>
                                            <p class="text-muted">{{ $client->address }}</p>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-muted">
                        <a href="{{ route('clients.index') }}" class="btn btn-primary float-right">Volver</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('melody/js/data-table.js') !!}
    {!! Html::script('melody/js/profile-demo.js') !!}
@endsection
