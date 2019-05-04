<?php

use Cajudev\Forms;
use PHPUnit\Framework\TestCase;

class FormsTest extends TestCase
{
    public function test_form_creation()
    {
        $forms = Forms::create();
        $forms->id('formulario-vendas')
            ->classlist->add('col-12', 'mt-4', 'bg-green')->parent()
            ->attrlist->add('action', './finalizar-venda.php')->parent()

        ->create('label')
            ->classlist->add('color-green')->parent()
            ->attrlist->add('for', 'username')->parent()
            ->create('text')->textContent('Nome de Usuário')->parent()
            ->create('input')
                ->id('username')
                ->classlist->add('form-control')->parent()
                ->attrlist->add('type', 'text')->parent()
                ->parent()
            ->parent()

        ->create('label')
            ->classlist->add('color-green')->parent()
            ->attrlist->add('for', 'password')->parent()
            ->create('text')->textContent('Senha')->parent()
            ->create('input')
                ->id('password')
                ->classlist->add('form-control')->parent()
                ->attrlist->add('type', 'password')->parent()
                ->parent()
            ->parent()

        ->create('select')
            ->id('car-list')
            ->classlist->add('color1', 'mb-5')->parent()
            ->create('option')
                ->attrlist->add('value', '1')->parent()
                ->parent()
            ->create('option')
                ->attrlist->add('value', '2')->parent()
                ->parent()
            ->create('option')
                ->attrlist->add('value', '3')->parent()
                ->parent()
            ->parent();

        self::assertEquals('<form id="formulario-vendas" class="col-12 mt-4 bg-green" action="./finalizar-venda.php"><label class="color-green" for="username">Nome de Usuário<input class="form-control" type="text"/></label><label class="color-green" for="password">Senha<input class="form-control" type="password"/></label><select id="car-list" class="color1 mb-5" ><option  value="1"></option><option  value="2"></option><option  value="3"></option></select></form>', $forms->render());
    }
}
