@extends('layouts.admin')

@section('title', 'Panel administrador')

@section('styles')
    <style type="text/css">
        .unstyled-button {
            border: none;
            padding: 0;
            background: none;
        }

        .chart-height {
            height: 200px !important;
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
                Panel administrador
            </h3>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            {{-- <h4 class="card-title">Panel administrador</h4> --}}
                        </div>
                        @foreach ($totales as $total)
                            <div class="row">
                                <div class="col-lg-6 col-xs-6">
                                    <div class="card text-white bg-success">
                                        <div class="card-body pb-0">
                                            <div class="float-right">
                                                <i class="fas fa-cart-arrow-down fa-4x"></i>
                                            </div>
                                            <div class="text-value h4">
                                                <strong>EUR {{ $total->totalcompra }} (MES ACTUAL)</strong>
                                            </div>
                                            <div class="h3">Compras</div>
                                        </div>
                                        <div class="chart-wrapper mt-3 mx-3" style="height: 35px;">
                                            <a class="small-box-footer h4" href="{{ route('purchases.index') }}">
                                                Compras <i class="fa fa-arrow-alt-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-xs-6">
                                    <div class="card text-white bg-info">
                                        <div class="card-body pb-0">
                                            <div class="float-right">
                                                <i class="fas fa-shopping-cart fa-4x"></i>
                                            </div>
                                            <div class="text-value h4">
                                                <strong>EUR {{ $total->totalventa }} (MES ACTUAL)</strong>
                                            </div>
                                            <div class="h3">Ventas</div>
                                        </div>
                                        <div class="chart-wrapper mt-3 mx-3" style="height: 35px;">
                                            <a class="small-box-footer h4" href="{{ route('sales.index') }}">
                                                Ventas <i class="fa fa-arrow-alt-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            {{-- <h4 class="card-title">Panel administrador</h4> --}}
                        </div>
                        <div class="row">
                            @foreach ($totales as $total)
                                <div class="col-md-6">
                                    <div class="card card-chart">
                                        <div class="card-header">
                                            <h4 class="text-center">Compras - Meses</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="ct-chart">
                                                <canvas id="compras"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card card-chart">
                                        <div class="card-header">
                                            <h4 class="text-center">Ventas - Meses</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="ct-chart">
                                                <canvas id="ventas"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            {{-- <h4 class="card-title">Panel administrador</h4> --}}
                        </div>
                        <div class="col-md-12">
                            <div class="card card-chart">
                                <div class="card-header">
                                    <h4 class="text-center">Ventas Diarias</h4>
                                </div>
                                <div class="card-content">
                                    <div class="ct-chart">
                                        <canvas id="ventas_diarias"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="card-heading">
                                <h4 class="card-title">Productos más vendidos</h4>
                            </div>
                        </div>
                        <div class="card-body scrollbar scroll_dark pt-0" style="max-height: 350px;">
                            <div class="datatable-wrapper table-responsive">
                                <table class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th>Nombre</th>
                                            <th>Código</th>
                                            <th>Stock</th>
                                            <th>Cantidad vendida</th>
                                            <th>Ver detalles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productosvendidos as $productosvendido)
                                            <tr>
                                                <td>{{ $productosvendido->id }}</td>
                                                <td>{{ $productosvendido->name }}</td>
                                                <td>{{ $productosvendido->code }}</td>
                                                <td><strong>{{ $productosvendido->stock }} </strong> Unidades
                                                </td>
                                                <td><strong>{{ $productosvendido->quantity }} </strong> Unidades
                                                </td>
                                                <td>
                                                    <a href="{{ route('products.show', $productosvendido->id) }}">
                                                        <i class="far fa-eye"> Ver detalles</i>
                                                    </a>
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
    </div>
@endsection

@section('scripts')
    {!! Html::script('melody/js/data-table.js') !!}
    {!! Html::script('melody/js/chart.js') !!}
    {!! Html::script('melody/js/sweetalert2@11') !!}
    <script>
        function confirmDelete(categoryId) {
            console.log(categoryId);
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + categoryId).submit();
                }
            });
        }

        var varCompra = document.getElementById('compras').getContext('2d');
        var charCompra = new Chart(varCompra, {
            type: 'line',
            data: {
                labels: [
                    @foreach ($comprasmes as $reg)
                        @php
                            setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
                            $mes_traducido = strftime('%B', strtotime($reg->mes));
                        @endphp
                            "{{ $mes_traducido }}",
                    @endforeach
                ],
                datasets: [{
                    label: 'Compras',
                    data: [
                        @foreach ($comprasmes as $reg)
                            {{ $reg->totalmes }},
                        @endforeach
                    ],
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var varVenta = document.getElementById('ventas').getContext('2d');
        var charVenta = new Chart(varVenta, {
            type: 'line',
            data: {
                labels: [
                    @foreach ($ventasmes as $reg)
                        @php
                            setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
                            $mes_traducido = strftime('%B', strtotime($reg->mes));
                        @endphp
                            "{{ $mes_traducido }}",
                    @endforeach
                ],
                datasets: [{
                    label: 'Ventas',
                    data: [
                        @foreach ($ventasmes as $reg)
                            {{ $reg->totalmes }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(20,204,20,1)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    var varVentaDiarias = document.getElementById('ventas_diarias').getContext('2d');
    var charVentaDiarias = new Chart(varVentaDiarias, {
        type: 'bar',
        data: {
            labels: [
                @foreach ($ventasdia as $ventadia)
                    "{{ $ventadia->dia }}",
                @endforeach
            ],
            datasets: [{
                label: 'Ventas diarias',
                data: [
                    @foreach ($ventasdia as $reg)
                        {{ $reg->totaldia }},
                    @endforeach
                ],
                backgroundColor: 'rgba(20, 204, 20, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
@endsection
