<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTask extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->morphs('taskable');
            $table->json('data')->nullable();
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropMorphs('taskable');
            $table->dropColumn('data');
        });
    }
}
