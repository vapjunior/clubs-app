<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associations', function (Blueprint $table) {
            $table->primary(['club_id', 'affiliate_id']);
            $table->unsignedBigInteger('club_id');
            $table->unsignedBigInteger('affiliate_id');
            $table->date('associeted');
            $table->timestamps();
        });

        Schema::table('associations', function($table) {
            $table->foreign('club_id')
                ->references('id')
                ->on('clubs');
            
            $table->foreign('affiliate_id')
                ->references('id')
                ->on('affiliates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associations');
    }
}
