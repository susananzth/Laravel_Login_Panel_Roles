<!-- Id Users App Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('id_user', 'Usuarios:') !!}
  {!! Form::select('id_user', $tpUsersAps, null, ['id'=>'id_user', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
  <!-- {!! Form::text('id_user', null, ['class' => 'form-control']) !!} -->
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Id Tp Rol Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('id_tp_rol', 'Rol:') !!}
  {!! Form::select('id_tp_rol', $tpRols, null, ['id'=>'id_tp_rol', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
  <!-- {!! Form::text('id_tp_rol', null, ['class' => 'form-control']) !!} -->
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Submit Field -->
<div class="form-group col-sm-12"><div class="input-group col-xs-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-registro btn-default']) !!}
  <a href="{!! route('rol-usuarios.index') !!}" class="btn btn-registro btn-default">Cancelar</a>
</div><div><span class="help-block" id="error"></span></div></div>
