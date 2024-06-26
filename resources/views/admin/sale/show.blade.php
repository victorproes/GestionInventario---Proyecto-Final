@extends('layouts.admin')
@section('title', 'Detalles de venta')
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
                Detalles de venta
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class=" breadcrumb-item"><a href="#">Panel administrador</a></li>
                    <li class=" breadcrumb-item"><a href="{{ route('sales.index') }}">Ventas</a></li>
                    <li class=" breadcrumb-item active" aria-current="page">Detalles de venta</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-md-4 text-center">
                                <label class="form-contorl-label">Cliente</label>
                                <p><a href="{{ route('clients.show', $sale->client) }}">{{$sale->client->name}}</a></p>
                            </div>

                            <div class="col-md-4 text-center">
                                <label class="form-contorl-label">Vendedor</label>
                                <p>{{ $sale->user->name }}</p>
                            </div>

                            <div class="col-md-4 text-center">
                                <label class="form-contorl-label">Número Venta</label>
                                <p>{{ $sale->id }}</p>
                            </div>
                        </div>
                        <br /><br />

                        <div class="form-group">
                            <h4 class="card-title">Detalle de venta</h4>
                            <div class="table-responsive col-md-12">
                                <table id="saleDetails" class="table">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio Venta (EUR)</th>
                                            <th>Descuento(EUR)</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal(EUR)</th>
                                        </tr>
                                    </thead>
                                    <tfoot>

                                        <tr>
                                            <th colspan="4">
                                                <p align="right">SUBTOTAL:</p>

                                            </th>
                                            <th>
                                                <p align="right">s/{{ number_format($subtotal,2)}}></p>
                                            </th>


                                        </tr>


                                        <tr>
                                            <th colspan="4">
                                                <p align="right">TOTAL IMPUESTO({{ $sale->iva }}%):</p>
                                            </th>
                                            <th>
                                                <p align="right">s/{{ number_format(($subtotal * $sale->iva) / 100, 2) }}></p>
                                            </th>
                                        </tr>

                                        <tr>
                                            <th colspan="4">
                                                <p align="right">TOTAL:</p>
                                            </th>
                                            <th>
                                                <p align="right">s/{{ number_format($sale->total, 2) }}></p>

                                            </th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($saleDetails as $saleDetail)
                                            <tr>
                                                <td>{{ $saleDetail->product->name }}</td>
                                                <td>{{ $saleDetail->price }}</td>
                                                <td>{{ $saleDetail->discount }}%</td>
                                                <td>{{ $saleDetail->quantity }}</td>
                                                <td>s/{{ number_format($saleDetail->quantity * $saleDetail->price - ($saleDetail->quantity * $saleDetail->price * $saleDetail->discount) / 100) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-muted">
                        <a href="{{ route('sales.index') }}" class="btn btn-primary float-right">Volver</a>
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
