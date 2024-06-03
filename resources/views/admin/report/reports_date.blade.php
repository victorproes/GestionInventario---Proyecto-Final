@extends('layouts.admin')

@section('title', 'Reporte por rango de fechas')

@section('styles')
    <style type="text/css">
        .unstyled-button {
            border: none;
            padding: 0;
            background: none;
        }
    </style>
@endsection

@section('options')
@endsection

@section('preference')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Reporte por rango de fechas
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel de Administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reporte por rango de fechas</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            {{-- <h4 class="card-title">Reporte por rango de fechas</h4> --}}
                        </div>

                        {!! Form::open(['route' => 'report.results', 'method' => 'POST']) !!}
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
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <span>Fecha inicial:</span>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="fecha_ini" id="fecha_ini"
                                        value="{{ old('fecha_ini') }}" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <span>Fecha final:</span>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin"
                                        value="{{ old('fecha_fin') }}" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 text-center mt-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm">Consulta</button>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 text-center">
                                <span>Total de ingresos:</span>
                                <div class="form-group">
                                    <strong>s/{{ $total }}</strong>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale)
                                        <tr>
                                            <th scope="row"><a
                                                    href="{{ route('sales.show', $sale) }}">{{ $sale->id }}</a></th>
                                            <td>{{ $sale->sale_date }}</td>
                                            <td>{{ $sale->total }}</td>
                                            <td>{{ $sale->status }}</td>
                                            <td>
                                                <a class="jsgrid-button jsgrid-edit-button"
                                                    href="{{ route('sales.pdf', $sale) }}"><i
                                                        class="far fa-file-pdf"></i></a>
                                                <a class="jsgrid-button jsgrid-edit-button"
                                                    href="{{ route('sales.print', $sale) }}"><i
                                                        class="fas fa-print"></i></a>
                                                <a class="jsgrid-button jsgrid-edit-button"
                                                    href="{{ route('sales.show', $sale) }}"><i class="far fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('melody/js/data-table.js') !!}
    {!! Html::script('melody/js/sweetalert2@11') !!}
    <script>
        window.onload = function() {
            var fecha = new Date();
            var mes = fecha.getMonth() + 1;
            var dia = fecha.getDate();
            var ano = fecha.getFullYear();
            if (dia < 10) {
                dia = '0' + dia;
            }
            if (mes < 10) {
                mes = '0' + mes;
            }
            document.getElementById('fecha_fin').value = ano + "-" + mes + "-" + dia;
        }
    </script>
@endsection
