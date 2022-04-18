<?php

use App\Models\User;
use PhpParser\Node\Expr\New_;


it('quero um resultado false', function () {
    ///
    $this->assertFalse(false);
});

it('quero outro resultado true', function () {
    ///
    $this->assertTrue(true);
});

it('testando array com assertCount', function () {
    ///
    $array = [1, 2, 3, 4];
    $this->assertCount(4, $array);
});

it('testando array com assertEquals', function () {
    ///
    $array = [1, 2, 3, 4];
    $this->assertEquals([1, 2, 3, 4], $array);
});

it('testando se o array está vazio', function () {
    ///
    $array = [];
    $this->assertEmpty($array);
});


it('testando se uma palavra está dentro de uma string', function () {
    /// Pega uma qtd de letras que estão dentro de uma palavra, é case sensitive
    $string = 'Testando uma string';

    $this->assertStringContainsString('Tes', $string);
});

// Expect são expectativas do pest que tem um conjunto de funções e pode ser encadeadas

it('testando expectativas', function () {

    expect(value: true)->toBe(expected: true);
    expect(value: false)->toBe(false);
});

it('testando expectativas continuacao', function () {

    $id = 1;
    $name = 'Nome teste';

    expect($id)->toBe(expected: 1)->and($name)->toBe(expected: 'Nome teste');
});

it('testando expectativas com conversão', function () {

    $name = 1;

    $name = (string)$name;

    expect($name)->toBeString();
});

it('testando expectativas com array', function () {

    $numbers = [1, 2, 3];

    expect($numbers)->each->toBeInt();
    expect($numbers)->each->not->toBeString();
});

it('testando expectativas com array tamanho individual', function () {

    $numbers = [1, 2, 3];

    expect($numbers)->each(fn ($number) => $number->toBeLessThan(10));
});

it('testando sequencia de expectativas usando function', function () {

    $numbers = [1, 2, 3, 4];

    expect($numbers)->sequence(
        fn ($number) => $number->toBe(1)->toBeInt()->toBeLessThan(5),
        fn ($number) => $number->toBe(2),
        fn ($number) => $number->toBe(3),
        fn ($number) => $number->toBe(4)->toBeGreaterThan(1)
    );
});

it('testando referencia exata do objeto', function () {

    $user = new User();
    //$user2 = new User();
    $user2 = $user;

    expect($user)->toBe($user2);
});

it('testando objetos vazios', function () {

    $variavelvazia = '';
    $arrayvazio = [];
    $collectionvazia = collect([]);

    expect($variavelvazia)->toBeEmpty();
    expect($arrayvazio)->toBeEmpty();
    expect($collectionvazia)->toBeEmpty();
});

it('testando outras formas de objetos true', function () {

    $publicacao = true;

    expect($publicacao)->toBeTrue();
});

it('testando igualdade de inteiros', function () {

    $number = 18;

    expect($number)->toBeGreaterThan(expected: 15);
});

it('testando igualdade com contadores em um array', function () {

    $count = count([1, 2]);

    expect($count)->toBeGreaterThanOrEqual(expected: 2);
});


it('testando elemento do conteudo', function () {

    $conteudo = 'Testando conteudo dentro de uma string';

    expect($conteudo)->toContain('conteudo dentro de');
});

it('testando numero de elementos de value', function () {

    $count = 4;
    $value = ['Teste1', 'Teste2', 'Teste3', 'Teste4'];

    expect($value)->toHaveCount($count);
});

it('testando subconjunto de um array', function () {
    $user = [
        'id' => 1,
        'name' => 'Teste',
        'email' => 'teste@mail.com',

    ];

    $value = [
        'name' => 'Teste',
        'email' => 'teste@mail.com'
    ];

    expect($user)->toMatchArray($value);
});

it('testando objeto com array', function () {
    $user = new stdClass();
    $user->id = 1;
    $user->email = 'teste@mail.com';
    $user->name = 'Teste';

    $value = [
        'name' => 'Teste',
        'email' => 'teste@mail.com'
    ];

    expect($user)->toMatchObject($value);
});

it('testando igualdade com Equal', function () {
    $nome = 'teste';

    expect($nome)->toEqual(expected: 'teste');
});


it('testando se duas variaveis tem o mesmo valor', function () {
    $array = [4, 3, 2, 1];
    $value = [1, 2, 3, 4];

    expect($array)->not->toEqual($value);
    expect($array)->toEqualCanonicalizing($value);
});

it('testando o valor absoluto e colocando margem segundo o delta', function () {
    // (mod)$num - (mod)$num2 <= $delta

    $num = 11;
    $num2 = 13;
    $delta = 2;

    expect($num2)->toEqualWithDelta($num, $delta);
    // Acho que isso aqui não tem muito uso
});


it('testando se variável tem valor infinito', function () {

    $num = INF;
    $num2 = 1;

    expect($num)->toBeInfinite();
    expect($num2)->not->toBeInfinite();
    // Acho que isso aqui não tem muito uso

});

it('testando propriedade de uma instancia', function () {

    $user = new User();

    expect($user)->toBeInstanceOf(class: \App\Models\User::class);
});

it('testando se objeto é um array', function () {

    $users = ['Teste1', 'Teste2', 'Teste3', 'Teste4'];

    expect($users)->toBeArray();
});

it('testando recursos', function () {

    $file = fopen(filename: 'text.txt', mode: 'w');
    $open = opendir(directory: 'C:');

    expect($file)->toBeResource()->and($open)->toBeResource();
});

it('testando retorno de json', function () {

    $resultado = '{"sucess": true}';

    expect($resultado)->toBeJson();
});


it('testando chaves de retorno de um array', function () {

    $resultado = [
        'sucess' => true,
        'message' => 'Testando'

    ];
    expect($resultado)->toHaveKey('sucess');
    expect($resultado)->toHaveKeys(['sucess', 'message']);
});

//Criando expect customizado

expect()->extend('toBeWithinRange', function ($min, $max) {
    return $this->toBeGreaterThanOrEqual($min)
        ->toBeLessThanOrEqual($max);
});

it('testando alcance de um valor', function () {

    $num1 = 50;

    expect($num1)->toBeWithinRange(20, 150);
});


it('testando redirecionamento', function () {

    $user = User::factory()->create();

    actingAs($user)->get(uri: '/')->assertSee(value: 'Documentation');
});


it('testando excessoes', function () {

    throw new Exception(message: 'Erro!!!');
})->throws(Exception::class, exceptionMessage: 'Erro!!!');


it('testando pulo de caso de teste', function () {
    //Teste
})->skip('Teste ainda nao implementado');


//only faz executar apenas o teste que ele foi utilizado
//->only();

it('testando dataset', function ($emails) {
    expect($emails)->not->toBeEmpty();
})->with(data: 'emails');

//Mostrar cobertura de testes 
//pest --coverage 
