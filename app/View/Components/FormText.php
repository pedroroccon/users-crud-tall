<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormText extends Component
{

    /**
     * Defines the type of
     * form text.
     * 
     * @var string
     */
    public $type;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = null)
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
        return view('components.form-text');
    }
}
