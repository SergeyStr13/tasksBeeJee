<?php
namespace app;

class Session {

	/** @var string $id */
	protected $id;

	/**
	 * @param string|null $id
	 */
	public function __construct($id = null) {
		if ($id === null) {
			if (session_status() === PHP_SESSION_NONE) {
				session_start();
			}
			$id = session_id();
		}
		$this->id = $id;
	}

	protected static function saveCurrentSession(): void {
		if (session_status() !== PHP_SESSION_NONE) {
			session_write_close();
		}
	}

	protected function setup(): void {
		if (session_id() !== $this->id) {
			self::saveCurrentSession();
			session_id($this->id);
			session_start();
		}
	}


	/**
	 * @param string $property
	 * @return mixed
	 */
	public function get(string $property) {
		$this->setup();
		return $_SESSION[$property] ?? null;
	}

	/**
	 * @param string $property
	 * @param mixed $value
	 */
	public function set(string $property, $value): void {
		$this->setup();
		$_SESSION[$property] = $value;
	}

	/**
	 * @param string $property
	 */
	public function clear(string $property): void {
		$this->setup();
		unset($_SESSION[$property]);
	}

}