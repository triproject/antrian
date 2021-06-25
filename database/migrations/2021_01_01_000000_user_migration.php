<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserMigration extends Migration
{
  private $users = 'users';

  public function up()
  {
    Schema::create($this->users, function (Blueprint $table) {
      $table->id();
      $table->string('name', 100);
      $table->string('email')->unique();
      $table->string('phone')->nullable();
      $table->string('password');
      $table->text('address')->nullable();
      $table->text('city')->nullable();
      $table->string('gender', 20)->default('Pria');
      $table->date('birthdate', 30)->nullable();
      $table->boolean('is_active')->default(1);
      $table->string('remember_token')->nullable();
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists($this->users);
  }
}
