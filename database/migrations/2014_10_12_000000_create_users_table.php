<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username',200)->unique();
            $table->string('name',200);
            $table->string('email',200)->unique();
            $table->string('phone',200);
            $table->string('adress',200);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',200);
            $table->string('image',200)->nullable();
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('district_id');
            $table->tinyInteger('gender');
            $table->string('birth_date',200)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
