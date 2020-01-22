<?php
namespace app;

class Request {

	public function get($var) {
		return $_GET[$var] ?? null;
	}

	public function post($var) {
		return $_POST[$var] ?? null;
	}

	public function isPost(): bool {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			return true;
		}
		return false;
	}
}
