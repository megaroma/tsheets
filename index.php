<?php
function __autoload($class_name) {
	$class_name =  str_replace('\\', '/', $class_name);
    include 'class/'.$class_name.'.php';
}
$profile = 'local';
$api_conf = include 'config/config.php';
DB::init($api_conf, $profile);
API::init($api_conf);

$dt = '2004-02-12T15:19:21+00:00';

TSheets::Update_Users($dt);
TSheets::Update_Timesheets($dt);
TSheets::Update_Jobcode_Assignments($dt);
TSheets::Update_Jobcodes($dt);
TSheets::Update_Geolocations($dt);

echo "OK";
?>