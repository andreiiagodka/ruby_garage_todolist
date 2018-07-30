<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPositionToTasks extends Migration
{
  public function up()
  {
    Schema::table('tasks', function(Blueprint $table) {
      $table->integer('position')->after('status');
    });
  }

  public function down()
  {
    Schema::table('tasks', function(Blueprint $table) {
      $table->dropColumn('position');
    });
  }
}
