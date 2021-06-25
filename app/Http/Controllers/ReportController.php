<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
  public function index()
  {
    $counters = Counter::latest('date')->paginate();

    return view('report', ['counters' => $counters]);
  }
}
