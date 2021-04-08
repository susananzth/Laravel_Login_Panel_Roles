<!-- Id Rol Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_tp_rol', 'Rol:') !!}
  <p>{!! ($rolMenu->id_tp_rol)? $rolMenu->getRol->descripcion : '-' !!}</p>
</div>

<!-- Id Menu Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_menu', 'Men&uacute;:') !!}
  <p>{!! ($rolMenu->id_menu)? $rolMenu->getMenu->menu : '-' !!}</p>
</div>

<!-- Note Field -->
<div class="form-group col-sm-6">
  {!! Form::label('note', 'Nota:') !!}
  <p>{!! $rolMenu->note !!}</p>
</div>

<!-- Status System Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status_system', 'Estatus Sistema:') !!}
  <p>{!! ($rolMenu->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Status User Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status_user', 'Estatus Usuarios:') !!}
  <p>{!! ($rolMenu->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Modified By Field -->
<div class="form-group col-sm-6">
  {!! Form::label('modified_by', 'Modificado por:') !!}
  <p>{!! $rolMenu->modified_by !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{!! $rolMenu->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{!! $rolMenu->updated_at !!}</p>
</div>
