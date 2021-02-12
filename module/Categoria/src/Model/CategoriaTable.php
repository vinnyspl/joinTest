<?php

namespace Categoria\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGatewayInterface;

class CategoriaTable
{

    protected $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getList()
    {
        $list = $this->tableGateway->select(function(Select $select) {
            $select->columns(['id_categoria', 'nome_categoria']);

        });
        return $list->current();
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
    
    public function saveCategoria(Categoria $categoria){
    	$data = [
    		'nome_categoria' => $categoria->getNome(),
    		'descricao_categoria' => $categoria->getDescricao()
    	];
        if($categoria->getId()){
            $this->tableGateway->update($data,[
                'id_categoria' => $categoria->getId()
            ]);
        }
        else{
            $this->tableGateway->insert($data);    
        }
    	
    }

    public function getCategoria(int $id_categoria){
        $current=$this->tableGateway->select([
            'id_categoria' => $id_categoria
        ]);
        return $current->current();
    }
    public function deleteCategoria(int $id_categoria){
        $this->tableGateway->delete([
            'id_categoria' => $id_categoria
        ]);
    }
}
