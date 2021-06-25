<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
  public string $variant;

  public function __construct($variant = 'success')
  {
    $this->variant = $variant;
  }

  public function render()
  {
    return view('components.alert', ['variant' => $this->variant]);
  }
}
