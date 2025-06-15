<?php

namespace SettingsEditor\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{

    public $only = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($only=null)
    {
        $this->only = $only;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('settings-editor::components.alert');
    }
}
