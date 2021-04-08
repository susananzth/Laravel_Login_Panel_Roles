@extends('layouts.app')
@section('title', 'Mostrar tipo de token')

@section('css')
@endsection

@section('content')
<!-- Cabecera del contenedor de la vista -->
<div class="page-header pb-10 page-header-dark bg-content">
    <div class="container-fluid">
        <div class="page-header-content">
            <h1 class="page-header-title">
                <div class="page-header-icon"><i class="fas fa-eye"></i></div>
                <span>Mostar tipo de token</span>
            </h1>
            <div class="page-header-subtitle"><i class="fas fa-barcode"></i><span class="pl-2">Mostrar el tipo de token de la Oficina Virtual</span></div>
        </div>
    </div>
</div>
<!-- Container-fluid -->
<div class="container-fluid mt-n10">
  <!-- Card -->
  <div class="card">
    <!-- Card Title -->
    <div class="card-header border-bottom">Mostrar tipo de token</div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="form-row">
        <!-- Descripción del tipo de token -->
        <div class="col-xs-12 col-sm-6">
          <label>Descripci&oacute;n del tipo de token:</label>
          <div class="bg-light border p-3 mb-3">{{ $tpToken->descripcion }}</div>
        </div>
        <!-- Estado del tipo de token -->
        <div class="col-xs-12 col-sm-6">
          <label>Estado del token:</label>
          <div class="bg-light border p-3 mb-3">{{ ($tpToken->status ==1)? 'ACTIVADO' : 'DESACTIVADO' }}</div>
        </div>
      </div>
      <div class="form-row">
        <!-- Creado en -->
        <div class="col-xs-12 col-sm-6">
          <label>Creado en:</label>
          <div class="bg-light border p-3 mb-3">{{ $tpToken->created_at }}</div>
        </div>
        <!-- Modificado en -->
        <div class="col-xs-12 col-sm-6">
          <label>Modificado en:</label>
          <div class="bg-light border p-3 mb-3">{{ $tpToken->updated_at }}</div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 pt-4 pl-1 pr-1 small mx-auto">
        <a href="{!! route('token.index') !!}" class="btn btn-primary btn-block">Atrás</a>
      </div>
    </div><!-- END Card Body -->
  </div><!-- END Card -->
</div><!-- END Container-fluid -->
@endsection
