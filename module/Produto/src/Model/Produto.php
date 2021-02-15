<?php

namespace Produto\Model;

class Produto
{

    protected $dt_cadastro;
    protected $valor_produto;
    protected $nome_produto;
    protected $id_produto;
    protected $id_categoria;
    protected $nome_categoria;

    public function exchangeArray(array $data)
    {

        $this->dt_cadastro = $data['dt_cadastro'];
        $this->valor_produto = $data['valor_produto'];
        $this->nome_produto = $data['nome_produto'];
        $this->id_categoria = $data['id_categoria'];
        $this->id_produto = $data['id_produto'];
        $this->nome_categoria = $data['nome_categoria'];

    }
    public function getArrayCopy()
    {
        return [
            'dt_cadastro' => $this->dt_cadastro,
            'valor_produto' => $this->valor_produto,
            'nome_produto' => $this->nome_produto,
            'id_categoria' => $this->id_categoria,
            'id_produto' => $this->id_produto,
            'nome_categoria' => $this->nome_categoria
        ];  

    }
    public function getId()
    {
        return $this->id_produto;
    }
    public function getIdCategoria()
    {
        return $this->id_categoria;
    }
    public function getNome()
    {
       return $this->nome_produto;
    }

    public function getValor()
    {
        return $this->valor_produto;
    }

    public function getDtCadastro()
    {
        return $this->dt_cadastro;
    }

    public function getNomeCategoria()
    {
       return $this->nome_categoria;
    }
    
}

