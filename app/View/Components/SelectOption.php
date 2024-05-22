<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectOption extends Component
{
    public string $id;
    public string $name;
    public string $label;
    public string $selected;
    public string $class;
    public bool $disabled;
    /**
     * @var array<string, string>
     */
    public $options;

    /**
     * Create a new component instance.
     *
     * @param string $id
     * @param string $name
     * @param string $label
     * @param array<string, string> $options
     * @param string $selected
     * @param string $class
     * @param bool $disabled
     * @return void
     */
    public function __construct(
        string $id,
        string $name,
        string $label = '',
        array $options = [],
        string $selected = '',
        string $class = '',
        bool $disabled = false
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->selected = $selected;
        $this->class = $class;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-option');
    }
}
