<div class="form-group">
    <label for="client_id">Cliente:</label>
    <select class="form-control" name="client_id" id="client_id">
        @foreach ($clients as $client)
            <option value="{{ $client->id }}">{{ $client->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="iva">Impuesto</label>
    <input type="number" name="iva" id="iva" class="form-control" placeholder="Ingrese el IVA en %" step="0.01">
</div>

<div class="form-group">
    <label for="product_id">Producto:</label>
    <select class="form-control" name="product_id" id="product_id">
        <option value="" disabled selected>Selecione un producto...</option>
        @foreach ($products as $product)
        
            <option value="{{ $product->id }}_{{ $product->stock }}_{{ $product->sell_price }}">{{ $product->name }}</option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <label for="">Stock actual</label>
    <input type="text" name="stock" id="stock" class="form-control" disabled>
</div>


<div class="form-group">
    <label for="quantity">Cantidad</label>
    <input type="number" name="quantity" id="quantity" class="form-control" aria-describedby="helpId">
</div>

<div class="form-group">
    <label for="price">Precio de venta</label>
    <input type="number" name="price" id="price" class="form-control" aria-describedby="helpId" disabled>
</div>

<div class="form-group">
    <label for="discount">Porcentaje de descuento</label>
    <input type="number" name="discount" id="discount" class="form-control" aria-describedby="helpId" value="0">
</div>


<div class="form-group">
    <button type="button" class="btn btn-primary float-right" id="agregar">Agregar producto</button>
</div>


<div class="form-group">
    <h4 class="card-title">Detalles de la venta</h4>
    <div class="table-responsive col-md-12">
        <table id="detalles" class="table table-striped">
            <thead>
                <tr>
                    <th>Eliminar</th>
                    <th>Producto</th>
                    <th>Precio de venta(EUR)</th>
                    <th>Descuento</th>
                    <th>Cantidad</th>
                    <th>Subtotal(EUR)</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL:</p>
                    </th>
                    <th>
                        <p align="right"><span id="total">EUR 0.00</span></p>
                    </th>
                </tr>



                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL IMPUESTO:</p>
                    </th>
                    <th>
                        <p align="right"><span id="total_impuesto">EUR 0.00</span></p>
                    </th>
                </tr>


                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL A PAGAR:</p>
                    </th>
                    <th>
                        <p align="right"><span align="right" id="total_pagar_html">EUR 0.00</span><input
                                type="hidden" name="total" id="total_pagar"></p>
                    </th>
                </tr>

            </tfoot>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
