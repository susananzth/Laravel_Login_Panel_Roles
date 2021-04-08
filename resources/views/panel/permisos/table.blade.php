<div class="table-responsive">
  <table class="stripe row-border order-column" style="width:100%" id="permisos-table">
    <thead>
      <tr>
        <th>Acci&oacute;n</th>
        <th>Permisos</th>
        <th>Modificado por</th>
        <th>Estatus</th>
      </tr>
    </thead>
    <tbody>
      <!-- @foreach($permisos as $permiso)
        <tr>
          <td>
            <div class='btn-group'>
              <a href="{!! route('permisos.show', [$permiso->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('permisos.edit', [$permiso->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::close() !!}
            </div>
          </td>
          <td>{!! $permiso->permiso !!}</td>
          <td>{!! $permiso->modified_by !!}</td>
          <td>{!! ($permiso->status ==1)? '<i class="fa fa-check-circle-o"></i>' : '<i class="fa fa-times-circle-o"></i>' !!}</td>            </tr>
        </tr>
      @endforeach -->
    </tbody>
  </table>
</div>
