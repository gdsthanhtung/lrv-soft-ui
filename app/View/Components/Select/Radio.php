<?php

namespace App\View\Components\Select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Radio extends Component
{
    private $listToSelect;
    private $elName;
    private $valToChecked;
    private $required;
    /**
     * Create a new component instance.
     */
    public function __construct($listToSelect = [], $elName = 'noname', $valToChecked = null, $required = false)
    {
        $this->listToSelect = $listToSelect;
        $this->elName       = $elName;
        $this->valToChecked = $valToChecked;
        $this->required     = $required;
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
            'required'      => $this->required
        ];
        //dump($data);
        return view('components.select.radio', $data);
    }
}
