@extends('layouts.admin')

@section('title', isset($product) ? 'Editar Producto' : 'Agregar Producto')

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
                {{ isset($product) ? 'Editar producto' : 'Agregar producto' }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Panel de Administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ isset($product) ? 'Editar producto' : 'Agregar producto' }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form id="agregarEditarProviderForm"
                            action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($product))
                                @method('PUT')
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', isset($product) ? $product->name : '') }}" required>
                                @error('name')
                                    <div id="name-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sell_price">Precio de venta:</label>
                                <input type="number" class="form-control" id="sell_price" name="sell_price"
                                    value="{{ old('sell_price', isset($product) ? $product->sell_price : '') }}" required>
                                @error('sell_price')
                                    <div id="sell_price-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category_id">Categoría:</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if (isset($product) && $category->id == $product->category_id) selected @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div id="category_id-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="provider_id">Proveedor:</label>
                                <select class="form-control" name="provider_id" id="provider_id">
                                    @foreach ($providers as $provider)
                                        <option value="{{ $provider->id }}"
                                            @if (isset($product) && $provider->id == $product->provider_id) selected @endif>
                                            {{ $provider->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('provider_id')
                                    <div id="provider_id-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="card-body">
                                <h4 class="card-title d-flex">Imagen de producto
                                    <small class="ml-auto align-self-end">
                                        <a href="dropify.html" class="font-weight-light" target="_blank"></a>
                                    </small>
                                </h4>
                                <input type="file" class="dropify" id="picture" name="picture" />
                                @error('picture')
                                    <div id="picture-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit"
                                class="btn btn-primary">{{ isset($product) ? 'Editar' : 'Agregar' }}</button>
                            <a class="btn btn-danger" href="{{ route('products.index') }}">Volver</a>
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

            var sellPriceError = document.getElementById('sell_price-error');
            if (sellPriceError) {
                sellPriceError.style.display = 'none';
            }

            var categoryIdError = document.getElementById('category_id-error');
            if (categoryIdError) {
                categoryIdError.style.display = 'none';
            }

            var providerIdError = document.getElementById('provider_id-error');
            if (providerIdError) {
                providerIdError.style.display = 'none';
            }

            var imageError = document.getElementById('picture-error');
            if (imageError) {
                imageError.style.display = 'none';
            }
        }, 3000);
    </script>


<script>
    setTimeout(function() {
        $(".alert-success").fadeOut();
    }, 3000); // Oculta el mensaje de éxito después de 3 segundos

   
</script>



@endsection
