<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model {
    protected $table = 'facturas';
    protected $fillable = ['cliente_id','periodo','consumo','monto','estado','fecha_emision','fecha_vencimiento'];
    public function cliente(){ return $this->belongsTo(Cliente::class,'cliente_id'); }
    public function pagos(){ return $this->hasMany(Pago::class,'factura_id'); }
}
