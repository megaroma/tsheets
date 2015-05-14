<?php

class TSheets {


//---------------------------------------
public static function Update_Users($modified_since) {

	$params = array('modified_since' => $modified_since);
	$pages = API::get_list("users","users",$params );
	if(count($pages) == 0) return false;
	foreach($pages as $page) {
		foreach($page as $user) {
			
			$hire_date = date("Y-m-d",strtotime($user->hire_date));
			$term_date = date("Y-m-d",strtotime($user->term_date));
			$last_active = date("Y-m-d H:i:s",strtotime($user->last_active)); 
			$approved_to = date("Y-m-d",strtotime($user->approved_to)); 
			$submitted_to = date("Y-m-d",strtotime($user->submitted_to)); 
			$last_modified = date("Y-m-d H:i:s",strtotime($user->last_modified)); 
			$created = date("Y-m-d H:i:s",strtotime($user->created)); 

			$permitions = array();
			foreach($user->permissions as $permition => $status) {
				if($status == 1) $permitions[] = $permition;
			}

			$sql = "REPLACE INTO `users` (
			 `id`, 
			 `username`,
			 `email`,
			 `first_name`,
  			`last_name`,
  			`group_id`,
  			`manager_of_group_ids`,
  			`employee_number`,
  			`salaried`,
  			`exempt`,
  			`payroll_id`,
  			`client_url`,
  			`mobile_number`,
  			`hire_date`,
  			`term_date`,
  			`last_active`,
  			`active`,
  			`require_password_change`,
  			`approved_to`,
  			`submitted_to`,
  			`last_modified`,
  			`created`,
  			`permissions`) VALUES ( 
  			'".$user->id."',
  			'".$user->username."',
  			'".$user->email."',
  			'".$user->first_name."',
  			'".$user->last_name."',
  			'".$user->group_id."',
  			'".implode(',',$user->manager_of_group_ids)."',
  			'".$user->employee_number."',
  			'".$user->salaried."',
  			'".$user->exempt."',
  			'".$user->payroll_id."',
  			'".$user->client_url."',
  			'".$user->mobile_number."',
  			STR_TO_DATE('".$hire_date."','%Y-%m-%d'),
  			STR_TO_DATE('".$term_date."','%Y-%m-%d'),
  			STR_TO_DATE('".$last_active."','%Y-%m-%d %H:%i:%s'),
  			'".$user->active."',
  			'".$user->require_password_change."',
  			STR_TO_DATE('".$approved_to."','%Y-%m-%d'),
  			STR_TO_DATE('".$submitted_to."','%Y-%m-%d'),
  			STR_TO_DATE('".$last_modified."','%Y-%m-%d %H:%i:%s'),
  			STR_TO_DATE('".$created."','%Y-%m-%d %H:%i:%s'),
  			'".implode(',',$permitions)."'
  			)";

			DB::statement($sql);

		}


	}
	return true;
}


//--------------------------------------------------
public static function Update_Timesheets($modified_since) {
	$params = array('modified_since' => $modified_since);
	$pages = API::get_list("timesheets","timesheets",$params );
	if(count($pages) == 0) return false;
	foreach($pages as $page) {
		foreach($page as $timesheet) {
			if(is_array($timesheet->customfields)) {
				$customfields = json_encode($timesheet->customfields);
			} else {
				$customfields = $timesheet->customfields;
			}
			$last_modified = date("Y-m-d H:i:s",strtotime($timesheet->last_modified)); 
			$start = date("Y-m-d H:i:s",strtotime($timesheet->start)); 
			$end = date("Y-m-d H:i:s",strtotime($timesheet->end)); 
			$date =  date("Y-m-d H:i:s",strtotime($timesheet->date)); 
			$sql = "REPLACE INTO `timesheets` (
					`id`,
  					`user_id`,
  					`jobcode_id`,
  					`locked`,
  					`notes`,
  					`customfields`,
  					`created`,
  					`last_modified`,
  					`type`,
  					`on_the_clock`,
  					`start`,
  					`end`,
  					`date`,
  					`duration`) VALUES ( 
  					'".$timesheet->id."',
  					'".$timesheet->user_id."',
  					'".$timesheet->jobcode_id."',
  					'".$timesheet->locked."',
  					'".$timesheet->notes."',
  					'".$customfields."',
  					NULL ,
  					STR_TO_DATE('".$last_modified."','%Y-%m-%d %H:%i:%s'),
  					'".$timesheet->type."',
  					'".$timesheet->on_the_clock."',
 					STR_TO_DATE('".$start."','%Y-%m-%d %H:%i:%s'),
  					STR_TO_DATE('".$end."','%Y-%m-%d %H:%i:%s'),
  					STR_TO_DATE('".$date."','%Y-%m-%d'),
  					'".$timesheet->duration."'
			)"; 
  			DB::statement($sql);
		}
	}
	return true;			
}



