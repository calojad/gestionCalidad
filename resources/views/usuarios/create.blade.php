@extends('layouts.app-Admin')

@section('content-header')
    <h1>Crear Usuarios</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/home"><i class="fa fa-dashboard"></i> Inicio</a>
        </li>
        <li>Usuarios</li>
        <li>Crear</li>
    </ol>
@endsection
@section('content')
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'usuarios.store']) !!}

                        @include('usuarios.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
