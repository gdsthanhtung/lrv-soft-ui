<?php

namespace App\View\Components\Search;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Area extends Component
{
    private $ctrl;
    private $params;
    private $searchSelection;

    /**
     * Create a new component instance.
     */
    public function __construct($ctrl, $params, $searchSelection = 'searchSelection')
    {
        $this->ctrl             = $ctrl;
        $this->params           = $params;
        $this->searchSelection  = $searchSelection;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = [
            'ctrl'              => $this->ctrl,
            'params'            => $this->params,
            'searchSelection'   => $this->searchSelection
        ];
        //dump($data);
        return view('components.search.area', $data);
    }
}
