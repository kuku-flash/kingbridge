<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_ads', function (Blueprint $table) {
            $table->id();
            $table->string('job_title')->nullable();
            $table->string('job_description')->nullable();

            $table->unsignedBigInteger('postads_id')->nullable();

            $table->foreign('postads_id')->references('id')->on('post_ads')->onDelete('cascade');
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
        Schema::dropIfExists('job_ads');
    }
}
