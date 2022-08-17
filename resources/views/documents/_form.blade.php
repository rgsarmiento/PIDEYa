<div class="row mt-sm-12">

    <div class="col-12 col-md-12 col-lg-12">


        <div class="card">
            <div class="card-header">
                <h4>Datos del Pedido</h4>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            {!! Html::decode(Form::label('customer', 'Cliente')) !!}
                            {!! Form::select('customer_id', $customers->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'select_customer', 'placeholder' => '-- Seleccionar --']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            {!! Html::decode(Form::label('product', 'Producto')) !!}
                            {!! Form::select('product', $products->pluck('name', 'code'), null, ['class' => 'form-control', 'id' => 'select_product', 'placeholder' => '-- Seleccionar --']) !!}

                        </div>
                    </div>
                </div>

                <div class="row" id="div_quantity_value">
                    <div class="col-md-4 col-6">
                        <div class="form-group" style="display: none;">
                            <label>Cajas</label>
                            <input type="number" class="form-control" id="quantity_c">
                        </div>
                        <div class="form-group">
                            <label>Unidades</label>
                            <input type="number" class="form-control" id="quantity">
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12" id="div_add_deductions">
                    <button type="button" class="btn btn-info" id="add_product">Agregar</button>
                </div>

                <br>
                <div id="alert_products">
                    <div class="col-md-12 col-12">
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="tbl_products" class="table table-bordered table-hover border-primary table-striped mt-2">
                        <thead style="background-color: #6777ef;">
                            <th style="color: #fff;">Detalle</th>
                            <th class="text-right" style="color: #fff;">Acciones</th>                            
                            
                        </thead>
                        <tbody>
                            @php
                                $products_json = json_decode(json_encode($products_document), true);
                                $products = $products_json['products'];
                            @endphp

                            @if (count($products) <= 0)
                                <tr id="na">
                                    <td colspan="2">
                                        <div class="card-body">
                                            <div class="empty-state">
                                                <div class="empty-state-icon">
                                                    <img src="{{ asset('img/avatar/oops.png') }}" alt="avatar"
                                                        width="70">
                                                </div>
                                                <h2>No se han agregado productos</h2>
                                                <p class="lead">
                                                    Todos los productos agregados se mostrarán aquí.
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            @foreach ($products as $value)
                                <tr id="products-{!! $value['id'] !!}">
                                    <td>{!! $value['description'] !!}</td>
                                    <td>{!! $value['price'] !!}</td>
                                    <td>{!! $value['quantity'] !!}</td>
                                    <td>{!! $value['total'] !!}</td>
                                    <td><a href="javascript:eliminar_produc({!! $value['id'] !!}, {!! $total['value'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot style="background-color: #b5eee0;">
                            <tr align="letf">
                                
                                <th colspan="2"><i class="fa fa-sort-up" style="font-size:20px;color:#00D0C4;"></i>
                                   TOTAL  ${!! number_format(0, 2) !!} </th>
                            </tr>
                        </tfoot>
                    </table>
                    {{--  --}}
                    {!! Form::hidden('products', null, ['class' => 'form-control', 'id' => 'products']) !!}
                    {!! Form::hidden('total', null, ['class' => 'form-control', 'id' => 'total_document', 'value' => '0']) !!}

                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h4>Notas-Observaciones</h4>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="form-group col-12">                       
                        {!! Form::textarea('note', null, ['class' => 'form-control summernote-simple', 'id' => 'notes']) !!}

                    </div>
                </div>
            </div>
        </div>


        <div class="card">

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>

    </div>
</div>

