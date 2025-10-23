<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pago; use App\Models\Factura;
class PagoController extends Controller {
    public function index(){ $pagos = Pago::with('factura')->orderBy('fecha_pago','desc')->paginate(20); return view('pagos.index', compact('pagos')); }
    public function create(){ $facturas = Factura::where('estado','pendiente')->get(); return view('pagos.create', compact('facturas')); }
    public function store(Request $r){ $data = $r->validate(['factura_id'=>'required','fecha_pago'=>'required','monto'=>'required']); Pago::create($data); $f=Factura::find($data['factura_id']); if($f){ $f->estado='pagado'; $f->save(); } return redirect()->route('pagos.index')->with('success','Pago registrado'); }
}
