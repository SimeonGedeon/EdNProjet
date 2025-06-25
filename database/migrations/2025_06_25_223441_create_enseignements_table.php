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
        Schema::create('enseignements', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('categorie');
            $table->text('contenu');
            $table->string('image_path')->nullable();
            $table->string('hashtags')->nullable();
            $table->boolean('est_publie')->default(false);
            $table->timestamp('date_publication')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignements');
    }
};
