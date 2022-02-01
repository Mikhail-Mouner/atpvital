<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['free', 'paid'])->default('free');
            $table->string('title')->unique();
            $table->text('description');
            $table->timestamp('start_date');
            $table->foreignId( 'category_id' )->constrained()->cascadeOnDelete();
            $table->bigInteger('advertiser')->unsigned();
            $table->foreign('advertiser')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('ads');
    }
}
