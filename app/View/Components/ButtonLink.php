<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonLink extends Component
{
    public string $type;
    public string $btnClass;
    public string $text;
    public bool $disabled;
    public string $href;

    /**
     * Create a new component instance.
     *
     * @param string $type
     * @param string $btnClass
     * @param string $text
     * @param bool $disabled
     * @param string $href
     * @return void
     */
    public function __construct($type = 'submit', $btnClass = 'primary', $text = 'Submit', $disabled = false, $href = '')
    {
        $this->type = $type;
        $this->btnClass = $btnClass;
        $this->text = $text;
        $this->disabled = $disabled;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.button-link')->with([
            'type' => $this->type,
            'btnClass' => $this->btnClass,
            'text' => $this->text,
            'disabled' => $this->disabled,
            'href' => $this->href,
        ]);
    }
}
