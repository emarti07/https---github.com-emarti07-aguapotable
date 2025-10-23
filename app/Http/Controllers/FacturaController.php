<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Factura; use App\Models\Cliente;
class FacturaController extends Controller {
    public function index(){ $facturas = Factura::with('cliente')->orderBy('fecha_emision','desc')->paginate(20); return view('facturas.index', compact('facturas')); }
    public function create(){ $clientes = Cliente::all(); return view('facturas.create', compact('clientes')); }
    public function store(Request $r){
        $data = $r->validate(['cliente_id'=>'required','periodo'=>'required','consumo'=>'required','monto'=>'required']);
        $data['fecha_emision'] = $data['fecha_emision'] ?? date('Y-m-d');
        Factura::create($data);
        return redirect()->route('facturas.index')->with('success','Factura creada');
    }
    public function show($id){ $f = Factura::with('cliente','pagos')->findOrFail($id); return view('facturas.show', compact('f')); }
    public function markPaid($id){
        $f = Factura::findOrFail($id); $f->estado='pagado'; $f->save(); return back()->with('success','Factura marcada como pagada');
    }
}
