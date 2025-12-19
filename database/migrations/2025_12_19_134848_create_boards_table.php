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
    Schema::create('tb_board', function (Blueprint $table) {
        $table->id('id_board');
        
        // Foreign Key ke tb_user
        // onDelete('cascade') artinya jika user dihapus, board-nya ikut terhapus
        $table->foreignId('id_user')
            ->constrained('tb_user', 'id_user')
            ->onDelete('cascade'); 
        $table->string('board_name');
        $table->date('dl_start'); // Deadline start
        $table->date('dl_finsh'); // Deadline finish
        $table->string('bg'); // Background (bisa kode warna hex atau url gambar)
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boards');
    }
};