//--------------------------------------------------
public static function Update_Jobcode_Assignments($modified_since) {
	$params = array('modified_since' => $modified_since);
	$pages = API::get_list("jobcode_assignments","jobcode_assignments",$params );
	if(count($pages) == 0) return false;
	foreach($pages as $page) {
		foreach($page as $jobcode_ass) {
			$last_modified = date("Y-m-d H:i:s",strtotime($jobcode_ass->last_modified)); 
			$created = date("Y-m-d H:i:s",strtotime($jobcode_ass->created)); 
			$sql = "REPLACE INTO `jobcode_assignments` (
  				`id`,
  				`user_id`,
  				`job_code_id`,
  				`active`,
  				`last_modified`,
  				`created`
				) VALUES ( 
				'".$jobcode_ass->id."',
				'".$jobcode_ass->user_id."',
				'".$jobcode_ass->jobcode_id."',
				'".$jobcode_ass->active."',
				STR_TO_DATE('".$last_modified."','%Y-%m-%d %H:%i:%s'),
				STR_TO_DATE('".$created."','%Y-%m-%d %H:%i:%s')
				)";
  			DB::statement($sql);
		}
	}
	return true;			
}

//--------------------------------------------------
public static function Update_Jobcodes($modified_since) {
	$params = array('modified_since' => $modified_since);
	$pages = API::get_list("jobcodes","jobcodes",$params );
	if(count($pages) == 0) return false;
	foreach($pages as $page) {
		foreach($page as $jobcode) {
			$last_modified = date("Y-m-d H:i:s",strtotime($jobcode->last_modified)); 
			$created = date("Y-m-d H:i:s",strtotime($jobcode->created)); 			
			$sql = "REPLACE INTO `jobcodes` (
				 		`id`,
  						`parent_id`,
  						`name`,
  						`short_code`,
  						`type`,
  						`billable`,
  						`billable_rate`,
  						`has_children`,
  						`assigned_to_all`,
  						`active`,
  						`last_modified`,
  						`created` 
					) VALUES (
					'".$jobcode->id."',
					'".$jobcode->parent_id."',
					'".$jobcode->name."',
					'".$jobcode->short_code."',
					'".$jobcode->type."',
					'".$jobcode->billable."',
					'".$jobcode->billable_rate."',
					'".$jobcode->has_children."',
					'".$jobcode->assigned_to_all."',
					'".$jobcode->active."',
					STR_TO_DATE('".$last_modified."','%Y-%m-%d %H:%i:%s'),
					STR_TO_DATE('".$created."','%Y-%m-%d %H:%i:%s')
				)";

  			DB::statement($sql);
		}
	}
	return true;			
}

//--------------------------------------------------
public static function Update_Geolocations_byUsers($modified_since,$user_ids) {
	$params = array('modified_since' => $modified_since,
						'user_ids' => $user_ids);
	$pages = API::get_list("geolocations","geolocations",$params );
	if(count($pages) == 0) return false;
	foreach($pages as $page) {
		foreach($page as $geolocation) {
			$created = date("Y-m-d H:i:s",strtotime($geolocation->created)); 
			$sql = "REPLACE INTO `geolocations` (
  					`id`,
 					`user_id`,
  					`accuracty`,
  					`altitude`,
  					`latitude`,
  					`longitude`,
  					`speed`,
  					`heading`,
  					`source`,
  					`device_identifier`,
  					`created`
				) VALUES (
					'".$geolocation->id."',
					'".$geolocation->user_id."',
					'".$geolocation->accuracy."',
					'".$geolocation->altitude."',
					'".$geolocation->latitude."',
					'".$geolocation->longitude."',
					'".$geolocation->speed."',
					'".$geolocation->heading."',
					'".$geolocation->source."',
					'".$geolocation->device_identifier."',
					STR_TO_DATE('".$created."','%Y-%m-%d %H:%i:%s')
			)";


  			DB::statement($sql);
		}
	}
	return true;			
}


//--------------------------------------------------
public static function Update_Geolocations($modified_since) {
	$sql = "select `id` from `users`";
	$res = DB::select($sql);
	$ids = array();
	$i = 1;
	if(count($res) > 0) {
		$text = "";
		foreach ($res as $user) {
			$text .= $user->id.",";
			$i++;
			if($i > 10) {
				$i = 1;
				$ids[] = trim($text,',');
				$text = "";
			}
		}
		if($text != "") {
			$ids[] = trim($text,',');
		}

		foreach ($ids as $id) {
			self::Update_Geolocations_byUsers($modified_since,$id);
		}
	} else {
		return false;
	}

	return true;
}



//end class
}

//date("Y-m-d H:i:s",strtotime($next_call_scheduled)); 
//AND STR_TO_DATE(CONCAT('.$end_date.',\' 23:59:59\'),\'%m/%d/%Y %H:%i:%s\') )