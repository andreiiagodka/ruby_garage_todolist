<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeadlineToTasksTable extends Migration
{
  public function up()
  {
    Schema::table('tasks', function(Blueprint $table) {
      $table->timestamp('deadline')->after('position');
    });
  }

  public function down()
  {
    Schema::table('tasks', function(Blueprint $table) {
      $table->dropColumn('deadline');
    });
  }
}
