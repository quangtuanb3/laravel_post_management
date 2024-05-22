<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public string $type;
    public string $btnClass;
    public string $text;
    public string $disabled;

    /**
     * Create a new component instance.
     *
     * @param string $type
     * @param string $btnClass
     * @param string $text
     * @param string $disabled
     * @return void
     */
    public function __construct($type = 'submit', $btnClass = 'primary', $text = 'Submit', $disabled = '')
    {
        $this->type = $type;
        $this->btnClass = $btnClass;
        $this->text = $text;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.button')->with([
            'type' => $this->type,
            'btnClass' => $this->btnClass,
            'text' => $this->text,
            'disabled' => $this->disabled,
        ]);
    }
}
