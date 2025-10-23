@extends('layouts.app')
@section('content')
<h4>Editar Cliente</h4>
<form method="POST" action="{{ route('clientes.update', $c->id)')
      @method('PUT' }}">
  @csrf
  <div class="mb-3"><label>Nombre</label><input name="nombre" class="form-control" required></div>
  <div class="mb-3"><label>Apellido</label><input name="apellido" class="form-control"></div>
  <div class="mb-3"><label>Dirección</label><input name="direccion" class="form-control"></div>
  <button class="btn btn-accent">Guardar</button>
</form>
@endsection
