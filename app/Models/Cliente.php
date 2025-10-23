<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {
    protected $table = 'clientes';
    protected $fillable = ['nombre','apellido','identidad','direccion','telefono','email','estado'];
    public function medidores(){ return $this->hasMany(Medidor::class,'cliente_id'); }
    public function facturas(){ return $this->hasMany(Factura::class,'cliente_id'); }
}
