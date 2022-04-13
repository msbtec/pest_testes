<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $number = 0;

    public function increment()
    {
        $this->number++;
    }

    public function decrement()
    {
        $this->number--;
    }

  //  public function mount()
  //  {
   //     $this->increment();
 //   }

    public function render()
    {
        return view('livewire.counter');
    }
}
