<?
	$auth = 0;
	if (!empty($_COOKIE['511']))
		$auth = $_COOKIE['511'];
	
	// crypto key
	$last_access = intval($auth);
	$auth_key = base_convert($last_access, 16, 36);
	