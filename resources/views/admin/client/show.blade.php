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
                    <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Clientes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $client->name }}</li>
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
                                        <button type="button" id="btnClientInfo" class="list-group-item list-group-item-action active">
                                            Sobre cliente
                                        </button>
                                        <button type="button" id="btnPurchaseHistory" class="list-group-item list-group-item-action">
                                            Historial de compras
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 pl-lg-5">
                                <div id="clientInfo" class="profile-feed">
                                    <h3>Información de cliente</h3>
                                    <div class="d-flex align-items-start profile-feed-item">
                                        <div class="form-group col-md-6">
                                            <strong><i class="fab fa-product-hunt mr-1"></i>Nombre</strong>
                                            <p class="text-muted">{{ $client->name }}</p>
                                            <hr>
                                            <strong><i class="fas fa-address-card mr-1"></i>Número de DNI</strong>
                                            <p class="text-muted">{{ $client->dni }}</p>
                                            <hr>
                                            <strong><i class="fas fa-address-card mr-1"></i>Número de CIF</strong>
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
                                <div id="purchaseHistory" class="profile-feed" style="display: none;">
                                    <h3>Historial de Ventas</h3>
                                    <div class="d-flex align-items-start profile-feed-item">
                                        <div class="form-group col-md-12">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha de venta</th>
                                                        <th>Producto</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio Unitario</th>
                                                        <th>Descuento</th>
                                                        <th>IVA</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($sales as $sale)
                                                        @foreach($sale->saleDetails as $detail)
                                                            <tr>
                                                                <td>{{ \Carbon\Carbon::parse($sale->sale_date)->locale('es')->isoFormat('D [de] MMMM [de] YYYY HH:mm:ss') }}</td>
                                                                <td>{{ $detail->product->name }}</td>
                                                                <td>{{ $detail->quantity }}</td>
                                                                <td>{{ $detail->price }}€</td>
                                                                <td>{{ $detail->discount }}%</td>
                                                                <td>{{ $sale->iva }}%</td>
                                                                <td>{{ $sale->total }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
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
    <script>
        document.getElementById('btnClientInfo').addEventListener('click', function() {
            document.getElementById('clientInfo').style.display = 'block';
            document.getElementById('purchaseHistory').style.display = 'none';
            this.classList.add('active');
            document.getElementById('btnPurchaseHistory').classList.remove('active');
        });

        document.getElementById('btnPurchaseHistory').addEventListener('click', function() {
            document.getElementById('clientInfo').style.display = 'none';
            document.getElementById('purchaseHistory').style.display = 'block';
            this.classList.add('active');
            document.getElementById('btnClientInfo').classList.remove('active');
        });
    </script>
@endsection
