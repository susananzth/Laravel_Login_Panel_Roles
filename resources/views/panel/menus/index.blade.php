@extends('layouts.app')
@section('title', 'Menú')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/DataTable/Responsive-2.2.2/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/DataTable/DataTables-1.10.18/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/inputs.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<section class="content-header">
  <h1 class="pull-left">Men&uacute;</h1>
  <h1 class="pull-right">
    <a class="btn btn-registro btn-default" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('menus.create') !!}">Agregar</a>
  </h1>
</section>

  <div class="clearfix"></div>
    @include('flash::message')
    <div class="content">

      <!-- Filtros para busqueda -->
      <div class="box box-success">
        <form id=formIndexMenus>
          <meta name="csrf-token" content="{{ csrf_token() }}">
          <div class="box-body">

            <div class="row">

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="id_pay" class="control-label">Men&uacute;</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-th-large"></i></div>
                    {!! Form::text('menu', null, ['id'=> 'menu', 'class' => 'form-control']) !!}
                  </div>
                  <div><span class="help-block" id="error"></span></div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="id_pay" class="control-label">Secci&oacute;n</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-qrcode"></i></div>
                    {!! Form::text('section', null, ['id'=> 'section', 'class' => 'form-control']) !!}
                  </div>
                  <div><span class="help-block" id="error"></span></div>
                </div>
              </div>

            </div>

          </div>

          <div class="box-footer">
            <button type="button" class="btn btn-clean btn-default" id="clean">Limpiar</button>
            <button type="button" class="btn btn-search pull-right btn-default btn-registro" id="search">Buscar</button>
          </div>
        </form>
      </div>
      <!-- Filtros para busqueda -->

      <div class="clearfix"></div>
      <div class="box box-success">
        <div class="box-body">
          @include('panel.menus.table')
        </div>
      </div>
      <div class="text-center">
      </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/DataTable/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/DataTable/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('js/panel/menus/index.js')}} "></script>
@endsection
