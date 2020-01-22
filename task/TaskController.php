<?php
namespace task;

use app\Controller;
use app\Session;

class TaskController extends Controller {

	public function all() {
		$session = new Session();
		$admin =  $session->get('authUserId') ? 1 : 0;
		$countItemPage = 2;

		$page = $this->request->get('page') ?? 1;
		$sort = $this->request->get('sort') ?? 1;
		var_dump($page);
		var_dump($sort);

		$tasks = Task::getTasks($sort, $page);
		$countTask = Task::getCountTask();
		/*if ($countItemPage < $countTask) {
			$page = 1;
		} */

		//var_dump($tasks);
		$this->render('tasks', compact('tasks', 'admin', 'sort', 'page'));
	}

	public function add() {
		$session = new Session();
		$admin = ($session->get('authUserId')) ?  1  : 0;

		if ($this->request->isPost()) {
			/*var_dump($this->request->post('username'));
			exit();*/
			$username = $this->request->post('username');
			$email = $this->request->post('email');
			$description = $this->request->post('description');
			$status = (int)($this->request->post('status')) ?? 0;
			if ($username && $email && $description) {
				//$admin = (new  Session())->get('authUserId');
				$task = new Task(compact('username', 'email', 'description', 'status'));
				/*var_dump($this->request);
				var_dump($task);
				exit();*/
				$task->save();

				$this->app->redirect('/');
			}
		}

		$action = $this->uri;
		$this->render('form', compact('action', 'admin'));
	}
	
	public function update() {
		$session = new Session();
		if ($session->get('authUserId')){
			$admin = 1;
		} else {
			$admin = 0;
		}
		$id = $this->request->get('id');
		$task = Task::getById($id);

		if (!$task) {
			$this->app->redirect('/');
		}
		if ($this->request->isPost()) {
			$username = $this->request->post('username');
			$email = $this->request->post('email');
			$description = $this->request->post('description');
			$status = $this->request->post('status');

			if ($username && $email && $description) {
				$task->username = $username;
				$task->email = $email;
				$task->description = $description;
				$task->status = $status;
				$task->edit = 1;
				/*var_dump($task);
				exit();*/
				$task->save();
				$this->app->redirect('/');
			}
		}
		$action = $this->uri.'?id='.$id;
		$this->render('form', compact('action', 'task', 'admin'));
	}

}