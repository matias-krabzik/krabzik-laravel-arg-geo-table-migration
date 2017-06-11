<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GeoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('full_name');
            $table->string('phone_code');

            $table->timestamps();
        });

        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');

            $table->timestamps();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('full_name')->nullable()->default(null);
            $table->string('cp')->nullable();

            $table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('states');

            // INDEXES
            $table->index('name');
            $table->index('cp');

            $table->timestamps();
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->integer('capital_id')->unsigned()->nullable()->default(null)->after('phone_code');
            $table->foreign('capital_id')->references('id')->on('cities');
        });

        Schema::table('states', function (Blueprint $table) {
            $table->integer('capital_id')->unsigned()->nullable()->default(null)->after('country_id');
            $table->foreign('capital_id')->references('id')->on('cities');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('states', function (Blueprint $table) {
            if (Schema::hasColumn('states', 'capital_id')) {
                $table->dropForeign('states_capital_id_foreign');
                $table->dropIndex('states_capital_id_foreign');
                $table->dropColumn('capital_id');
            }
        });

        Schema::table('countries', function (Blueprint $table) {
            if (Schema::hasColumn('countries', 'capital_id')) {
                $table->dropForeign('countries_capital_id_foreign');
                $table->dropIndex('countries_capital_id_foreign');
                $table->dropColumn('capital_id');
            }
        });

        Schema::dropIfExists('cities');

        Schema::dropIfExists('states');

        Schema::dropIfExists('countries');

    }
}
