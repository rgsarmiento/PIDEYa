@extends('layouts.app')

@section('title')
    Nuevo Pedido
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Nuevo pedido</h3>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('documents.index') }}">Lista Pedidos</a></div>
                <div class="breadcrumb-item">Nuevo Pedido</div>
            </div>
        </div>
        <div class="section-body">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show alert-has-icon p-4" role="alert">
                    <div class="alert-icon"><i class="fa fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <div class="alert-title">Oh, no!</div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {!! Form::open(['route' => 'documents.store', 'method' => 'POST']) !!}
            @include('documents._form')
            {!! Form::close() !!}

        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('#select_customer').select2();
            $('#select_product').select2();

            $("#select_product").change(function(){
                var precio = 0;
                var precio_str =""
                
                var precio2 = 0;
                var precio3 = 0;
                var producto = $("#select_product option:selected").text();

                var producto_index1 = producto.indexOf('P1(');
                var producto_index2 = producto.indexOf('P2(');
                var producto_index3 = producto.indexOf('P3(');
                var quantity_index = producto.indexOf('C(');

                if (producto_index1 !== -1) {   
                    precio = producto.substring((producto_index1 + 3), producto_index2 - 3);                
                    document.getElementById("precio1").value = precio
                    document.getElementById("lprecio1").innerText = parseFloat(precio, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,"$1,").toString()
                }
                if (producto_index2 !== -1) {   
                    precio = producto.substring((producto_index2 + 3), producto_index3 - 3);                
                    document.getElementById("precio2").value = precio
                    document.getElementById("lprecio2").innerText = parseFloat(precio, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,"$1,").toString()                    
                }
                if (producto_index3 !== -1) {        
                    precio = producto.substring((producto_index3 + 3), quantity_index - 2);               
                    document.getElementById("precio3").value = precio
                    document.getElementById("lprecio3").innerText = parseFloat(precio, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,"$1,").toString()                                        
                }

                
            });

            $('#add_product').click(function(e) {
                e.preventDefault();

                var codigo = document.getElementById("select_product").value;
                var producto = $("#select_product option:selected").text();
                var cantidad = Number(document.getElementById("quantity").value);
                var cajas = Number(document.getElementById("quantity_c").value);
                
                var valida_cantidad = cantidad + cajas;

                let precio = $('input[name="precio"]:checked').val();

                if (producto != "-- Seleccionar --"){

                if (valida_cantidad <= 0 || producto.length == 0 || precio <= 0) {
                    return false
                }

                if (document.getElementById("products").value == "") {
                    document.getElementById("products").value = '{"products":[]}';
                }

                var productos = JSON.parse(document.getElementById("products").value);
                var n_productos = productos.products.length;

                
                var quantity = 0;
                var largo = producto.length
                
                var producto_index1 = producto.indexOf('P1(');
                var quantity_index = producto.indexOf('C(');
                
                
                if (quantity_index !== -1) {
                    var largo = producto.length
                    quantity = producto.substring((quantity_index + 2), largo - 1);
                }
                producto = producto.substring(0,producto_index1 -1);

                if (cajas > 0 && quantity > 1) {
                    quantity = (quantity * cajas);
                }else{
                    quantity = 0;
                }

                if (quantity == 1) {
                    quantity = 0;
                }


                cantidad = (cantidad + quantity);
                var total = (precio * cantidad);
                
                array = {
                    'id': n_productos,
                    'code': codigo,
                    'description': producto,
                    'price': precio,
                    'quantity': cantidad,
                    'total': total
                };

                productos.products.push(array);

                document.getElementById("total_document").value = total;
                document.getElementById("products").value = JSON.stringify(productos);

                $("#tbl_products>tbody").append('<tr id="products-' + n_productos +
                    '"><td>' + producto + '<br>' +
                    'Precio ' +  parseFloat(precio, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                    "$1,").toString() + '<br>' +
                    'Cantidad ' + cantidad + '<br>' +
                    'Total ' + parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                        "$1,").toString() +
                    '<td><a href="javascript:eliminar_product(' + n_productos + "," + total +
                    ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                );
                  
                
                //$('#select_product').val('');
                document.getElementById("quantity").value = "";
                document.getElementById("quantity_c").value = "";

                calcular_total();
                    }

            });

            recargar_products();

            function recargar_products(){

                var data = JSON.parse(document.getElementById("products").value);
    
                var id = 0;
                var code = "";
                var description = "";
                var price = "";
                var price_b = "";
                var price_c = "";
                var quantity = 0;
                var total = "";
               
                
                data.products.forEach(obj => {
                    Object.entries(obj).forEach(([key, value]) => {
                        console.log(`${key} ${value}`);
                        switch (key) {
                            case 'id':
                                id = value;
                                break;
                            case 'code':
                                code = value;
                                break;
                            case 'description':
                                description = value;
                                break;
                            case 'price':
                                price = value;
                                break;
                            case 'quantity':
                                quantity = value;
                                break;
                            case 'total':
                                total = value;
                                break;
                        } 
                        
                    });
                   
                    $("#tbl_products>tbody").append('<tr id="products-' + id +
                    '"><td>' + description + '<br>' +
                        'Precio ' +  parseFloat(price, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                    "$1,").toString() + '<br>' +
                    'Cantidad ' + quantity + '<br>' +
                    'Total ' + parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,
                        "$1,").toString() +
                    '<td><a href="javascript:eliminar_product(' + id + "," + total +
                    ')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td></tr>'
                );

                    calcular_total();


                });
    
            }

        });



        function calcular_total() {
            var productos = JSON.parse(document.getElementById("products").value);
            var total_productos = productos.products.reduce((sum, value) => (typeof value.total == "number" ?
                sum + value.total : sum), 0);
            
            document.getElementById("total_document").value = total_productos;

            document.getElementById("tbl_products").tFoot.innerHTML =
                '<tr align="center"><th colspan="2"><i class="fa fa-sort-up" style="font-size:20px;color:#00D0C4;"></i>TOTAL $' +
                parseFloat(total_productos, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
                .toString() + '</th></tr>';

                if(total_productos == 0){
                    document.getElementById("products").value = "";
                }else{
                    //siempre de ultimo o si no da error        
                var element = document.getElementById("na");
                element.parentNode.removeChild(element);        
                }
        }

        function eliminar_product(id, valor) {
            var total_document = document.getElementById("total_document").value;
            var productos = JSON.parse(document.getElementById("products").value);

            productos.products.forEach(function(currentValue, index, arr) {
                if (productos.products[index].id == id) {
                    productos.products.splice(index, 1);
                }
            })

            total_document = (total_document - valor);

            document.getElementById("total_document").value = total_document;
            document.getElementById("products").value = JSON.stringify(productos);

            var element = document.getElementById("products-" + id);
            element.parentNode.removeChild(element);

            document.getElementById("tbl_products").tFoot.innerHTML =
                '<tr align="center"><th colspan="2"><i class="fa fa-sort-up" style="font-size:20px;color:#00D0C4;"></i>TOTAL $' +
                parseFloat(total_document, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
                .toString() + '</th></tr>';

                if(total_document == 0){
                    document.getElementById("products").value = "";
                }

        }

    </script>
@endsection
