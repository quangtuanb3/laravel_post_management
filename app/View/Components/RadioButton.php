<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RadioButton extends Component
{
    public string $name;
    public mixed $selected;
    public string $label;
    public string $class;
    public string $subclass;
    public bool $disabled;
    /**
     * @var array<string, string>
     */
    public $options;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param array<string, string> $options
     * @param mixed $selected
     * @param string $label
     * @param string $class
     * @param string $subclass
     * @param bool $disabled
     * @return void
     */
    public function __construct(
        string $name,
        array $options = [],
        $selected = null,
        string $label = '',
        string $class = '',
        string $subclass = '',
        bool $disabled = false
    ) {
        $this->name = $name;
        $this->options = $options;
        $this->selected = $selected;
        $this->label = $label;
        $this->class = $class;
        $this->subclass = $subclass;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.radio-button');
    }
}
