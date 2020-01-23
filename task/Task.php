<?php
namespace task;
use app\App;
use PDO;
use PDOException;

class Task {

	public $id;
	public $username;
	public $email;
	public $description;
	public $status;
	public $edit;

	public function __construct($fields = []) {
		foreach ((array)$fields as $field => $value) {
			if (property_exists($this,$field)) {
				$this->$field = $value;
			}
		}
	}

	public function getCountTask() {
		$db = App::getInstance()->db->getConnection();
		$query = $db->query("select count(id) as countAllTask from tasks ");
		$count = $query->fetch();
		return $count;
	}

	public static function getTasks($order, $page) {
		switch ($order){
			case 1:
				$order = 'username asc';
				break;
			case 2:
				$order = 'username desc';
				break;
			case 3:
				$order = 'email asc';
				break;
			case 4:
				$order = 'email desc';
				break;
			case 5:
				$order = 'status asc';
				break;
			case 6:
				$order = 'status desc';
				break;
			default :
				$order = 'username asc';
		};

		//pagination
		if ($page == 1) {
			$limit = ' limit 0,2';
		} elseif ($page == 2) {
			$limit = ' limit 2,4';
		} else {
			$limit = '';
		}

		$db = App::getInstance()->db->getConnection();
		$query = $db->query("select * from tasks order by $order $limit");
		$tasks = $query->fetchAll(\PDO::FETCH_CLASS, self::class);

		return $tasks;
	}

	public static function getById($id) {
		$db = App::getInstance()->db->getConnection();
		$query= $db->query("select * from tasks where id=$id");
		$query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Task::class);
		$task = $query->fetch();

		return $task ? new Task($task): null;
	}

	public function save() {
		$db = App::getInstance()->db->getConnection();
		if ($this->id) {
			try {
				$query = $db->prepare("update tasks set email = :email, description = :description, "
					."username = :username, status = :status, edit = :edit  where tasks.id= :id");
				$query->execute((array) $this);
			} catch (PDOException $ex) {
				echo $ex->getMessage();
			}
		} else {
			$task = (array) $this;
			$keys = array_keys($task);
			$fields = implode(',',$keys);
			$values = implode(',',array_fill(0, count($keys), '?'));
			try {
				$query = $db->prepare("insert into tasks ({$fields}) values ({$values}) ");
				var_dump($query);
				$query->execute(array_values($task));
			} catch (PDOException $ex) {
				echo $ex->getMessage();
			}
		}
	}


}