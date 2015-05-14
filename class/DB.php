<?php
class DB {

	public static $mysqli;

	public static function init($api_conf,$profile) {
  		$conf = $api_conf['db'][$profile];


		self::$mysqli = new mysqli($conf['host'],$conf['user'],$conf['pass'],$conf['db'],$conf['port']);

	}

	public static function select($sql,$data = array()) {
		$res = array();
		if(count($data) > 0) {
			$stmt = self::$mysqli->prepare($sql);

			$types =  str_repeat ( 's' , count($data));
			array_unshift($data,$types);
            $refs = array();
            foreach($data as $key => $value)
                $refs[$key] = &$data[$key];			
			call_user_func_array(array($stmt,'bind_param'),$refs);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
		} else {
			$result = self::$mysqli->query($sql);
		}
			if($result) {
    			while ($obj = $result->fetch_object()) {
        			$res[] = $obj;
    			}		
    			$result->close();
    		}
    	
		return $res;
	}

	public static function statement($sql,$data = array()) {
		if(count($data) > 0) {
			$stmt = self::$mysqli->prepare($sql);
			$types =  str_repeat ( 's' , count($data));
			array_unshift($data,$types);
            $refs = array();
            foreach($data as $key => $value)
                $refs[$key] = &$data[$key];			
			call_user_func_array(array($stmt,'bind_param'),$refs);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
		} else {
			$result = self::$mysqli->query($sql);
		}
		return $result;
	}

}


?>