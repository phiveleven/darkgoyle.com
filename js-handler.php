<?
if ( preg_match('/\/js\/(?<id>.+)\.js$/', $_SERVER['REQUEST_URI'], $matches)) {
	header('Content-Type: text/javascript; charset=utf-8');
	echo <<<PHPSCRIPT
/* (c) 2012 Francisco M Brito -- darkgoyle.com */

console.debug(_=[parseInt('$matches[1]',36),_]);	
PHPSCRIPT;
?>
	

	
<? exit; }	