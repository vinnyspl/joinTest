<?php

namespace Produto\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGatewayInterface;

class ProdutoTable
{

    protected $tableGateway;
    protected $select;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
        $this->select = new Select();
    }

    public function getCategoria($field = '', $value = '') {
        $resultSet = $this->tableGateway->select(function(Select $select) {
            $select->join('', '', array('nome_categoria'));
        });

        return $resultSet;
    }

    public function fetchAll()
    {
        $sqlSelect = $this->tableGateway->getSql()->select();
        $sqlSelect->join('categoria', 'produto.id_categoria = categoria.id_categoria', array('nome_categoria'), 'inner');
        $resultSet= $this->tableGateway->selectWith($sqlSelect);
        return $resultSet;
    }
    
    public function saveProduto(Produto $produto){
    	$data = [
            'dt_cadastro' => $produto->getDtCadastro(),
            'valor_produto' => $produto->getValor(),
            'nome_produto' => $produto->getNome(),
            'id_categoria' => $produto->getIdCategoria()
    	];
        if($produto->getId()){
            $this->tableGateway->update($data,[
                'id_produto' => $produto->getId()
            ]);
        }
        else{
            $this->tableGateway->insert($data);    
        }
    	
    }

    public function getProduto(int $id_produto){
        $current=$this->tableGateway->select([
            'id_produto' => $id_produto
        ]);
        return $current->current();
    }
    public function deleteProduto(int $id_produto){
        $this->tableGateway->delete([
            'id_produto' => $id_produto
        ]);
    }
}
