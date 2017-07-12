<?php

namespace App\Controller;

use App\Controller\AppController;

class ProductsController extends AppController
{
    public $paginate = [
        'limit' => 3,
        'order' => [
            'Products.id' => 'asc',
        ],
    ];

    public function initialize()
    {
    	parent::initialize();
        $this->viewBuilder()->setLayout('product');
        $this->loadModel('Categories');
        $this->set('categories', $this->Categories->getSelect());
        $this->loadComponent('Flash');
        $this->loadComponent('Paginator');
    }

    public function index()
    {
        $this->set('products', $this->paginate($this->Products->list()));
    }

    public function create()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->newEntity($this->request->data);
            if ($this->Products->save($product)) {
                $this->Flash->success('Adding product successfully!');
                return $this->redirect(['controller' => 'products', 'action' => 'index']);
            }
        }
        $this->set('product', $product);
    }

    public function edit()
    {
        $id      = $this->request->params['id'];
        $product = $this->Products->get($id);
        $this->set('product', $product);
        $this->set('id', $id);

        if ($this->request->is('post')) {
            $product->name  = $this->request->data['name'];
            $product->image = $this->request->data['image'];
            if ($this->Products->save($product)) {
                $this->Flash->success('Updating product successfully!');
                return $this->redirect(['controller' => 'products', 'action' => 'index']);
            }
        }

        $this->render('create');
    }

    public function delete()
    {
        $id      = $this->request->params['id'];
        $product = $this->Products->get($id);
        $this->Products->delete($product);
        $this->Flash->success('Deleting product successfully!');
        return $this->redirect(['controller' => 'products', 'action' => 'index']);
    }

    public function upload()
    {
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
        if ($this->request->is('ajax')) {
            $fileName   = $this->request->data['image']['name'];
            $uploadPath = 'webroot/uploads/';
            $uploadFile = $uploadPath . $fileName;
            if (move_uploaded_file($this->request->data['image']['tmp_name'], $uploadFile)) {
                echo json_encode([
                    'error' => false,
                    'path'  => 'uploads/' . $fileName,
                ]);
                return;
            }
            echo json_encode([
                'error' => true,
            ]);
            return;
        }
    }

    public function isAuthorized($user = null)
    {
        if($user){
        	return true;
        }
        return parent::isAuthorized($user);
    }

    public function callSP(){
        $this->autoRender = false;
        $this->Products->callSp('sp_get_products(1)');
    }
}
