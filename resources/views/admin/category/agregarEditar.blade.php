@extends('layouts.admin')

@section('title', isset($category) ? 'Editar categoría' : 'Agregar categoría')

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
                {{ isset($category) ? 'Editar categoría' : 'Agregar categoría' }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Panel de Administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ isset($category) ? 'Editar categoría' : 'Agregar categoría' }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form id="agregarEditarCategoriaForm"
                            action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($category))
                                @method('PUT')
                            @endif

                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ isset($category) ? $category->name : '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción:</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ isset($category) ? $category->description : '' }}</textarea>
                            </div>
                            <button type="submit"
                                class="btn btn-primary">{{ isset($category) ? 'Editar' : 'Agregar' }}</button>
                            <a class="btn btn-danger" href="{{ route('categories.index') }}">Volver</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('melody/js/data-table.js') !!}
@endsection