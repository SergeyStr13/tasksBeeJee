<?php
namespace user;

use app\Session;

class UserController  extends \app\Controller {

	public function signForm() {
		$session = new Session();
		$message =  $session->get('error');
		$session->clear('error');
		$this->render('signForm', compact('message'));
	}

	public function signIn() {
		$login = $this->request->post('login');
		$password = $this->request->post('password');
		$session = new Session();
		if ($login == 'admin' && $password == '123') {
			$session->set('authUserId', '1');
			$session->set ('message','Успешная авторизация');
			$this->app->redirect('/');
		}
		if ($login !== 'admin' || $password !== '123') {
			$session->set('error','Не верный логин или пароль');
		}
		$this->app->redirect('/user/sign-form');
	}

	public function signOut() {
		$session = new Session();
		$session->clear('authUserId');
		$session->clear('messageAuth');
		$this->app->redirect('/');
	}

}