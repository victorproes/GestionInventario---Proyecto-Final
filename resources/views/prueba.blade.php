@extends('layouts.admin')
@section('title', 'Gestión de productos')
@section('options')
@endsection
@section('preference')
    <div id="right-sidebar" class="settings-panel">
        <i class="settings-close fa fa-times"></i>
        <ul class="nav nav-tabs" id="settings-panel" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="todo-tab" data toggle="tab" href="#todo-section"
                    aria-controls="todo-section" aria-expanded="true">PRODUCTOS</a>
            </li>
        </ul>
        <div class="tab-content" id="setting-content">
            <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role=""
                aria-labelledby="todo-section">


                <div class="list-wrapper px-3">
                    <ul class="d-flex flex-column-reverse todo-list">
                        <li>
                            <a href="{{ route('products.create') }}" class="btn btn-primary"></a>
                        </li>
                    </ul>

                </div>
            </div>

        </div>

    </div>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Basic Tables
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Striped Table</h4>
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

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
@endsection
