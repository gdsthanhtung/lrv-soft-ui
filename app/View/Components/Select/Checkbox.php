<?php

namespace App\View\Components\Select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{
    private $listToSelect;
    private $elName;
    private $valToChecked;
    private $required;
    private $col;
    /**
     * Create a new component instance.
     */
    public function __construct($listToSelect = [], $elName = 'noname', $valToChecked = [], $required = false, $col = 'col-3')
    {
        $this->listToSelect = $listToSelect;
        $this->elName       = $elName;
        $this->valToChecked = $valToChecked;
        $this->required     = $required;
        $this->col          = $col;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = [
            'listToSelect'  => $this->listToSelect,
            'elName'        => $this->elName,
            'valToChecked'  => $this->valToChecked,
            'required'      => $this->required,
            'col'           => $this->col
        ];
        //dump($data);
        return view('components.select.checkbox', $data);
    }
}
