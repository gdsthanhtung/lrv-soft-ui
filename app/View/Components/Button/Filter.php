<?php

namespace App\View\Components\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Filter extends Component
{
    private $ctrl;
    private $countByStatus;
    private $params;
    private $enum;
    /**
     * Create a new component instance.
     */
    public function __construct($ctrl, $countByStatus, $params, $enum = 'ruleStatus')
    {
        $this->ctrl             = $ctrl;
        $this->countByStatus    = $countByStatus;
        $this->params           = $params;
        $this->enum             = $enum;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = [
            'ctrl'          => $this->ctrl,
            'countByStatus' => $this->countByStatus,
            'params'        => $this->params,
            'enum'          => $this->enum
        ];
        //dump($data);
        return view('components.button.filter', $data);
    }
}
