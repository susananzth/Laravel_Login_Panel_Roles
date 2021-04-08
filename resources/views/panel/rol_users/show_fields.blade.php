<!-- Id Users App Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_user', 'Uuarios:') !!}
  <p>{!! ($rolUsers->id_user)? $rolUsers->getUsers->name : '-' !!} - {!! ($rolUsers->id_user)? $rolUsers->getUsers->email : '-' !!} </p>
</div>

<!-- Id Tp Rol Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_tp_rol', 'Rol:') !!}
  <p>{!! $rolUsers->getTpRol->descripcion !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{!! ($rolUsers->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{!! $rolUsers->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{!! $rolUsers->updated_at !!}</p>
</div>
