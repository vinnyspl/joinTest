<?php
namespace Produto\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class ProdutoForm extends Form
{

    public function __construct()
    {
        parent::__construct('produto');

        $this->setAttribute('method', 'POST');

        $this->add([
            'name' => 'id_produto',
            'type' => 'hidden'
        ]);

        $this->add([
            'name' => 'nome_produto',
            'type' => 'text',
            'options' => [
                'label' => 'Nome Produto'
            ]
        ]);

        $this->add([
            'name' => 'valor_produto',
            'type' => 'text',
            'options' => [
                'label' => 'Valor'
            ]
        ]);

        $this->add([
            'name' => 'dt_cadastro',
            'type' => 'date',
            'options' => [
                'label' => 'Data de Cadastro'
            ]
        ]);

        $this->add([
            'type' => Element\Select::class,
            'name' => 'id_categoria',
            'options' => [
                'label' => 'Categoria',
                'empty_option' => 'Selecione'
            ],
        ]);


        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
               'value' => 'Save',
               'id'    => 'buttonSave',
                'class'=> 'btn btn-success'
            ]
        ]);

    }

}
