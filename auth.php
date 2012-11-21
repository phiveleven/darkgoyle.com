<?
	global $auth;
	$auth = 0;
	if (!empty($_COOKIE['511'])) { $auth = $_COOKIE['511']; }
	