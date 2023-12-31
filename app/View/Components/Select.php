<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $value;
    public $options;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $value, $options)
    {
        $this->name     = $name;
        $this->value    = $value;
        $this->options  = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select');
    }
}
