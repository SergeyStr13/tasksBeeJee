<?php
namespace user;

use app\Session;

class UserController  extends \app\Controller {

	public function signForm() {
		$this->render('signForm');}


	public function signIn() {
		$login = $this->request->post('login');
		$password = $this->request->post('password');
		if ($login == 'admin' && $password == '123') {
			$session = new Session();
			$session->set('authUserId', '1');
			$this->app->redirect('/');
		}
		if ($login == 'admin') {
			$message = 'Login not found';
			var_dump($this->uri);
			$this->app->redirect('/signForm');
		}
		if ($password == '123') {
			$message = 'error pass';
			$this->app->redirect('/signForm');
		}

	}

	public function signOut() {
		$session = new Session();
		$session->clear('authUserId');
		$this->app->redirect('/');
	}

}