@extends('layouts.app')
@section('content')
<h4>Facturas pendientes</h4>
<table class="table"><thead><tr><th>ID</th><th>Cliente</th><th>Periodo</th><th>Monto</th></tr></thead><tbody>
@foreach($facturas as $f)
  <tr><td>{{ $f->id }}</td><td>{{ $f->cliente->nombre }} {{ $f->cliente->apellido }}</td><td>{{ $f->periodo }}</td><td>{{ number_format($f->monto,2) }}</td></tr>
@endforeach
</tbody></table>
@endsection
