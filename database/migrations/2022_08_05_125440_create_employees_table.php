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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->CascadeOnDelete();
            $table->foreignId('state_id')->constrained()->CascadeOnDelete();
            $table->foreignId('city_id')->constrained()->CascadeOnDelete();
            $table->foreignId('department_id')->constrained()->CascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('adress');
            $table->char('zip_code');
            $table->date('birth_date');
            $table->date('date_hired');
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
        Schema::dropIfExists('employees');
    }
};
