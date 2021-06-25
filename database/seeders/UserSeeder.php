<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  public function run()
  {
    User::updateOrCreate(
      ['email' => 'admin@admin.com'],
      ['name' => 'Admin', 'password' => bcrypt('admin')]
    );
  }
}
