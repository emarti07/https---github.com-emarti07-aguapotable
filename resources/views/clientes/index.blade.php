@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
  <h4>Clientes</h4>
  <a href="{{ route('clientes.create') }}" class="btn btn-accent">Nuevo Cliente</a>
</div>
<table class="table table-striped">
  <thead><tr><th>ID</th><th>Nombre</th><th>Teléfono</th><th>Estado</th><th>Acciones</th></tr></thead>
  <tbody>
    @foreach($clientes as $c)
    <tr>
      <td>{{ $c->id }}</td>
      <td>{{ $c->nombre }} {{ $c->apellido }}</td>
      <td>{{ $c->telefono }}</td>
      <td>@if($c->estado=='activo') <span class="badge bg-success">Activo</span> @else <span class="badge bg-secondary">Inactivo</span> @endif</td>
      <td>
        <a href="{{ route('clientes.edit',$c->id) }}" class="btn btn-sm btn-primary">Editar</a>
        <form action="{{ route('clientes.destroy',$c->id) }}" method="POST" style="display:inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" onclick="return confirm('Eliminar?')">Eliminar</button></form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $clientes->links() }}
@endsection
