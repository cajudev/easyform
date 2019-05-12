<?php

use Cajudev\Forms;
use PHPUnit\Framework\TestCase;

class FormsTest extends TestCase
{
    public function test_form_creation()
    {
        $forms = Forms::create();

        $forms->classlist->add('col-12', 'mt-4', 'bg-green')->parent()
              ->attrlist->add('id', 'formulario-vendas')
                  ->add('action', './finalizar-venda.php')
                  ->parent()

        ->create('label')
            ->classlist->add('color-green')->parent()
            ->attrlist->add('for', 'username')->parent()
            ->create('text')->textContent('Nome de Usuário')->parent()
            ->create('input')
                ->classlist->add('form-control')->parent()
                ->attrlist->add('id', 'username')
                    ->add('type', 'text')
                    ->parent()
                ->parent()
            ->parent()

        ->create('label')
            ->classlist->add('color-green')->parent()
            ->attrlist->add('for', 'password')->parent()
            ->create('text')->textContent('Senha')->parent()
            ->create('input')
                ->classlist->add('form-control')->parent()
                ->attrlist->add('id', 'password')
                    ->add('type', 'password')
                    ->parent()
                    ->parent()
            ->parent()

        ->create('select')
            ->attrlist->add('id', 'car-list')->parent()
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

        self::assertEquals('<form class="col-12 mt-4 bg-green" id="formulario-vendas" action="./finalizar-venda.php"><label class="color-green" for="username">Nome de Usuário<input class="form-control" id="username" type="text"/></label><label class="color-green" for="password">Senha<input class="form-control" id="password" type="password"/></label><select class="color1 mb-5" id="car-list"><option value="1"></option><option value="2"></option><option value="3"></option></select></form>', $forms->render());
    }

    public function test_easy_form_input()
    {
        $easyForm = Forms::create('easyform');

        $easyForm->setStyle('fieldset', 'col-6');
        $easyForm->setStyle('label', 'color-purple');
        $easyForm->setStyle('input', 'form-control');
        $easyForm->setStyle('small', 'color-light-purple');

        $easyForm->input([
            'id' => 'username',
            'type' => 'text',
            'label' => 'Nome de Usuário',
            'small' => 'Email ou Apelido'
        ]);

        $easyForm->input([
            'id' => 'pass',
            'type' => 'password',
            'label' => 'Senha',
            'small' => 'Sua senha de 8 caracteres'
        ]);

        self::assertEquals('<form><fieldset class="col-6"><label class="color-purple" for="username">Nome de Usuário</label><input class="form-control" id="username" type="text"/><small class="color-light-purple">Email ou Apelido</small></fieldset><fieldset class="col-6"><label class="color-purple" for="pass">Senha</label><input class="form-control" id="pass" type="password"/><small class="color-light-purple">Sua senha de 8 caracteres</small></fieldset></form>', $easyForm->render());
    }
}
