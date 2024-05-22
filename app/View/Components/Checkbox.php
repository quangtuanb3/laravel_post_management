<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Checkbox extends Component
{
    public string $id;
    public string $name;
    public string $label;
    public mixed $value;
    public bool $checked;
    public bool $disabled;

    /**
     * Create a new component instance.
     *
     * @param  string  $id
     * @param  string  $name
     * @param  string  $label
     * @param  mixed  $value
     * @param  bool  $checked
     * @param  bool  $disabled
     * @return void
     */
    public function __construct(string $id, string $name, string $label, mixed $value = 1, bool $checked = false, bool $disabled = false)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->checked = $checked;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('components.checkbox')->with([
            'id' => $this->id,
            'name' => $this->name,
            'label' => $this->label,
            'value' => $this->value,
            'checked' => $this->checked,
            'disabled' => $this->disabled,
        ]);
    }
}
