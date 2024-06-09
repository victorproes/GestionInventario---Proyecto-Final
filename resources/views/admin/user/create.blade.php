@extends('layouts.admin')

@section('title', 'Registro de usuarios')

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
                Registro de usuarios
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel de Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Registro de usuarios</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registro de usuarios</h4>
                        </div>

                        {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder=""
                                aria-describedby="helpId" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder=""
                                aria-describedby="helpId" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder=""
                                aria-describedby="helpId" required>
                        </div>

                        @include('admin.user._form')
                        <div class="form-group">
                            <button id="guardar" type="submit" class="btn btn-primary float-right">Registrar</button>
                            <a href="{{ route('users.index') }}" class="btn btn-light">Cancelar</a>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    {!! Html::script('melody\js\sweetalert2@11.js') !!}
    {!! Html::script('melody\js\avgrund.js') !!}

    <script>
        // Ocultar automáticamente los mensajes de error después de 3 segundos
        setTimeout(function() {
            var nameError = document.getElementById('name-error');
            var descriptionError = document.getElementById('description-error');
            if (nameError) {
                nameError.style.display = 'none';
            }
            if (descriptionError) {
                descriptionError.style.display = 'none';
            }
        }, 3000);
    </script>


@endsection
