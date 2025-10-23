<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aguapotable - Sistema</title>
  <!-- Bootstrap 5 (assume included in starter) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root{
      --brand-blue:#0d6efd;
      --brand-orange:#ff8800;
      --brand-green:#28a745;
      --brand-red:#dc3545;
    }
    .navbar-brand{ font-weight:700; color:var(--brand-blue) }
    .btn-primary{ background:var(--brand-blue); border:none; }
    .btn-accent{ background:var(--brand-orange); color:#fff; border:none; }
    .text-success{ color:var(--brand-green) !important; }
    .text-danger{ color:var(--brand-red) !important; }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('dashboard') }}">AguaPotable</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('medidores.index') }}">Medidores</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('facturas.index') }}">Facturas</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('pagos.index') }}">Pagos</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('reports.pendientes') }}">Reportes</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
  @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
