<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Datos de ejemplo para el dashboard
        $stats = [
            'clientes' => 124,
            'facturas_pendientes' => 18,
            'recaudado_mes' => 4520.75
        ];
        return view('dashboard', compact('stats'));
    }
}
