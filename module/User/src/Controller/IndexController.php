<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Controller;

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
    	$users=$this->table->fetchAll();
    	
        return new ViewModel();
    }

    public function addAction()
    {
    	$form = new \User\Form\UserForm();
        $form->get('submit')->setAttribute('class', 'btn btn-success');

         $request = $this->getRequest();
 
         if (! $request->isPost()) {
             return new ViewModel([
                 'form' => $form
             ]);
         }
 
         $user = new \User\Model\User();
 
         $form->setData($request->getPost());
 
         if (! $form->isValid()) {
             exit('not valid');
         }
 
         $user->exchangeArray($form->getData());
 
         $this->table->saveUser($user);
 
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
             $user = $this->table->getUser($id);
         } catch(\Exception $e) {
             exit('Error with User table');
         }
 
         $form = new \User\Form\UserForm();
 
         $form->bind($user);
 
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
 
         $this->table->saveUser($user);
 
         return $this->redirect()->toRoute('produto', [
           'controller' => 'index',
           'action' => 'edit',
           'id' => $id
         ]);
 
     }

     public function listAction()
     {
        return new ViewModel([
            'users' => $this->table->fetchAll()
        ]);

     }
     public function deleteAction()
     {
 
         $id = (int) $this->params()->fromRoute('id',0);
 
         if ($id == 0) {
             exit('invalid id');
         }
 
         try {
             $user = $this->table->getUser($id);
         } catch(\Exception $e) {
             exit('Error with User table');
         }
 
         $request = $this->getRequest();
 
         //if not post request
         if (! $request->isPost()) {
             return new ViewModel([
                 'produto' => $user,
                 'id' => $id
             ]);
         }
         //if post request

         $del = $request->getPost('del','No');
         if($del=='Yes')
         {
            $id = (int) $user->getId();
            $this->table->deleteUser($id);
         }
            $this->redirect()->toRoute('produto',['action' => 'list']);
     }
}
