<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
  /**
   * Create a new component instance.
   *
   * @return void
   */


  public $links;
  public function __construct()
  {
    $this->links = [
      ['navLink' => 'landing.index', 'navText' => 'Home'],
      ['navLink' => 'about', 'navText' => 'About'],
      ['navLink' => 'contact', 'navText' => 'Contact'],
      ['navLink' => 'term', 'navText' => 'Term'],
      ['navLink' => 'donation', 'navText' => 'Donation'],
    ];
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.navbar');
  }
}
