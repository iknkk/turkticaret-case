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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('buyXpcsYpcsFree')->nullable();
            $table->integer('buyXpcsYpcsDiscountAuthorId')->nullable();
            $table->integer('buyXpcsYfreeLimit')->nullable();
            $table->string('overXpriceDiscountAmount')->nullable();
            $table->integer('overXpriceDiscountPercent')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('campaigns');
    }
};
