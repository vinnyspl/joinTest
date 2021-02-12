<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Categoria\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $table;
	public function __construct($table)
	{
		$this->table = $table;
	}
    public function indexAction()
    {
        $categorias = $this->table->fetchAll();
    	
        return new ViewModel();
    }

    public function addAction()
    {
    	$form = new \Categoria\Form\CategoriaForm();
        $form->get('submit')->setAttribute('class', 'btn btn-success');

         $request = $this->getRequest();
 
         if (! $request->isPost()) {
             return new ViewModel([
                 'form' => $form
             ]);
         }

        $categoria = new \Categoria\Model\Categoria();
 
         $form->setData($request->getPost());
 
         if (! $form->isValid()) {
             exit('not valid');
         }
 
         $categoria->exchangeArray($form->getData());
 
         $this->table->saveCategoria($categoria);
 
         return $this->redirect()->toRoute('categoria', [
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
             $categoria = $this->table->getCategoria($id);
         } catch(\Exception $e) {
             exit('Error with Categoria table');
         }
         $form = new \Categoria\Form\CategoriaForm();

         $form->bind($categoria);
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
 
         $this->table->saveCategoria($categoria);
 
         return $this->redirect()->toRoute('categoria', [
           'controller' => 'index',
           'action' => 'edit',
           'id' => $id
         ]);
 
     }

     public function listAction()
     {
        return new ViewModel([
            'categorias' => $this->table->fetchAll()
        ]);

     }
     public function deleteAction()
     {
 
         $id = (int) $this->params()->fromRoute('id',0);
 
         if ($id == 0) {
             exit('invalid id');
         }
 
         try {
             $categoria = $this->table->getCategoria($id);
         } catch(\Exception $e) {
             exit('Error with User table');
         }
 
         $request = $this->getRequest();

         //if not post request
         if (! $request->isPost()) {
             return new ViewModel([
                 'categoria' => $categoria,
                 'id_categoria' => $id
             ]);
         }
         //if post request

         $del = $request->getPost('del','Não');

         if($del=='Sim')
         {
            $id = (int) $categoria->getId();
            $this->table->deleteCategoria($id);
         }
            $this->redirect()->toRoute('categoria',['action' => 'list']);
     }
}
