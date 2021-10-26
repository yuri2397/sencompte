<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer("amount", false, true);
            $table->dateTime("date");
            $table->string("via")->nullable();

            $table->unsignedBigInteger("profile_id");
            $table->foreign("profile_id")->references("id")->on("profiles");

            $table->unsignedBigInteger("client_id");
            $table->foreign("client_id")->references("id")->on("clients");

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
        Schema::dropIfExists('payments');
    }
}
