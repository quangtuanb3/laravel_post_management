<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputError extends Component
{
    public string $field;

    /**
     * Create a new component instance.
     *
     * @param  string  $field
     * @return void
     */
    public function __construct(string $field)
    {
        $this->field = $field;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.input-error')->with([
            'field' => $this->field,
        ]);
    }
}
