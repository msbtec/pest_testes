<?php

use App\Services\UserRepository;

it('testando servico com Mock', function () {
    $mock = mock(UserRepository::class)->expect(
        create: fn ($name) => true,
        save: fn ($name) => true,

    );

    expect($mock->create('Teste'))->toBeTrue();
    expect($mock->save('Teste'))->toBeTrue();
});

it('testando servico com Mock mesmo nome falha', function () {
    $mock = mock(UserRepository::class)->expect(
        create: fn ($name) => true,
        save: function($name){
            if($name !== 'Teste'){
                return false;
            }
                return true;
        },

    );

    expect($mock->create('Teste'))->toBeTrue();
    expect($mock->save('Teste'))->toBeTrue();
});