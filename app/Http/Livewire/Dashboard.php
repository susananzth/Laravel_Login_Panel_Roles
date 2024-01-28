<?php

namespace App\Http\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('Dashboard')]
    public function render()
    {
        return view('dashboard');
    }
}