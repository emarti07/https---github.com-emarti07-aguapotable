<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Lectura extends Model {
    protected $table = 'lecturas';
    protected $fillable = ['medidor_id','periodo','lectura'];
    public function medidor(){ return $this->belongsTo(Medidor::class,'medidor_id'); }
}
