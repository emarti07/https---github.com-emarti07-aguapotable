<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model {
    protected $table = 'pagos';
    protected $fillable = ['factura_id','fecha_pago','monto','metodo'];
    public function factura(){ return $this->belongsTo(Factura::class,'factura_id'); }
}
