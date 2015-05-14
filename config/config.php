<?php
return array(
	'api_url' => "https://rest.tsheets.com/api/v1/",
	'api_token' => 'S.1__6ffb09d2d99fac0394478a22e7325d71794e034e',
	'per_page' => 20,
	'db' => array (
		'local' => array (
			'host' => "localhost",
			'port' => null,
			'user' => "root",
			'pass' => "",
			'db' => "timesheets"
			),
		'develop' => array (
			'host' => "127.0.0.1",
			'port' => '4040',
			'user' => "roman",
			'pass' => "treadmill",
			'db' => "timesheets"
			) 
		),
	'test' => true

	);