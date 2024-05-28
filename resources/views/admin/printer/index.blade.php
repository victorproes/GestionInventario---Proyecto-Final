@extends('layouts.admin')

@section('title', 'Configuración de impresora')

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
                Configuración de impresora
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel de Administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Configuración de impresora</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Configuración de impresora</h4>
                        </div>

                        <div class="form-group">
                            <strong><i class="fas fa-file-signature mr-1"></i>Nombre</strong>
                            <p class="text-muted">{{ $printer->name }}</p>
                            <hr>
                        </div>
                    </div> <!-- card-body -->
                    <div class="card-footer text-muted">
                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                            data-target="#exampleModal-2">Actualizar</button>
                    </div>
                </div> <!-- card -->
            </div> <!-- col-lg-12 -->
        </div> <!-- row -->
    </div> <!-- content-wrapper -->

    <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">Actualizar datos de empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="agregarEditarProviderForm"
                      action="{{ isset($printer) ? route('printers.update', $printer) : '' }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($printer))
                        @method('PUT')
                    @endif
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   aria-describedby="helpId" value="{{ $printer->name }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('melody/js/data-table.js') !!}
    {!! Html::script('melody/js/sweetalert2@11') !!}
    {!! Html::script('melody/js/dropify.js') !!}
    <script>
        function confirmDelete(categoryId) {
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
    </script>
@endsection
