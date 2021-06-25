<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CounterMigration extends Migration
{
  private $counters = 'counters';

  public function up()
  {
    Schema::create($this->counters, function (Blueprint $table) {
      $table->id();
      $table->date('date')->unique();
      $table->integer('current')->default(1);
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists($this->counters);
  }
}
