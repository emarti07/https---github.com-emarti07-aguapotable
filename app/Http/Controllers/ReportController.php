<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Factura; use App\Models\Pago; use App\Models\Cliente;
class ReportController extends Controller {
    public function pendientes(){ $facturas = Factura::where('estado','pendiente')->with('cliente')->get(); return view('reports.pendientes', compact('facturas')); }
    public function ingresosMes($year=null,$month=null){
        $year = $year ?? date('Y'); $month = $month ?? date('m');
        $pagos = Pago::whereYear('fecha_pago',$year)->whereMonth('fecha_pago',$month)->get();
        $total = $pagos->sum('monto');
        return view('reports.ingresos_mes', compact('pagos','total','year','month'));
    }
    public function clientesActivos(){ $clientes = Cliente::where('estado','activo')->get(); return view('reports.clientes_activos', compact('clientes')); }
}
