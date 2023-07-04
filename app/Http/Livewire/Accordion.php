<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Accordion extends Component
{
    public $items;

    public $openItem = null;

    public function mount($items)
    {
        $this->items = $items;
    }

    public function toggleItem($index)
    {
        if ($this->openItem === $index) {
            $this->openItem = null;
        } else {
            $this->openItem = $index;
        }
    }

    public function render()
    {
        return view('components.accordion');
    }
}
