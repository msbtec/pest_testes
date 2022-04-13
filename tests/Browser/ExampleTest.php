<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

//Plugin Dusk simulando interação com o browser
//composer require laravel/dusk
//php artisan dusk:install
//phpunit.xml adicionar
//<testsuite name="Browser">
//     <directory suffix="Test.php">./tests/Browser</directory>
//</testsuite>

uses(DuskTestCase::class);

it('testando uma pagina', function (){
    $this->browse(function (Browser $browser) {
            $browser->visit('/')
            ->assertSee('Documentation');
    });  

});


//Plugin Livewire para testes de componentes
//composer require livewire/livewire
//php artisan dusk:install
//resource->views->welcome.blade
//adicionar diretório layouts e adicionar um arquivo app
//adicionar no <head> @livewireStyles e no <body> @livewireScripts
//composer require pestphp/pest-plugin-livewire --dev
//php artisan optimize:clear
//php artisan make:livewire counter
