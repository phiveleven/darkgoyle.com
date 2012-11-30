// js-handler
(function(){
  var api,
      assert = console.assert;
  assert(api = window[location.host], 'no api');
  assert(api.get, 'no api.get');
  assert(api.set, 'no api.set');
  
  var n = +new Date,
      url = '/test_db/'+ n;
  
  api.set(url, { test:n })
    .fail(console.dir);
  
  api.get(url)
    .done(function(data){
      assert(data, 'no data received: '+url);
      assert(data.test == n, 'could not get|set ' +url);
    })
    .fail(console.dir);
  
})();
