<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    
    /**
     * Defines which template 
     * we should load, based on 
     * the type of button.
     *
     * @var string
     */
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'default')
    {
        $this->type = $type;
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.buttons.' . $this->type);
    }
}
