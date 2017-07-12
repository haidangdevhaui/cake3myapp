<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('auth');
        $this->set('errors', []);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            echo '<pre>';
            print_r($this->request->getData());
            echo '</pre>';
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function register()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->newEntity($this->request->getData());
            if (!$user->errors()) {
                $this->Users->save($user);
                $this->Flash->success('Register successfully!');
                $this->redirect('/auth/login');
            } else {
                $this->set('errors', $user->errors());
            }
        }
        $this->set('user', $user);
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    function list() {
        $this->set('users', $this->Users->find('all'));
    }

    public function profile()
    {
        $this->set('user', $this->Auth->user());

        if ($this->request->is('post')) {
            $user           = $this->Users->get($this->Auth->user('id'));
            $user->username = $this->request->getData('username');
            $user->role     = $this->request->getData('role');
            $user->password = (new DefaultPasswordHasher)->hash($this->request->getData('password'));
            if ($this->Users->save($user)) {

                $this->Flash->success('Updating profile successfully!');
                return $this->redirect(['controller' => 'Users', 'action' => 'profile']);
            }
        }
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['register', 'login', 'logout']);
    }
}
