<?
if ( preg_match('/\/js\/(?<id>[a-z0-9]+)/', $_SERVER['REQUEST_URI'], $matches)) {
	header('Content-Type: text/javascript; charset=utf-8');
	echo '/* (c) 2012 Francisco M Brito -- darkgoyle.com */';
// 	$request_time = $matches[1];
	exit;
}	