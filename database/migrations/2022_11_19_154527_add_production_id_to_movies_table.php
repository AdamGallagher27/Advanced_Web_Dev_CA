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
        Schema::table('movies', function (Blueprint $table) {
            $table->unsignedBigInteger("production_id");
            $table->foreign("production_id")->references("id")->on("productions")->onUpdate("cascade"); 
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("movies", function (Blueprint $table) {

            $table->dropForeign(["production_id"]);
            $table->dropColumn("production_id");

        });
    }
};
