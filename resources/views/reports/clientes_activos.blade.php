@extends('layouts.app')
@section('content')
<h4>Clientes activos</h4>
<ul class="list-group">
@foreach($clientes as $c)<li class="list-group-item">{{ $c->nombre }} {{ $c->apellido }} - {{ $c->telefono }}</li>@endforeach
</ul>
@endsection
