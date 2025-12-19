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
    Schema::create('tb_user', function (Blueprint $table) {
        // id_user sebagai primary key
        $table->id('id_user'); 
        
        // name_user string biasa
        $table->string('name_user'); 
        
        // email harus unik
        $table->string('email_user')->unique(); 
        
        // password
        $table->string('pass_user'); 
        
        $table->timestamps(); // created_at & updated_at
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_customs');
    }
};
