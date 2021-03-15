<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Base extends Component
{

    /**
     * Defines the page's 
     * title.
     * 
     * @var string
     */
    public $title;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('layouts.base');
    }
}
