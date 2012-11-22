/* tests */
(function(){
// xhr-handler
  var API_PATH ='/api/';
  $.getJSON(API_PATH)
  .done(function(response){ 
    console.assert(response.status == '200 OK', 'status <> 200 OK');
    console.assert(response.path == API_PATH, 'path <> '+API_PATH);
  })
  .fail(function(jqXHR){ console.error(jqXHR.responseText) });
  
  var db = '/test_db';
// GET
 var test_get = db + '/0';
 $.getJSON(test_get)
 .done(function(response){
   console.assert(response.data, 'unreachable: '+test_get);
 })
 .fail(console.error);
 
 var n = +new Date % 10 + 1;
// PUT
  var test_put = '/'+n;
  $.ajax({
    type: 'PUT',
    url: db + test_put,
    data: { n: n }
  })
  .always(console.log);
  
// POST
  var data = {};
  data[+new Date] = _;
  $.post(test_put, data)
  .always(console.log);
  
// DELETE
  $.ajax({
    type: 'DELETE',
    url: db + test_put
  })
  .always(console.log);
  
})();
