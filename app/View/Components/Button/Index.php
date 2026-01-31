<?php

namespace App\View\Components\Button;

use Illuminate\View\Component;

class Index extends Component
{
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public $route;
  public $target;
  public $title;
  public $role;
  public $classes;
  public $type;
  public function __construct($route, $target=null, $type)
  {
    $this->route = $route;
    $this->target = $target;
    $this->type = $type;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.button.index');
  }
}
