<!-- Permiso Field -->
<div class="form-group col-sm-6">
  {!! Form::label('permiso', 'Permisos:') !!}
  <p>{!! $permiso->permiso !!}</p>
</div>

<!-- Status System Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status_system', 'Estatus Sistema:') !!}
  <p>{!! ($permiso->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Status User Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status_user', 'Estatus Usuario:') !!}
  <p>{!! ($permiso->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Modified By Field -->
<div class="form-group col-sm-6">
  {!! Form::label('modified_by', 'Modificado por:') !!}
  <p>{!! $permiso->modified_by !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{!! $permiso->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{!! $permiso->updated_at !!}</p>
</div>
