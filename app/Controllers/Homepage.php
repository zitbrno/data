<?php

namespace App\Controllers;

class Homepage extends \Katu\Controller {

	static function index() {
		self::render("Homepage/index");
	}

}
