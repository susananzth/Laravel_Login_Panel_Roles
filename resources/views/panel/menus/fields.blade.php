<!-- Menu Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('menu', 'Menú:') !!}
  {!! Form::text('menu', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Section Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('section', 'Sección:') !!}
  {!! Form::select('section', $section, null, ['id'=>'section', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Path Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('path', 'URL:') !!}
  {!! Form::text('path', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Icon Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('icon', 'Icono:') !!}
  {!! Form::text('icon', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Note Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('orden', 'Orden:') !!}
  {!! Form::text('orden', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Modified By Field -->
{!! Form::hidden('modified_by', null, ['class' => 'form-control']) !!}

<!-- Submit Field -->
<div class="form-group col-sm-12"><div class="input-group col-xs-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-registro btn-default']) !!}
  <a href="{!! route('menus.index') !!}" class="btn btn-registro btn-default">Cancelar</a>
</div><div><span class="help-block" id="error"></span></div></div>
