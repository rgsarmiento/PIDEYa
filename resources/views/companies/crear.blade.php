@extends('layouts.app')

@section('title')
    Empresas
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Empresa</h3>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/pideya/home">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('companies.index') }}">Empresas</a></div>
                <div class="breadcrumb-item">Crear Empresa</div>
              </div>
        </div>
        <div class="section-body">

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show p-0" role="alert">
                <strong>¡Revisar los campos!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


            {!! Form::open(['route' => 'companies.store', 'method' => 'POST']) !!}
            @include('companies._form')
            {!! Form::close() !!}
        </div>
    </section>
@endsection

