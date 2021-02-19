<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Honeypot extends Component
{
    public function render()
    {
        return view('components.honeypot', [
            'nameField' => config('honeypot.name_field'),
            'timeField' => config('honeypot.time_field'),
        ]);
    }
}
