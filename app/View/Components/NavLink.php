<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavLink extends Component
{
  /**
   * Create a new component instance.
   *
   * @return void
   */

  public string $route;
  public string $active;
  public function __construct($route, $active = false)
  {
    $this->route = $route;
    $this->active = $active;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.nav-link');
  }
}
