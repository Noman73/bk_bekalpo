<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMethodIdToFeaturedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('featureds', function (Blueprint $table) {
            $table->unsignedBigInteger('method_id')->after('package_id');
            $table->string('transaction')->after('method_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('featureds', function (Blueprint $table) {
            //
        });
    }
}
