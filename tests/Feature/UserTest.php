<?php

use function Pest\Laravel\{get,getJSON};
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(fn () => User::factory(3)->create());

it('testando uso do banco de dados')->assertDatabaseHas('users', [
    'id' => 3,
]);

it('testando user na pagina', function () {
    get('/')->assertStatus(200); 
});

it('testando user COM Json na pagina', function () {
    getJson('api/users')->assertStatus(200); 
});

