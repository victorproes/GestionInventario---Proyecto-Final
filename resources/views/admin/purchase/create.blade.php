@extends('layouts.admin')

@section('title', 'Registro de compra')

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
                Registro de compras
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel de Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Compras</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Registro de compra</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registro de compra</h4>
                        </div>

                        {!! Form::open(['route' => 'purchases.store', 'method' => 'POST']) !!}
                        @include('admin.purchase._form')
                        
                        <div class="form-group">
                            <button id="guardar" type="submit" class="btn btn-primary float-right">Registrar</button>
                            <a href="{{ route('purchases.index') }}" class="btn btn-light">Cancelar</a>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    
{!! Html::script('melody\js\sweetalert2@11.js') !!}
{!! Html::script('melody\js\avgrund.js') !!}
   
    <script>
        // Ocultar automáticamente los mensajes de error después de 3 segundos
        setTimeout(function() {
            var nameError = document.getElementById('name-error');
            var descriptionError = document.getElementById('description-error');
            if (nameError) {
                nameError.style.display = 'none';
            }
            if (descriptionError) {
                descriptionError.style.display = 'none';
            }
        }, 3000);
    </script>

    <script>
        $(document).ready(function () {
            $("#agregar").click(function () {
                agregar();
            });

            // Recalcular totales cuando se cambia el IVA
            $("#iva").change(function() {
                totales();
            });
        });

        var cont = 0;
        var total = 0;
        var subtotal = [];

        $("#guardar").hide();

        function agregar() {
    var product_id = $("#product_id").val();
    var producto = $("#product_id option:selected").text();
    var quantity = $("#quantity").val();
    var price = $("#price").val();
    var iva = $("#iva").val();

    if (iva === "") {
        // Mostrar alerta si el campo de IVA está vacío
        Swal.fire({
            type: 'error',
            text: 'Por favor, ingrese el IVA antes de agregar un producto.',
        });
        return; // Detener la ejecución de la función si el IVA está vacío
    }

    if (product_id != "" && quantity != "" && quantity > 0 && price != "") {
        subtotal[cont] = quantity * price;
        total = total + subtotal[cont];
        var fila = '<tr class="selected" id="fila' + cont + '">'
            + '<td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont + ');"><i class="fa fa-times"></i></button></td>'
            + '<td><input type="hidden" name="product_id[]" value="' + product_id + '">' + producto + '</td>'
            + '<td><input type="hidden" name="price[]" value="' + price + '"><input class="form-control" type="number" value="' + price + '" disabled></td>'
            + '<td><input type="hidden" name="quantity[]" value="' + quantity + '"><input class="form-control" type="number" value="' + quantity + '" disabled></td>'
            + '<td align="right">s/' + subtotal[cont].toFixed(2) + '</td>'
            + '</tr>';
        cont++;
        limpiar();
        totales();
        evaluar();
        $('#detalles tbody').append(fila);
    } else {
        Swal.fire({
            type: 'error',
            text: 'Rellene todos los campos del detalle de las compras',
        });
    }
}


        function limpiar() {
            $("#quantity").val("");
            $("#price").val("");
        }

        function totales() {
            var iva = parseFloat($("#iva").val());
            var total_impuesto = total * iva / 100;
            var total_pagar = total + total_impuesto;

            $("#total").html("EUR " + total.toFixed(2));
            $("#total_impuesto").html("EUR " + total_impuesto.toFixed(2));
            $("#total_pagar_html").html("EUR " + total_pagar.toFixed(2));
            $("#total_pagar").val(total_pagar.toFixed(2));
        }

        function evaluar() {
            if (total > 0) {
                $("#guardar").show();
            } else {
                $("#guardar").hide();
            }
        }

        function eliminar(index) {
            total = total - subtotal[index];
            subtotal[index] = 0; // Reinicia el subtotal del producto eliminado
            totales();
            $("#fila" + index).remove();
            evaluar();
        }

    </script>
@endsection

