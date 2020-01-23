<?php
namespace task;

use app\Controller;
use app\Session;

class TaskController extends Controller {

	public function all() {
		$session = new Session();
		$isAdmin =  $session->get('authUserId') ? 1 : 0;
		$message =  $session->get('messageAuth') ?? $session->get('message');;
		$session->clear('message');

		$countItemPage = 2;

		$page = $this->request->get('page') ?? 1;
		$sort = $this->request->get('sort') ?? 1;

		$tasks = Task::getTasks($sort, $page);
		$countTask = (int)Task::getCountTask()['countAllTask'];
		if ($countItemPage >= $countTask) {
			$pageVisible = 'style="display:none"';
		}

		$this->render('tasks', compact('tasks', 'isAdmin', 'sort', 'page', 'pageVisible', 'messageAuth', 'message', 'statusText'));
	}

	public function add() {
		$session = new Session();
		$isAdmin =  $session->get('authUserId') ? 1 : 0;

		if ($this->request->isPost()) {
			$username = $this->request->post('username');
			$email = $this->request->post('email');
			$description = $this->request->post('description');
			$status = (int)($this->request->post('status')) ?? 0;
			if ($username && $email && $description) {
				$task = new Task(compact('username', 'email', 'description', 'status'));
				$task->save();
				$session->set('message', 'Задача успешно сохранена');
				$this->app->redirect('/');
			}
		}

		$pageTitle = 'Добавление задачи';
		$action = $this->uri;
		$this->render('form', compact('action', 'isAdmin', 'pageTitle'));
	}
	
	public function update() {
		$session = new Session();
		$isAdmin =  $session->get('authUserId') ? 1 : 0;

		$id = $this->request->get('id');
		$task = Task::getById($id);
		$oldDescripton = $task->description;

		if (!$task) {
			$this->app->redirect('/');
		}
		if ($this->request->isPost()) {
			$username = $this->request->post('username');
			$email = $this->request->post('email');
			$description = $this->request->post('description');
			$status = (int)$this->request->post('status');

			if ($description) {
				$task->username = $username;
				$task->email = $email;
				$task->description = $description;
				$task->status = $status;
				$task->edit = ($description !== $oldDescripton) ? 1 : $task->edit;
				if ($isAdmin) {
					$task->save();
					$this->app->redirect('/');
				} else {
					$this->app->redirect('/user/sign-form');
				}
			}
		}
		$pageTitle =  'Редактирование задачи';
		$action = $this->uri.'?id='.$id;
		$this->render('form', compact('action', 'task', 'isAdmin', 'pageTitle'));
	}

}