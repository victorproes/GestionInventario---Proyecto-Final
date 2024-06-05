@extends('layouts.admin')

@section('title', 'Gestión de compras')

@section('styles')
<style type="text/css">
    .unstyled-button{
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
                Compras
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel de Administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Compras</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!-- Mensajes de error -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Compras</h4>
                            <div class="col-lg-6">
                                <div class="text-lg-right mb-4">
                                    <a href="{{ route('purchases.create') }}" class="btn btn-primary"><i
                                            class="fas fa-plus"></i> Agregar Compra</a>
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
                                <tbody>
                                    @foreach ($purchases as $purchase)
                                        <tr>
                                            <th scope="row"><a href="{{route('purchases.show',$purchase)}}">{{ $purchase->id }}</a></th>
                                            <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->locale('es')->isoFormat('D [de] MMMM [de] YYYY HH:mm:ss') }}</td>
                                            <td>{{ $purchase->total }}</td>
                                            @if ($purchase->status == 'VALID')
                                            <td>
                                                <a class="jsgrid-button btn btn-success" href="{{route('change.status.purchases',$purchase)}}">Activo <i class="fas fa-check"></i></a>
                                            </td>
                                                
                                            @else
                                            <td>
                                            <a class="jsgrid-button btn btn-danger" href="{{route('change.status.purchases',$purchase)}}">Cancelado <i class="fas fa-times"></i></a>
                                        </td>
                                            @endif
                                            
                                                <td style="width:50px;">
                                                    
                                                    {{-- <a class="jsgrid-button jsgrid-edit-button" href="{{ route('purchases.edit', $purchase) }}" title="Editar"><i class="far fa-edit"></i></a> --}}
                                                    {{-- <button type="button" class="jsgrid-button jsgrid-delete-button unstyled-button" onclick="confirmDelete({{ $purchase->id }})" title="Eliminar"><i class="far fa-trash-alt"></i></button> --}}
                                                   
                                                    <a class="jsgrid-button jsgrid-edit-button" href="{{route('purchases.pdf',$purchase)}}"><i class="far fa-file-pdf"></i></a>
                                                    {{-- <a class="jsgrid-button jsgrid-edit-button" href=""><i class="fas fa-print"></i></a> --}}
                                                    <a class="jsgrid-button jsgrid-edit-button" href="{{route('purchases.show',$purchase)}}"><i class="far fa-eye"></i></a>
                                                   
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
            console.log(categoryId  );
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

        setTimeout(function() {
        $(".alert-success").fadeOut();
    }, 3000); // Oculta el mensaje de éxito después de 3 segundos
    </script>
@endsection
