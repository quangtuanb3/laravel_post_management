<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\View\Component;

class Truncate extends Component
{
    public string $text;
    public int $length;

    /**
     * Truncate constructor.
     *
     * @param string $text
     * @param int $length
     */
    public function __construct(string $text, int $length = 100)
    {
        $this->text = $text;
        $this->length = $length;
    }

    /**
     * Render the component.
     *
     * @return ViewContract
     */
    public function render(): ViewContract
    {
        return view('components.truncate');
    }

    /**
     * Get the truncated text.
     *
     * @return string
     */
    public function truncatedText(): string
    {
        if (strlen($this->text) <= $this->length) {
            return $this->text;
        }

        $truncated = substr($this->text, 0, $this->length) ?: '';

        $temp =  strrpos($truncated, ' ');

        if (!$temp) {
            $temp = null;
        }
        
        if (substr($truncated, -1) !== ' ') {
            $truncated = substr($truncated, 0, $temp) ?: $truncated;
        }

        return $truncated . '...';
    }
}
