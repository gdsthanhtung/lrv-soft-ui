<?php

namespace App\View\Components\Select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Option extends Component
{
    private $ctrl;
    private $displayValue;
    private $fieldName;
    /**
     * Create a new component instance.
     */
    public function __construct($ctrl, $displayValue, $fieldName)
    {
        $this->ctrl         = $ctrl;
        $this->displayValue = $displayValue;
        $this->fieldName    = $fieldName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = [
            'ctrl'           => $this->ctrl,
            'displayValue'   => $this->displayValue,
            'fieldName'      => $this->fieldName
        ];
        return view('components.select.option', $data);
    }
}
