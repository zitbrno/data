<?php

use \Katu\Env;

switch (Env::getPlatform()) {

	case 'dev' :

		return array(

			'baseURL'  => 'http://zitbrnodata.local/',
			'apiURL'   => 'http://zitbrnodata.local/',
			'timezone' => 'Europe/Prague',

			'slim' => array(
				'mode'  => 'development',
				'debug' => TRUE,
			),

			'pagination' => array(
				'pageIdent' => 'stranka',
			),

		);

	break;
	case 'prod' :

		return array(

			'baseURL'  => 'http://data.zitbrno.cz/',
			'apiURL'   => 'http://data.zitbrno.cz/',
			'timezone' => 'Europe/Prague',

			'slim' => array(
				'mode'  => 'production',
				'debug' => FALSE,
			),

			'pagination' => array(
				'pageIdent' => 'stranka',
			),

		);

	break;

}
