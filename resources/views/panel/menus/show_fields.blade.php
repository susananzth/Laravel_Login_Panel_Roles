<!-- Menu Field -->
<div class="form-group col-sm-6">
  {!! Form::label('menu', 'Menú:') !!}
  <p>{!! $menu->menu !!}</p>
</div>

<!-- Section Field -->
<div class="form-group col-sm-6">
  {!! Form::label('section', 'Sección:') !!}
  <p>{!! $menu->section !!}</p>
</div>

<!-- Path Field -->
<div class="form-group col-sm-6">
  {!! Form::label('path', 'Trayecto:') !!}
  <p>{!! $menu->path !!}</p>
</div>

<!-- Icon Field -->
<div class="form-group col-sm-6">
  {!! Form::label('icon', 'Icono:') !!}
  <p>{!! $menu->icon !!}</p>
</div>

<!-- Note Field -->
<div class="form-group col-sm-6">
  {!! Form::label('note', 'Nota:') !!}
  <p>{!! $menu->note !!}</p>
</div>

<!-- Status System Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status_system', 'Estatus Sistema:') !!}
  <p>{!! ($menu->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Status User Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status_user', 'Estatus Usuario:') !!}
  <p>{!! ($menu->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Modified By Field -->
<div class="form-group col-sm-6">
  {!! Form::label('modified_by', 'Modificado por:') !!}
  <p>{!! $menu->modified_by !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{!! $menu->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{!! $menu->updated_at !!}</p>
</div>
