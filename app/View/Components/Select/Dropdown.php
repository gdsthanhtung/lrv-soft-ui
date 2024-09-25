<?php

namespace App\View\Components\Select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dropdown extends Component
{
    private $ctrl;
    private $id;
    private $displayValue;
    private $fieldName;
    /**
     * Create a new component instance.
     */
    public function __construct($ctrl, $id, $displayValue, $fieldName)
    {
        $this->ctrl         = $ctrl;
        $this->id           = $id;
        $this->displayValue = $displayValue;
        $this->fieldName    = $fieldName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = [
            'ctrl'          => $this->ctrl,
            'id'            => $this->id,
            'displayValue'  => $this->displayValue,
            'fieldName'     => $this->fieldName
        ];
        //dump($data);
        return view('components.select.dropdown', $data);
    }
}
