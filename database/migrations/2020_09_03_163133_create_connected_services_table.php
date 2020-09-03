<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectedServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connected_services', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('service_id')->unsigned()->index('connected_services_SE');
            $table->integer('connected_service_id')->unsigned()->index('connected_services_CSE');

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('connected_service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connected_services');
    }
}
