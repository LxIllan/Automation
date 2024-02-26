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
        Schema::create('pieces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->unsignedTinyInteger('qty');
            $table->float('hours', 5)->unsigned();
            $table->enum('status', ["Pedido","Proceso","Terminado","Pausado","Cancelado"])->default('Pedido');
            $table->foreignId('project_id');
            $table->foreignId('worker_id');
            $table->foreignId('piece_category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pieces');
    }
};
