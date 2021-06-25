<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Counter extends Model
{
  use HasFactory;

  public $fillable = [
    'date',
    'current',
  ];

  public $casts = ['date' => 'datetime'];

  public static function up()
  {
    $currentDate = now()->format('Y-m-d');
    $todayCounter = static::where('date', $currentDate)->first();

    if ($todayCounter) {
      $todayCounter->current += 1;
      $todayCounter->save();
    } else {
      $todayCounter = static::create(['date' => $currentDate]);
    }

    return $todayCounter;
  }

  public static function getCurrent()
  {
    $currentDate = now()->format('Y-m-d');
    $todayCounter = static::firstOrCreate(['date' => $currentDate]);
    return Str::padLeft($todayCounter->current, 3, 0);
  }
}
