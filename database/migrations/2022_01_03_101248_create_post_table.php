<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title',200);
            $table->tinyInteger('ad_type');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->tinyInteger('price_type')->nullable();
            $table->decimal('price',20,2);
            $table->tinyInteger('condition')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->unsignedBigInteger('feature_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->tinyInteger('authenticity')->nullable();
            $table->unsignedBigInteger('item_type')->nullable();
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('phone')->nullable();
            $table->text('description',5000);
            // new added
            $table->decimal('size',20)->nullable();
            $table->decimal('run_kilo',20)->nullable();
            $table->decimal('capacity',20)->nullable();
            $table->unsignedBigInteger('body_type')->nullable();
            $table->unsignedBigInteger('fuel_type')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('manufacture_year',200)->nullable();
            $table->string('registration_year',200)->nullable();
            $table->string('trim',200)->nullable();
            $table->string('adress',200)->nullable();
            $table->tinyInteger('transmission')->nullable();
            // end
            $table->tinyInteger('status');
            $table->timestamp('published_at')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
