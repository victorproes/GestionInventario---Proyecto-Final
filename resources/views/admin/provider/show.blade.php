@extends('layouts.admin')
@section('title', 'Información del proveedor')
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
                {{ $provider->name }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('providers.index') }}">Proveedores</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $provider->name }}</li>
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
                                    <h3>{{ $provider->name }}</h3>
                                    <div class="d-flex justify-content-between">
                                    </div>
                                </div>
                                <div class="py-4">
                                    <div class="list-group">
                                        <button type="button" class="list-group-item list-group-item-action"
                                            onclick="showSection('provider-info')">
                                            Sobre proveedor
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action"
                                            onclick="showSection('products')">Productos</button>
                                        <button type="button" class="list-group-item list-group-item-action"
                                            onclick="showSection('register-product')">Registrar producto</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 pl-lg-5">
                                <!-- Información del proveedor -->
                                <div id="provider-info">
                                    <h3>Información de proveedor</h3>
                                    <div class="profile-feed">
                                        <div class="d-flex align-items-start profile-feed-item">
                                            <div class="form-group col-md-6">
                                                <strong><i class="fab fa-product-hunt mr-1"></i>Nombre</strong>
                                                <p class="text-muted">{{ $provider->name }}</p>
                                                <hr>
                                                <strong><i class="fas fa-address-card mr-1"></i>Numero de documento</strong>
                                                <p class="text-muted">{{ $provider->cif }}</p>
                                                <hr>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <strong><i class="fas fa-phone mr-1"></i>Teléfono</strong>
                                                <p class="text-muted">{{ $provider->phone }}</p>
                                                <hr>
                                                <strong><i class="fas fa-envelope mr-1"></i>Correo</strong>
                                                <p class="text-muted">{{ $provider->email }}</p>
                                                <hr>
                                                <strong><i class="fas fa-map-marked-alt mr-1"></i>Dirección</strong>
                                                <p class="text-muted">{{ $provider->address }}</p>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contenedor para mostrar los productos -->
                                <div id="products" style="display:none;">
                                    <h3>Productos del proveedor</h3>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Stock</th>
                                                <th>Precio</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($provider->products as $product)
                                                <tr>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->stock }}</td>
                                                    <td>{{ $product->sell_price }}</td>
                                                    <td>{{ $product->status }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Formulario para registrar un producto -->
                                <div id="register-product" style="display:none;">
                                    <h3>Registrar nuevo producto</h3>
                                    <form action="{{ route('products.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="provider_id" value="{{ $provider->id }}">
                                        <div class="form-group">
                                            <label for="name">Nombre del producto</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Descripción</label>
                                            <textarea name="description" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="sell_price">Precio</label>
                                            <input type="number" name="sell_price" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Categoría:</label>
                                            <select class="form-control" name="category_id" id="category_id">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="provider_id">Proveedor:</label>
                                            <select class="form-control" name="provider_id" id="provider_id">
                                                <option value="{{ $provider->id }}" selected>{{ $provider->name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title d-flex">Imagen de producto
                                                <small class="ml-auto align-self-end">
                                                    <a href="dropify.html" class="font-weight-light" target="_blank"></a>
                                                </small>
                                            </h4>
                                            <input type="file" class="dropify" id="picture" name="picture" />
                                        </div>
                                        <button type="submit" class="btn btn-primary">Registrar producto</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-muted">
                        <a href="{{ route('providers.index') }}" class="btn btn-primary float-right">Volver</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('melody/js/data-table.js') !!}
    {!! Html::script('melody/js/profile-demo.js') !!}
    <script>
        function showSection(sectionId) {
            document.getElementById('provider-info').style.display = 'none';
            document.getElementById('products').style.display = 'none';
            document.getElementById('register-product').style.display = 'none';

            document.getElementById(sectionId).style.display = 'block';
        }
    </script>
@endsection
