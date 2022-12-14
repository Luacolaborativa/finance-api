<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxadiaria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_taxa');
            $table->unsignedFloat('valor');
            $table->date('data');
            $table->foreign('id_taxa')
                ->references('id')
                ->on('taxas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxadiaria');
    }
};
