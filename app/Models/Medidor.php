<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Medidor extends Model {
    protected $table = 'medidores';
    protected $fillable = ['numero','cliente_id','estado','ubicacion'];
    public function cliente(){ return $this->belongsTo(Cliente::class,'cliente_id'); }
    public function lecturas(){ return $this->hasMany(Lectura::class,'medidor_id'); }
}
