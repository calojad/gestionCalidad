@extends('layouts.app-Admin')

@section('content')
    <section class="content-header">
        <h1>
            Indicador
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('indicadors.show_fields')
                    <a href="{!! route('indicadors.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
