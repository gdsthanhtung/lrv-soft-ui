<?php

namespace App\View\Components\Search;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Filter extends Component
{
    private $ctrl;
    private $selected;
    private $ruleName;
    private $name;
    /**
     * Create a new component instance.
     */
    public function __construct($ctrl, $selected = '', $ruleName = 'ruleStatus', $name = 'name')
    {
        $this->ctrl     = $ctrl;
        $this->selected = $selected;
        $this->ruleName = $ruleName;
        $this->name     = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = [
            'ctrl'      => $this->ctrl,
            'selected'  => $this->selected,
            'ruleName'  => $this->ruleName,
            'name'      => $this->name
        ];
        //dump($data);
        return view('components.search.filter', $data);
    }
}
