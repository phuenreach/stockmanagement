<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecievPoductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reciev_poducts', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id");
            $table->integer("user_id");
            $table->float("price");
            $table->float("qty");
            $table->float("sub_total");
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
        Schema::dropIfExists('reciev_poducts');
    }
}
