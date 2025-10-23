@extends('layouts.app')
@section('content')
<h4>Ingresos - {{ $month }} / {{ $year }}</h4>
<p>Total: <strong class="text-success">{{ number_format($total,2) }}</strong></p>
<table class="table"><thead><tr><th>ID</th><th>Factura</th><th>Fecha</th><th>Monto</th></tr></thead><tbody>
@foreach($pagos as $p)
  <tr><td>{{ $p->id }}</td><td>{{ $p->factura_id }}</td><td>{{ $p->fecha_pago }}</td><td>{{ number_format($p->monto,2) }}</td></tr>
@endforeach
</tbody></table>
@endsection
