@extends('layouts.admin')

@section('title', 'Reporte de ventas')

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
                Reporte de ventas
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel de Administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reporte de ventas</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Reporte de ventas</h4>

                        </div>
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
                            <div class="col-12 col-md-4 text-center">
                                <span>Fecha de consulta:<b></b></span>
                                <div class="form-group">
                                    <strong>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</strong>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 text-center">
                                <span>Cantidad de registros:<b></b></span>
                                <div class="form-group">
                                    <strong>{{ $sales->count() }}</strong>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 text-center">
                                <span>Total de ingresos:<b></b></span>
                                <div class="form-group">
                                    <strong>{{ $total }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th style="width:50px">Acciones</th>
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

                                            <td style="width:50px;">

                                               

                                                <a class="jsgrid-button jsgrid-edit-button"
                                                    href="{{ route('sales.pdf', $sale) }}"><i
                                                        class="far fa-file-pdf"></i></a>
                                               
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
                    // Si el usuario confirma, enviar el formulario de eliminación
                    document.getElementById('delete-form-' + categoryId).submit();
                }
            });
        }
    </script>
@endsection
