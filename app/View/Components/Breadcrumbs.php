<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    /**
     * @var array
     */
    public $path;

    /**
     * Create a new component instance.
     *
     * @param array $path
     */
    public function __construct(array $path)
    {
        $this->path = $path;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumbs');
    }
}
