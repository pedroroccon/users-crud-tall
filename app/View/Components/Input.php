<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{

    public $attribute;

    public $label;

    public $value;

    public $type;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($attribute, $label, $value = null, $type = 'text')
    {
        $this->attribute = $attribute;
        $this->label = $label;
        $this->value = $value;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
