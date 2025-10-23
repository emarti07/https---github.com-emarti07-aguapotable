<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('lecturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medidor_id')->constrained('medidores')->onDelete('cascade');
            $table->date('fecha_lectura');
            $table->decimal('lectura_anterior', 12, 2)->default(0);
            $table->decimal('lectura_actual', 12, 2)->default(0);
            $table->decimal('consumo', 12, 2)->virtualAs('lectura_actual - lectura_anterior');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lecturas');
    }
};
