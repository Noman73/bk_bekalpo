<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameBnAndChangeNameToNameEnFuelTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fuel_types', function (Blueprint $table) {
            $table->renameColumn('name','name_en');
            $table->string('name_bn')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fuel_types', function (Blueprint $table) {
            $table->renameColumn('name_en','name');
            $table->dropColumn('name_bn');
        });
    }
}
