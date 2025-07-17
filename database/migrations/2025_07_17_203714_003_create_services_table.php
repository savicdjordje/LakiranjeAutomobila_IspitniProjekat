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
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vehicle_id');

            $table->foreignId('employee_id');

            $table->foreignId('admin_id');

            $table->foreignId('status_id');

            $table->string('name');

            $table->text('description');

            $table->timestamp('created_at')->nullable();

            $table->timestamp('updated_at')->nullable();

            $table
                ->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table
                ->foreign('admin_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table
                ->foreign('employee_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table
                ->foreign('vehicle_id')
                ->references('id')
                ->on('vehicles')
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
        Schema::dropIfExists('services');
    }
};
