<?php

namespace Database\Seeders;

use App\Models\Counter;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    $this->call([
      UserSeeder::class
    ]);

    foreach (CarbonPeriod::create('2021-04-01', now()) as $date) {
      Counter::updateOrCreate(['date' => $date->format('Y-m-d')], ['current' => rand(7, 100)]);
    }
  }
}
