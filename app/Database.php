<?php
namespace app;

use PDO;
use PDOException;

class Database {
	/** @var PDO $connection */
	private $connection;

	public function __construct() {
		$this->connect();
	}

	protected function connect() {
		try {
		$host = 'localhost';
		$dbname = 'wckficxv_tasksbeejee'; 
		$user = 'wckficxv_tasksbeejee'; 
		$password = 'tasksbeejee5'; 

			$this->connection = new PDO("mysql:host=$host;dbname=$dbname",$user,$password,
				[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8']);
			/*var_dump($this->connection->query('select * from tasks')->fetchAll());*/
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}

	public function getConnection(): PDO {
		return $this->connection;
	}

}