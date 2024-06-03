@extends('layouts.admin')

@section('title', 'Editar usuario')

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
                Editar usuario
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel de Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar usuario</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Editar usuario</h4>
                        </div>

                        {!! Form::model($user,['route'=>['users.update',$user],'method'=>'PUT']) !!}
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
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        
                        {{-- <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" id="password"  class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Rellenar solo si desea cambiar la contraseña</small>
                        </div> --}}
                        
                        @include('admin.user._form')
                        <div class="form-group">
                            <button id="actualizar" type="submit" class="btn btn-primary mr-2">Actualizar</button>
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

