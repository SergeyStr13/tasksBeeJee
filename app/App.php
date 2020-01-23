<?php
namespace app;

use task\TaskController;
use user\UserController;

class App {

	/** @var Request $request */
	public $request;

	/** @var Database $db */
	public $db;

	/** @var string $uri */
	public $uri;

	/** @var Router $router */
	private $router;

	/** @var string $path */
	private $path;

	/** @var static $instance */
	private static $instance;

	public function __construct() {
		$this->path = dirname(__DIR__);
		spl_autoload_register([$this,'autoload']);

		$this->request = new Request();
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$this->uri = preg_replace('#^[^/]#', '/$0', $uri);

		$this->db = new Database();
		$this->router = new Router([
			'/' => [TaskController::class, 'all'],

			'/task/tasks' => [TaskController::class, 'all'],
			'/task/add' => [TaskController::class, 'add'],
			'/task/update' => [TaskController::class, 'update'],
			'/task/save' => [TaskController::class, 'save'],

			'/user/sign-form' => [UserController::class, 'signForm'],
			'/user/sign-in' => [UserController::class, 'signIn'],
			'/user/sign-out' => [UserController::class, 'signOut'],
		]);

		if (self::$instance === null) {
			self::$instance = $this;
		}
	}

	public static function getInstance(): self {
		return self::$instance;
	}

	public function run() {

		if (!$this->router->dispatch($this->uri)) {
			echo '404 Page not found';
		}
	}

	public function redirect($uri) {
		header("location: $uri");
		exit();
	}

	private function autoload($className) {
		$file = $this->path.'/'.str_replace('\\','/',$className).'.php';
		if (is_file($file)) {
			require_once $file;
		}
	}

}
