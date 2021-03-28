<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalDialog extends Component
{
    public string $variable;
    public string $btnClass;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $variable = "open", string $btnClass = "")
    {
        $this->variable = $variable;
        $this->btnClass = $btnClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-dialog');
    }
}
