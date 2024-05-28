@extends('layouts.admin')

@section('title', 'Registro de venta')

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
                Registro de ventas
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel de Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Ventas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Registro de ventas</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registro de venta</h4>
                        </div>

                        {!! Form::open(['route' => 'sales.store', 'method' => 'POST']) !!}
                        @include('admin.sale._form')
                        <div class="form-group">
                            <button id="guardar" type="submit" class="btn btn-primary float-right">Registrar</button>
                            <a href="{{ route('sales.index') }}" class="btn btn-light">Cancelar</a>
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
    // Configurar el evento change para el select product_id
    $("#product_id").change(mostrarValores);

    // Configurar el evento click para el botón agregar
    $("#agregar").click(function () {
        mostrarValores();  // Asegurarse de que los valores se actualicen antes de agregar
        agregar();
    });

    // Disparar el evento change al cargar la página para que se muestren los valores iniciales
    $("#product_id").trigger('change');
});

var cont = 0;
var total = 0;
var subtotal = [];

$("#guardar").hide();

function mostrarValores() {
    let datosProducto = document.getElementById('product_id').value.split('_');
    $("#price").val(datosProducto[2]);
    $("#stock").val(datosProducto[1]);
}

function agregar() {
    // Asegurarse de que los valores se actualicen antes de agregar
    mostrarValores();

    let datosProducto = document.getElementById('product_id').value.split('_');

    let product_id = datosProducto[0];
    let producto = $("#product_id option:selected").text();
    let quantity = $("#quantity").val();
    let discount = $("#discount").val();
    let price = $("#price").val();
    let stock = $("#stock").val();
    let iva = $("#iva").val();

    if (product_id != "" && quantity != "" && quantity > 0 && discount != "" && price != "") {
        if (parseInt(stock) >= parseInt(quantity)) {
            subtotal[cont] = (quantity * price) - (quantity * price * discount / 100);
            total += subtotal[cont];
            let fila = '<tr class="selected" id="fila' + cont + '">'
                + '<td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont + ');"><i class="fa fa-times"></i></button></td>'
                + '<td><input type="hidden" name="product_id[]" value="' + product_id + '">' + producto + '</td>'
                + '<td><input type="hidden" name="price[]" id="price[]" value="' + parseFloat(price).toFixed(2) + '"><input class="form-control" type="number" value="' + parseFloat(price).toFixed(2) + '" id="price[]" disabled></td>'
                + '<td><input type="hidden" name="discount[]" id="discount[]" value="' + parseFloat(discount).toFixed(2) + '"><input class="form-control" type="number" value="' + parseFloat(discount).toFixed(2) + '" id="discount[]" disabled></td>'
                + '<td><input type="hidden" name="quantity[]" value="' + quantity + '"><input class="form-control" type="number" value="' + quantity + '" disabled></td>'
                + '<td align="right">s/' + parseFloat(subtotal[cont]).toFixed(2) + '</td>'
                + '</tr>';
            cont++;
            limpiar();
            totales();
            evaluar();
            $('#detalles').append(fila);
        } else {
            Swal.fire({
                type: 'error',
                text: 'La cantidad a vender supera el stock',
            });
        }
    } else {
        Swal.fire({
            type: 'error',
            text: 'Rellene todos los campos del detalle de la venta',
        });
    }
}

function limpiar() {
    $("#quantity").val("");
    // No limpiar el campo de precio aquí
    // $("#price").val("");
    $("#discount").val("0");
}

function totales() {
    let impuesto = $("#iva").val();
    let total_impuesto = total * impuesto / 100;
    let total_pagar = total + total_impuesto;

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
    total -= subtotal[index];
    let impuesto = $("#iva").val();
    let total_impuesto = total * impuesto / 100;
    let total_pagar_html = total + total_impuesto;

    $("#total").html("EUR " + total.toFixed(2));
    $("#total_impuesto").html("EUR " + total_impuesto.toFixed(2));
    $("#total_pagar_html").html("EUR " + total_pagar_html.toFixed(2));
    $("#total_pagar").val(total_pagar_html.toFixed(2));
    $("#fila" + index).remove();
    evaluar();
}



   </script>
@endsection

