<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Produto\Controller;

use Categoria\Model\CategoriaTable;
use Produto\Model\ProdutoTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $table;
    protected $categoria;

	public function __construct(ProdutoTable $table, CategoriaTable $categoria)
	{
		$this->table = $table;
		$this->categoria = $categoria;
	}
    public function indexAction()
    {
        $produtos = $this->table->fetchAll();
    	
        return new ViewModel();
    }

    public function addAction()
    {
    	$form = new \Produto\Form\ProdutoForm();
        $form->get('submit')->setAttribute('class', 'btn btn-success');
        $form->get('id_categoria')->setValueOptions($this->categoriasList());

         $request = $this->getRequest();
 
         if (! $request->isPost()) {
             return new ViewModel([
                 'form' => $form
             ]);
         }

        $categoria = new \Produto\Model\Produto();
 
         $form->setData($request->getPost());
 
         if (! $form->isValid()) {
             exit('not valid');
         }
 
         $categoria->exchangeArray($form->getData());
 
         $this->table->saveProduto($categoria);
 
         return $this->redirect()->toRoute('produto', [
           'controller' => 'index',
           'action' => 'add'
         ]);

    }
     public function editAction()
     {
 
         $id = (int) $this->params()->fromRoute('id',0);
 
         if ($id == 0) {
             exit('invalid id');
         }
 
         try {
             $produto = $this->table->getProduto($id);
         } catch(\Exception $e) {
             exit('Error with Produto table');
         }
         $form = new \Produto\Form\ProdutoForm();

         $form->bind($produto);
         $form->get('id_categoria')->setValueOptions($this->categoriasList());

         $request = $this->getRequest();
 
         //if not post request
         if (! $request->isPost()) {
             return new ViewModel([
                 'form' => $form,
                 'id' => $id
             ]);
         }
 
         $form->setData($request->getPost());
 
         if (! $form->isValid()) {
             exit('not valid');
         }
 
         $this->table->saveProduto($produto);
 
         return $this->redirect()->toRoute('produto', [
           'controller' => 'index',
           'action' => 'edit',
           'id' => $id
         ]);
 
     }

     public function listAction()
     {
        return new ViewModel([
            'produtos' => $this->table->fetchAll()
        ]);

     }
     public function deleteAction()
     {
 
         $id = (int) $this->params()->fromRoute('id',0);
 
         if ($id == 0) {
             exit('invalid id');
         }
 
         try {
             $produto = $this->table->getProduto($id);
         } catch(\Exception $e) {
             exit('Error with User table');
         }
 
         $request = $this->getRequest();

         //if not post request
         if (! $request->isPost()) {
             return new ViewModel([
                 'produto' => $produto,
                 'id_produto' => $id
             ]);
         }
         //if post request

         $del = $request->getPost('del','Não');

         if($del=='Sim')
         {
            $id = (int) $produto->getId();
            $this->table->deleteProduto($id);
         }
            $this->redirect()->toRoute('produto',['action' => 'list']);
     }

     private function categoriasList()
     {
        $array = $this->categoria->fetchAll();
	    $list = null;
        foreach($array as $key => $value){
            $list[$key] = array('value' => $value->getId(), 'label' => $value->getNome());
        }
        return $list;
     }

}
