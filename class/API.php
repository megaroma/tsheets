<?php
class API {
	public static $conf = array();

	private static $respond;

	public static function init($conf) {
		self::$conf = $conf;
	}


	public static function get_list($name, $action , $params ) {
		$page = 1;
		$l = true;
		$more = false;
		$pages = array();
		while($l) {
			$params['page'] = $page;
			$error = true;
			for($i=0;$i<3;$i++) {
				$status = self::request($action , $params);
				if($status == 200) {
					$more = self::$respond->more;
					$pages[] = self::$respond->results->$name;
					$error = false;
					break;
				}

			}

			if($error) {
				echo "error";
				exit;
			}
			if(!$more) $l = false;
			$page++;
		}
		return $pages;

	}

	public static function request($action , $params) {
		$params['per_page'] = self::$conf['per_page'];
		$url =  self::$conf['api_url'].$action.'?' . http_build_query($params);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.self::$conf['api_token']));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$respond = curl_exec($ch);
		self::$respond = json_decode($respond);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return $status;
	}
}