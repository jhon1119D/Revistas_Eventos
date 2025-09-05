<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('magazines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nombre', 255)->nullable();
            $table->string('enlace', 255)->nullable();
            $table->string('accesibilidad', 20)->nullable();
            $table->string('pais', 50)->nullable();
            $table->string('clasificacion', 50)->nullable();
            $table->string('documento_url', 255)->nullable();
            $table->string('autor_nombre')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->index('user_id', 'fk_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('magazines', function (Blueprint $table) {
            $table->dropForeign(['user_id']);        
            $table->dropIndex('fk_user_id');  
                 
        });

        Schema::dropIfExists('magazines');           
    }
};
