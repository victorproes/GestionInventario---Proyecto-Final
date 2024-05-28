@extends('layouts.admin')

@section('title', 'Gestión de empresa')

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
                Gestión de empresa
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel de Administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gestión de empresa</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Gestión de empresa</h4>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong><i class="fas fa-file-signature mr-1"></i>Nombre</strong>
                                <p class="text-muted">{{ $business->name }}</p>
                                <hr>
                                <strong><i class="fas fa-align-left mr-1"></i>Descripción</strong>
                                <p class="text-muted">{{ $business->description }}</p>
                                <hr>
                                <strong><i class="fas fa-map-marked-alt mr-1"></i>Dirección</strong>
                                <p class="text-muted">{{ $business->address }}</p>
                                <hr>
                            </div>
                            <div class="form-group col-md-6">
                                <strong><i class="far fa-address-card mr-1"></i>CIF</strong>
                                <p class="text-muted">{{ $business->cif }}</p>
                                <hr>
                                <strong><i class="far fa-envelope mr-1"></i>Correo electrónico</strong>
                                <p class="text-muted">{{ $business->email }}</p>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong><i class="fas fa-exclamation-circle mr-1">Logo</i></strong><br>
                                    </div>
                                    <div class="col-md-6">
                                        
                                        <img class="rounded float-left" src="{{ asset('image/'.$business->logo) }}" alt="logo"
                                            style="width: 50px; height:50px;">
                                    </div>
                                </div>
                            </div>

                        </div> <!-- form-row -->
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
                    action="{{ isset($business) ? route('business.update', $business) : route('business.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($business))
                        @method('PUT')
                    @endif
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name"
                                aria-describedby="helpId" value="{{ $business->name }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" name="description" id="description" rows="3">{{ $business->description }}</textarea>
                        </div>


                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                aria-describedby="helpId" value="{{ $business->email }}">
                        </div>

                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <input type="text" class="form-control" name="address" id="address"
                                aria-describedby="helpId" value="{{ $business->address }}">
                        </div>

                        <div class="form-group">
                            <label for="cif">CIF</label>
                            <input type="text" class="form-control" name="cif" id="cif"
                                aria-describedby="helpId" value="{{ $business->cif }}">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title d-flex">Logo
                                <small class="ml-auto align-self-end">
                                    <a href="dropify.html" class="font-weight-light" target="_blank"></a>
                                </small>
                            </h5>
                            <input type="file" class="dropify" id="logo" name="logo" />

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </div>
            </div>
            </form>

        </div>
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
