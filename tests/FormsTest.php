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
            ->parent()

        ->create('input')
            ->id('username')
            ->classlist->add('form-control')->parent()
            ->attrlist->add('type', 'text')->parent()
            ->parent()

        ->create('label')
            ->classlist->add('color-green')->parent()
            ->attrlist->add('for', 'password')->parent()
            ->create('text')->textContent('Senha')->parent()
            ->parent()

        ->create('input')
            ->id('password')
            ->classlist->add('form-control')->parent()
            ->attrlist->add('type', 'password')->parent()
            ->parent();
        

        print_r($forms); exit;
    }
}
