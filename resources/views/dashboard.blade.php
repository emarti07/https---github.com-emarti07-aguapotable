@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-3">
    <div class="card shadow-sm">
      <div class="card-body">
        <h6>Clientes</h6>
        <h3>{{ $totales['clientes'] }}</h3>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card shadow-sm">
      <div class="card-body">
        <h6>Facturas pendientes</h6>
        <h3 class="text-danger">{{ $totales['facturas_pendientes'] }}</h3>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card shadow-sm">
      <div class="card-body">
        <h6>Ingresos este mes</h6>
        <h3 class="text-success">{{ number_format($totales['ingresos_mes'],2) }}</h3>
      </div>
    </div>
  </div>
</div>
@endsection
