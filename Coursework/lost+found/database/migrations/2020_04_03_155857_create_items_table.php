<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
          $table->id();
          $table->timestamps();
          $table->enum('category',['pet','phone','jewellery']);
          $table->string('color');
          $table->date('date_found');
          $table->string('details')->nullable();
          $table->string('place')->nullable();
          $table->bigInteger('claimed_user_id')->nullable()->unsigned();
          $table->foreign('claimed_user_id')
          ->references('id')->on('users')
          ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
