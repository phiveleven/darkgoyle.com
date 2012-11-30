<? if ( preg_match('/\/js\/(?<id>.+)\.js$/', $_SERVER['REQUEST_URI'], $matches)) {
	
	if (!$auth) { header(' ', true, 204); exit; }
	
	$id = $matches[1];
	$host = $_SERVER['HTTP_HOST'];
	
	setcookie('511', round(microtime(true)*1e3), 0, '/', '.darkgoyle.com', false, true);
	header('Content-Type: text/javascript; charset=utf-8');
	
	global $auth_key;
	echo <<<PHPSCRIPT
/* (c) 2012 Francisco M Brito -- darkgoyle.com */
this['$host']= (function(){
	return {
		get: function(id){
			console.info('api.get', arguments);
		  var _get = $.Deferred(function(dfd){
		    $.getJSON(id)
					.done(function(response){ dfd.resolve(response.data) })
		      .fail(console.error);
			});
			return _get;
    },
		set: function(id, data){
		  console.info('api.put', arguments);
		  return $.post(id, data);
    }
  };	
})();
	window.api = window['$host'];
PHPSCRIPT;
?>
	

	
<? exit; }	