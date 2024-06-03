@extends('layouts.admin')

@section('title', isset($client) ? 'Editar Cliente' : 'Agregar Cliente')

@section('styles')
@endsection

@section('options')
@endsection

@section('preference')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ isset($client) ? 'Editar cliente' : 'Agregar cliente' }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Panel de Administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ isset($client) ? 'Editar cliente' : 'Agregar cliente' }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form id="agregarEditarProviderForm"
                            action="{{ isset($client) ? route('clients.update', $client) : route('clients.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($client))
                                @method('PUT')
                            @endif
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
                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', isset($client) ? $client->name : '') }}" required>
                                @error('name')
                                    <div id="name-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="dni">DNI:</label>
                                <input type="text" class="form-control" id="dni" name="dni"
                                    value="{{ old('dni', isset($client) ? $client->dni : '') }}" required>
                                @error('dni')
                                    <div id="dni-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="cif">CIF:</label>
                                <input type="text" class="form-control" id="cif" name="cif"
                                    value="{{ old('cif', isset($client) ? $client->cif : '') }}">
                                @error('cif')
                                    <div id="cif-error" class="text-danger">{{ $message }}</div>
                                @enderror
                                <small id="helpId" class="form-text text-muted">Este campo es opcional</small>
                            </div>

                            <div class="form-group">
                                <label for="phone">Teléfono:</label>
                                <input type="number" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', isset($client) ? $client->phone : '') }}">
                                @error('phone')
                                    <div id="phone-error" class="text-danger">{{ $message }}</div>
                                @enderror
                                <small id="helpId" class="form-text text-muted">Este campo es opcional</small>
                            </div>

                            <div class="form-group">
                                <label for="address">Dirección:</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ old('address', isset($client) ? $client->address : '') }}">
                                @error('address')
                                    <div id="address-error" class="text-danger">{{ $message }}</div>
                                @enderror
                                <small id="helpId" class="form-text text-muted">Este campo es opcional</small>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', isset($client) ? $client->email : '') }}">
                                @error('email')
                                    <div id="email-error" class="text-danger">{{ $message }}</div>
                                @enderror
                                <small id="helpId" class="form-text text-muted">Este campo es opcional</small>
                            </div>



                            <button type="submit"
                                class="btn btn-primary">{{ isset($client) ? 'Editar' : 'Agregar' }}</button>
                            <a class="btn btn-danger" href="{{ route('clients.index') }}">Volver</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('melody/js/data-table.js') !!}
    {!! Html::script('melody/js/dropify.js') !!}
    <script>
        setTimeout(function() {
            var nameError = document.getElementById('name-error');
            if (nameError) {
                nameError.style.display = 'none';
            }

            var dniError = document.getElementById('dni-error');
            if (dniError) {
                dniError.style.display = 'none';
            }

            var phoneError = document.getElementById('phone-error');
            if (phoneError) {
                phoneError.style.display = 'none';
            }

            var emailError = document.getElementById('email-error');
            if (emailError) {
                emailError.style.display = 'none';
            }

            var cifError = document.getElementById('cif-error');
            if (cifError) {
                cifError.style.display = 'none';
            }

            var addressError = document.getElementById('address-error');
            if (addressError) {
                addressError.style.display = 'none';
            }

        }, 3000);


        // Ocultar automáticamente los mensajes de éxito y error después de 3 segundos
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, 3000);
    </script>
@endsection
