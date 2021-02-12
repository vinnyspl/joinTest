<?php
namespace Categoria\Form;

//use Zend\Form\Form;
use Zend\Form\Form;

class CategoriaForm extends Form
{

    public function __construct()
    {
        parent::__construct('categoria');

        $this->setAttribute('method', 'POST');

        $this->add([
            'name' => 'id_categoria',
            'type' => 'hidden'
        ]);

        $this->add([
            'name' => 'nome_categoria',
            'type' => 'text',
            'options' => [
                'label' => 'Nome Categoria'
            ]
        ]);

        $this->add([
            'name' => 'descricao_categoria',
            'type' => 'text',
            'options' => [
                'label' => 'Descrição'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
               'value' => 'Save',
               'id'    => 'buttonSave',
                'class'=> 'btn btn-success mr-05'
            ]
        ]);

    }

}
