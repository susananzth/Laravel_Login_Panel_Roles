@extends('layouts.app')
@section('title', 'Editar tipo de token')

@section('css')
@endsection

@section('content')
<!-- Cabecera del contenedor de la vista -->
<div class="page-header pb-10 page-header-dark bg-content">
    <div class="container-fluid">
        <div class="page-header-content">
            <h1 class="page-header-title">
                <div class="page-header-icon"><i class="fas fa-edit"></i></div>
                <span>Editar tipo de token</span>
            </h1>
            <div class="page-header-subtitle"><i class="fas fa-barcode"></i><span class="pl-2">Editar los tipos de tokens de la Oficina Virtual</span></div>
        </div>
    </div>
</div>
<!-- Container-fluid -->
<div class="container-fluid mt-n10">
  <!-- Card -->
  <div class="card">
    <!-- Card Title -->
    <div class="card-header border-bottom">Editar token de usuario</div>
    <!-- Card Body -->
    <div class="card-body">
      <!-- Form de formEditTpTokens -->
      <form id="formEditTpTokens" method="POST" action="{{ route('token.update', $tpToken->id) }}">
          @method('PATCH')<!-- Indico el método del update -->
          {{ csrf_field() }}<!-- token del form -->
          <!-- INPUT descripción del token -->
          <div class="form-row justify-content-center">
            <div class="col-xs-12 col-sm-6">
              <label for="descripcion">Descripci&oacute;n del tipo de token:</label><code>*</code>
              <div class="input-group mb-2">
                <input class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $tpToken->descripcion) }}" id="descripcion" name="descripcion" type="text"/>
                <!-- Mensaje de error de validación del campo -->
                @error('descripcion')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
              </div>
            </div>
          </div>
          <!-- SELECT estado del tipo de token -->
          <div class="form-row justify-content-center">
            <div class="col-xs-12 col-sm-6">
              <label for="status">Estado del tipo del token:</label><code>*</code>
              <div class="input-group mb-2">
                <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                  <option selected disabled readonly>Seleccione...</option>
                  <option value="1" {{ ( 1 == $tpToken->status) ? 'selected' : '' }}>Activo</option>
                  <option value="0" {{ ( 0 == $tpToken->status) ? 'selected' : '' }}>Inactivo</option>
                </select>
                <!-- Mensaje de error de validación del campo -->
                @error('status')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
              </div>
            </div>
          </div>
          <!-- BTN Guardar token -->
          <div class="col-xs-12 col-sm-6 pt-4 pl-1 pr-1 small mx-auto">
            <a href="{{ route('token.index') }}" class="btn btn-danger">Cancelar</a>
            <input class="btn btn-primary float-right" type="submit" value="Actualizar">
          </div>
      </form><!-- END Form de formEditTpTokens -->
    </div><!-- END Card Body -->
  </div><!-- END Card -->
</div><!-- END Container-fluid -->
@endsection

@section('scripts')
<!-- Llamado del script de esta vista -->
<script src="{{ asset('js/panel/tp_tokens/edit.js')}} "></script>
@endsection
