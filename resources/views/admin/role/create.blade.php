@extends('layouts.admin')

@section('title', 'Registro de rol')

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
                Registro de rol
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel de Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Registro de rol</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registro de rol</h4>
                        </div>

                        {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
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
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name"  id="name" class="form-control" placeholder="" aria-describedby="helpId" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug"  class="form-control" placeholder="" aria-describedby="helpId" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                            </div>

                            @include('admin.role._form')
                            <button id="guardar" type="submit" class="btn btn-primary float-right">Registrar</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-light">Cancelar</a>
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

