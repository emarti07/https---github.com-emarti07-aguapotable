<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cliente;
class ClienteController extends Controller {
    public function index(){ $clientes = Cliente::paginate(15); return view('clientes.index', compact('clientes')); }
    public function create(){ return view('clientes.create'); }
    public function store(Request $r){ $data = $r->validate(['nombre'=>'required']); Cliente::create($data); return redirect()->route('clientes.index')->with('success','Cliente creado');}
    public function edit($id){ $c = Cliente::findOrFail($id); return view('clientes.edit', compact('c')); }
    public function update(Request $r,$id){ $c=Cliente::findOrFail($id); $c->update($r->all()); return redirect()->route('clientes.index')->with('success','Cliente actualizado');}
    public function destroy($id){ Cliente::findOrFail($id)->delete(); return back()->with('success','Cliente eliminado');}
    public function show($id){ $c=Cliente::findOrFail($id); return view('clientes.show', compact('c')); }
}
