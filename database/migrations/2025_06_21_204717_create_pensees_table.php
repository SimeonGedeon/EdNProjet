<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pensees', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('verset');
            $table->text('contenu');
            $table->string('hashtags')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('est_publie')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pensees');
    }
};
