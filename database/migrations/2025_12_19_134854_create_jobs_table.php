<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('tb_job', function (Blueprint $table) {
        $table->id('id_job');
        
        // Foreign Key ke tb_board
        $table->foreignId('id_board')
            ->constrained('tb_board', 'id_board')
            ->onDelete('cascade');
        $table->text('deskripsi');
        
        // ck_job (Checklist). Pakai boolean (true/false) atau integer (0/1)
        // default(0) artinya belum dicentang saat dibuat
        $table->boolean('ck_job')->default(0); 
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
