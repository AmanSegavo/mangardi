<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class IconNavLink extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $active = false,
        public string $icon = '' // Tambahkan properti ini
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.icon-nav-link');
    }
}
