<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video', function (Blueprint $table) {
            $table->increments('video_id');
            $table->string('file_title');
            $table->string('survey_name')->nullable();
            $table->string('survey_description')->nullable();
            $table->string('survey_credit')->nullable();
            $table->string('left_credit')->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->timestamp('video_created_at')->nullable();
            $table->timestamp('video_updated_at')->nullable();
            $table->string('amount_per_watch')->nullable();
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
        Schema::dropIfExists('video');
    }
}
