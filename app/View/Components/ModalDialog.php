<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalDialog extends Component
{
    public string $variable;
    public string $btnClass;
    public bool $startVisible;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $variable = "open", string $btnClass = "", string $startVisible = "false")
    {
        $this->variable = $variable;
        $this->btnClass = $btnClass;
        $this->startVisible = $startVisible == "true" ? true : false;
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
