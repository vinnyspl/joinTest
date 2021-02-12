<?php

namespace Categoria\Model;

class Categoria
{

    protected $descricao_categoria;
    protected $nome_categoria;
    protected $id_categoria;

    public function exchangeArray(array $data)
    {

        $this->descricao_categoria = $data['descricao_categoria'];
        $this->nome_categoria = $data['nome_categoria'];
        $this->id_categoria = $data['id_categoria'];

    }
    public function getArrayCopy()
    {
        return [
            'descricao_categoria' => $this->descricao_categoria,
            'nome_categoria' => $this->nome_categoria,
            'id_categoria' => $this->id_categoria
        ];  

    }
     public function getId()
    {
       return $this->id_categoria;
    }
    public function getNome()
    {
       return $this->nome_categoria;
    }

    public function getDescricao()
    {
       return $this->descricao_categoria;
    }
    
}
