<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->unsignedBigInteger('position_id');
            $table->date('hire_date');
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique();
            $table->float('salary', 10, 2);
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('admin_created_id')->nullable();
            $table->unsignedBigInteger('admin_updated_id')->nullable();


            $table->foreign('position_id')
                ->references('id')
                ->on('positions');

            $table->foreign('admin_created_id')
                ->references('id')
                ->on('users');

            $table->foreign('admin_updated_id')
                ->references('id')
                ->on('users');

            $table->foreign('manager_id')
                ->references('id')
                ->on('employees');
        });
    }


//

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
