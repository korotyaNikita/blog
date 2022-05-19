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
        Schema::table('comments', function (Blueprint $table) {
            $table->index('post_id', 'comments_post_idx');
            $table->index('user_id', 'comments_user_idx');

            $table->foreign('post_id', 'comments_post_fk')->on('posts')->references('id');
            $table->foreign('user_id', 'comments_user_fk')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_post_fk');
            $table->dropForeign('comments_user_fk');

            $table->dropIndex('comments_post_idx');
            $table->dropIndex('comments_user_idx');
        });
    }
};
