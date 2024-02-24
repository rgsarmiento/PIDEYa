@extends('layouts.app')

@section('title')
    Pedidos
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Pedidos Generados</h3>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/pideya/home">Dashboard</a></div>
                <div class="breadcrumb-item">Pedidos Generados</div>
            </div>
        </div>

        <p class="section-lead">Listado de Pedidos.
        </p>

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


        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                            <div class="form-row">

                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="card card-statistic-2">

                                        <div class="card-icon shadow-primary bg-primary">
                                            <i class="fas fa-archive"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Registros</h4>
                                            </div>
                                            <div class="card-body">
                                                {{ $nRegistros }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               

                            </div>

                            <a class="btn btn-info" href="{{ route('documents.create') }}">Nuevo Pedido</a>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover border-primary table-striped mt-2">
                                    <thead style="background-color: #6777ef;">
                                        <th style="color: #fff;">Fecha</th>
                                        <th style="color: #fff;">Cliente</th>
                                        <th style="color: #fff;">Total</th>                                       
                                    </thead>
                                    <tbody>
                                        @if (count($documents) <= 0)
                                            <tr>
                                                <td colspan="5">
                                                    <div class="card-body">
                                                        <div class="empty-state" data-height="400"
                                                            style="height: 400px;">
                                                            <div class="empty-state-icon">
                                                                <img src="{{ asset('img/avatar/oops.png') }}" alt="avatar"
                                                                    width="70">
                                                            </div>
                                                            <h2>No hay registros para mostrar</h2>
                                                            <p class="lead">
                                                                Todos los registros existentes se mostrarán aquí.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($documents as $row)

                                                <tr>
                                                   <td>
                                                        {{ date('d-m-Y', strtotime($row->date_issue))  }}
                                                    </td>
                                                    <td>
                                                        {{ $row->customer->identification_number }} - {{ $row->customer->name }}
                                                    </td>

                                                    <td style="white-space:nowrap;"><i class="fa fa-sort-up"
                                                            style="font-size:18px;color:#00D0C4;"></i> $
                                                        {{ number_format($row->total, 2) }}</td>
                                                       
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="pagination justify-content-end">
                                    {!! $documents->links() !!}
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(9000, 0).slideDown(1000,
                function() {
                    $(this).remove();
                });
        }, 3000);
    </script>

    @if (Session::has('message'))
        <script>
            Swal.fire("Buen trabajo!", "{{ session()->get('message') }}", "success");
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            Swal.fire("Oops...!", "{{ session()->get('message') }}", "error");
        </script>
    @endif

    @if (Session::has('eliminar'))
        <script>
            Swal.fire("Eliminado!", "{{ session()->get('eliminar') }}", "success");
        </script>
    @endif


    @if (Session::has('change_status'))
        <script>
            Swal.fire("Actualizado!", "{{ session()->get('change_status') }}", "success");
        </script>
    @endif

    <script>
        $('.form-delete').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Esta seguro?',
                text: "Este empleado se eliminara definitivamente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>

    <script>
        $('.shotDina').submit(function(e) {
            e.preventDefault();
            var id = $(this).attr("id");

            var fechaPago = document.getElementById("payment_date").value;
            var periodo = document.getElementById("select_payroll_period_id").value;

            localStorage.setItem('periodo_ni', periodo);
            localStorage.setItem('fecha_pago_ni', fechaPago);


            $('input').each(function() {

                if (this.id == 'periodo_ni') {
                    this.value = periodo;
                }

                if (this.id == 'fecha_pago_ni') {
                    this.value = fechaPago;
                }

            });


            this.submit();

        });
    </script>
@endsection
