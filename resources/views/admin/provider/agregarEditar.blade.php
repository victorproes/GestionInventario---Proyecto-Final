@extends('layouts.admin')

@section('title', 'Agregar Proveedor')

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
                {{ isset($provider) ? 'Editar proveedor' : 'Agregar proveedor' }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('providers.index') }}">Panel de Administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ isset($provider) ? 'Editar proveedor' : 'Agregar proveedor' }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form id="agregarEditarProviderForm"
                            action="{{ isset($provider) ? route('providers.update', $provider) : route('providers.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($provider))
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
                                    value="{{ old('name', isset($provider) ? $provider->name : '') }}" required>
                                @error('name')
                                    <div id="name-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', isset($provider) ? $provider->email : '') }}" required>
                                @error('email')
                                    <div id="email-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cif">CIF:</label>
                                <input type="text" class="form-control" id="cif" name="cif"
                                    value="{{ old('cif', isset($provider) ? $provider->cif : '') }}" required>
                                @error('cif')
                                    <div id="cif-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Dirección:</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ old('address', isset($provider) ? $provider->address : '') }}" required>
                                @error('address')
                                    <div id="address-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Teléfono:</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', isset($provider) ? $provider->phone : '') }}" required>
                                @error('phone')
                                    <div id="phone-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit"
                                class="btn btn-primary">{{ isset($provider) ? 'Editar' : 'Agregar' }}</button>
                            <a class="btn btn-danger" href="{{ route('providers.index') }}">Volver</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('melody/js/data-table.js') !!}
    <script>
        setTimeout(function() {
            var nameError = document.getElementById('name-error');
            if (nameError) {
                nameError.style.display = 'none';
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

            var phoneError = document.getElementById('phone-error');
            if (phoneError) {
                phoneError.style.display = 'none';
            }
        }, 3000);

        setTimeout(function() {
        $(".alert-success").fadeOut();
    }, 3000); // Oculta el mensaje de éxito después de 3 segundos
    </script>
@endsection
