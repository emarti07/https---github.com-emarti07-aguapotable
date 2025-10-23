<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MedidorController;
use App\Http\Controllers\LecturaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ReportController;

Route::get('/', function(){ return redirect()->route('dashboard'); });
Route::get('/dashboard', function(){
    $totales = [
        'clientes' => \App\Models\Cliente::count(),
        'facturas_pendientes' => \App\Models\Factura::where('estado','pendiente')->count(),
        'ingresos_mes' => \App\Models\Pago::whereMonth('fecha_pago', date('m'))->whereYear('fecha_pago', date('Y'))->sum('monto'),
    ];
    return view('dashboard', compact('totales'));
})->name('dashboard');

Route::resource('clientes', ClienteController::class);
Route::resource('medidores', MedidorController::class);
Route::resource('lecturas', LecturaController::class)->only(['index','create','store','destroy']);
Route::resource('facturas', FacturaController::class)->only(['index','create','store','show']);
Route::post('facturas/{id}/mark-paid', [FacturaController::class,'markPaid'])->name('facturas.markPaid');

Route::resource('pagos', PagoController::class)->only(['index','create','store']);

Route::get('reports/pendientes', [ReportController::class,'pendientes'])->name('reports.pendientes');
Route::get('reports/ingresos/{year?}/{month?}', [ReportController::class,'ingresosMes'])->name('reports.ingresos_mes');
Route::get('reports/clientes-activos', [ReportController::class,'clientesActivos'])->name('reports.clientes_activos');
