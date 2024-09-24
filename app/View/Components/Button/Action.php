<?php

namespace App\View\Components\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Action extends Component
{
    private $ctrl;
    private $id;
    /**
     * Create a new component instance.
     */
    public function __construct($ctrl, $id)
    {
        $this->ctrl         = $ctrl;
        $this->id           = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = [
            'ctrl'          => $this->ctrl,
            'id'            => $this->id
        ];
        //dump($data);
        return view('components.button.action', $data);
    }
}
