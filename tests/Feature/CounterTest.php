<?php

use App\Http\Livewire\Counter;

use function Pest\Livewire\livewire;


it('testando incremento com liveriwe', function() {
    livewire(Counter::class)
        ->call('increment')
        ->assertSee(1);
});

//Escrevendo com refatoração o livewire é uma function
it('testando decremento com liveriwe')
        ->livewire(Counter::class)
        ->call('decrement')
        ->assertSee(-1);

    
//composer require pestphp/pest-plugin-mock --dev
    