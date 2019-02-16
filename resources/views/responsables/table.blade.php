<table class="table table-responsive table-striped table-bordered table-hover table-checkable datatable" id="responsables-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
        {{--<th>Organizacion Id</th>--}}
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($responsables as $responsable)
        <tr>
            <td>{!! $responsable->nombre !!}</td>
            <td>{!! $responsable->descripcion !!}</td>
{{--            <td>{!! $responsable->organizacion_id !!}</td>--}}
            <td>
                {!! Form::open(['route' => ['responsables.destroy', $responsable->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('responsables.show', [$responsable->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('responsables.edit', [$responsable->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>