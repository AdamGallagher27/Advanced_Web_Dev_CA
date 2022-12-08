<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikeButton extends Component
{

    public $count = 0;
 
    
    public function increment()
    {
        $this->count++;
    }



    // renders component to the screen
    public function render()
    {
        return view('livewire.like-button');
    }
}
