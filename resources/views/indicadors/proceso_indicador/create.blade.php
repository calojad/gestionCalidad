@extends('layouts.app-Admin')

@section('content')
    <section class="content-header">
        <h1>
            Indicador
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'indicadors.store']) !!}

                        @include('indicadors.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
