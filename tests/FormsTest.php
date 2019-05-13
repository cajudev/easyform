<?php

use Cajudev\EasyForm;
use Cajudev\Elements\Form;
use PHPUnit\Framework\TestCase;

class FormTest extends TestCase
{
  public function test_form_manual_creation()
  {
    $form = new Form();

    $form->classlist->add('col-12', 'mt-4', 'bg-green')->parent()
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

    self::assertEquals('<form class="col-12 mt-4 bg-green" id="formulario-vendas" action="./finalizar-venda.php"><label class="color-green" for="username">Nome de Usuário<input class="form-control" id="username" type="text"/></label><label class="color-green" for="password">Senha<input class="form-control" id="password" type="password"/></label><select class="color1 mb-5" id="car-list"><option value="1"></option><option value="2"></option><option value="3"></option></select></form>', $form->render());
  }

  public function test_easyForm_create_from_template()
  {
    $easyForm = new EasyForm();

    $easyForm->createTemplate('customInput', [
      'fieldset' => [
        'attributes' => ['class' => 'form-group'],
        'children' => [
          'label' => [
            'attributes' => ['class' => 'color-blue', 'for' => '::id'],
            'text' => '::label',
          ], 
          'input' => [
            'attributes' => ['class' => 'form-control', 'id' => '::id', 'type' => '::type'],
          ], 
          'small' => [
            'attributes' => ['class' => 'color-light-blue float-right font-italic'],
            'text' => '::small'
          ]
        ],
      ],
    ]);

    $easyForm->create('customInput', [
      '::id'   => 'username',
      '::type' => 'text',
      '::label' => 'Nome de Usuário',
      '::small' => 'Informe o nome de usuário ou email',
    ]);
    $easyForm->create('customInput', [
      '::id'   => 'password',
      '::type' => 'password',
      '::label' => 'Senha',
      '::small' => 'Informe sua senha de 8 caracteres',
    ]);
    $easyForm->create('customInput', [
      '::id'   => 'email',
      '::type' => 'text',
      '::label' => 'Email',
      '::small' => 'Informe o seu melhor email',
    ]);

    self::assertEquals('<form><fieldset class="form-group"><label class="color-blue" for="username">Nome de Usuário</label><input class="form-control" id="username" type="text"/><small class="color-light-blue float-right font-italic">Informe o nome de usuário ou email</small></fieldset><fieldset class="form-group"><label class="color-blue" for="password">Senha</label><input class="form-control" id="password" type="password"/><small class="color-light-blue float-right font-italic">Informe sua senha de 8 caracteres</small></fieldset><fieldset class="form-group"><label class="color-blue" for="email">Email</label><input class="form-control" id="email" type="text"/><small class="color-light-blue float-right font-italic">Informe o seu melhor email</small></fieldset></form>', $easyForm->render());
  }
}
