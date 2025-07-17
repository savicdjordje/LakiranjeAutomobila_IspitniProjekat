<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->string('licence_plate');

            $table->string('make');

            $table->string('model');

            $table->date('year');

            $table->bigInteger('client_id')->unsigned();

            $table->timestamp('created_at')->nullable();

            $table->timestamp('updated_at')->nullable();

            $table
                ->foreign('client_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
