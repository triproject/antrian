<?php

namespace App\Http\Controllers;

use App\Models\Counter;

class CounterController extends Controller
{
  public function index()
  {
    return view('counter');
  }

  public function up()
  {
    Counter::up();
    return Counter::getCurrent();
  }

  public function getCurrent()
  {
    return Counter::getCurrent();
  }
}
