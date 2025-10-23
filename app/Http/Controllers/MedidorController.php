<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Medidor; use App\Models\Cliente;
class MedidorController extends Controller {
    public function index(){ $medidores = Medidor::with('cliente')->paginate(15); return view('medidores.index', compact('medidores')); }
    public function create(){ $clientes = Cliente::all(); return view('medidores.create', compact('clientes')); }
    public function store(Request $r){ Medidor::create($r->all()); return redirect()->route('medidores.index')->with('success','Medidor creado'); }
    public function edit($id){ $m = Medidor::findOrFail($id); $clientes=Cliente::all(); return view('medidores.edit', compact('m','clientes')); }
    public function update(Request $r,$id){ Medidor::findOrFail($id)->update($r->all()); return redirect()->route('medidores.index')->with('success','Medidor actualizado'); }
    public function destroy($id){ Medidor::findOrFail($id)->delete(); return back()->with('success','Medidor eliminado'); }
}
