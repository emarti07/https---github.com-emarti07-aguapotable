<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Lectura; use App\Models\Medidor;
class LecturaController extends Controller {
    public function index(){ $lecturas = Lectura::with('medidor')->orderBy('periodo','desc')->paginate(20); return view('lecturas.index', compact('lecturas')); }
    public function create(){ $medidores = Medidor::all(); return view('lecturas.create', compact('medidores')); }
    public function store(Request $r){ $r->validate(['medidor_id'=>'required','lectura'=>'required']); Lectura::create($r->all()); return redirect()->route('lecturas.index')->with('success','Lectura guardada'); }
    public function destroy($id){ Lectura::findOrFail($id)->delete(); return back()->with('success','Lectura eliminada'); }
}
