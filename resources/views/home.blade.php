@extends('layouts.app')
@section('title', 'Panel')

@section('css')

@endsection

@section('content')
<div class="page-header pb-10 page-header-dark bg-content">
    <div class="container-fluid">
        <div class="page-header-content">
            <h1 class="page-header-title">
                <div class="page-header-icon"><i class="fas fa-building"></i></div>
                <span>Panel Administrativo</span>
            </h1>
            <div class="page-header-subtitle">Descripción Panel Administrativo</div>
        </div>
    </div>
</div>
<div class="container-fluid mt-n10">
    <div class="card mb-4">
        <div class="card-header">Ejemplo de cantidad de ganancias generadas en el mes</div>
        <div class="card-body">
            <div class="chart-area"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
        </div>
        <div class="card-footer small text-muted">Actualizado ayer a las 11:59 PM</div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('/js/chart-area-demo.js') }}"></script>
@endsection
