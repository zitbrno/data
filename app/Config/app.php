<?php

use \Katu\Env;

switch (Env::getPlatform()) {

	case 'dev' :

		return array(

			'baseURL'  => 'http://noob.local/',
			'apiURL'   => 'http://noob.local/',
			'timezone' => 'UTC',

			'slim' => array(
				'mode'  => 'development',
				'debug' => TRUE,
			),

			'pagination' => array(
				'pageIdent' => 'page',
			),

		);

	break;
	case 'prod' :

		return array(

			'baseURL'  => 'http://www.example.com/',
			'apiURL'   => 'http://www.example.com/',
			'timezone' => 'UTC',

			'slim' => array(
				'mode'  => 'production',
				'debug' => FALSE,
			),

			'pagination' => array(
				'pageIdent' => 'page',
			),

		);

	break;

}