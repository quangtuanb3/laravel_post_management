<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputField extends Component
{
    public string $field;
    public string $type;

    /**
     *  @param string|null $value
     *  */
    public $value;
    public int $col;
    public bool $disabled;
    public string $label;

    /**
     * Create a new component instance.
     *
     * @param string $field
     * @param string $type
     * @param string|null $value
     * @param int $col
     * @param bool $disabled
     * @param string $label
     */
    public function __construct(
        string $field,
        string $type = 'text',
        $value = '',
        int $col = 12,
        bool $disabled = false,
        string $label = ''
    ) {
        $this->field = $field;
        $this->type = $type;
        $this->value = $value;
        $this->col = $col;
        $this->disabled = $disabled;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return view('components.input-field');
    }
}
