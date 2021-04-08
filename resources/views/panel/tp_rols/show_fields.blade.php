<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $tpRol->id !!}</p>
</div> -->

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
  {!! Form::label('descripcion', 'Descripci&oacute;n:') !!}
  <p>{!! $tpRol->descripcion !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{!! ($tpRol->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{!! $tpRol->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{!! $tpRol->updated_at !!}</p>
</div>
