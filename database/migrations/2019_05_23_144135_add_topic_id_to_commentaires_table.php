<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTopicIdToCommentairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commentaires', function (Blueprint $table) {
            $table->bigInteger('topic_id')->unsigned()->after('message');
            $table->foreign('topic_id')->references('id')->on('topics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commentaires', function (Blueprint $table) {
            //
        });
    }
}
