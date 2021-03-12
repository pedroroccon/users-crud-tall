<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Label extends Component
{

    public $attribute;

    public $name;

    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $attribute)
    {
        $this->name = $name;
        $this->attribute = $attribute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.label');
    }
}
