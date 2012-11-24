// xhr-handler
  var API_PATH ='/api/';
  $.getJSON(API_PATH)
  .done(function(response){ 
    console.assert(response.status == '200 OK', 'status <> 200 OK');
    console.assert(response.path == API_PATH, 'path <> '+API_PATH);
  })
  .fail(function(jqXHR){ console.error(jqXHR.responseText) });
  
  var db = '/test_db',
      loc = +new Date % 10 + 1;
  
// GET
 var test_get = db + '/0';
 $.getJSON(test_get)
 .done(function(response){
   console.assert(response.success, 'could not GET '+test_get);
   console.assert(response.data, 'no data: '+test_get);
 })
 .fail(console.error);
 
 

 // POST: create, update, delete
 var data = { n: +new Date };
 $.post(db + '/' + loc, data)
  .done(function(response){
    console.assert(response.success, 'failed: POST ' + loc)
    $.getJSON(db + '/' + loc)
    .done(function(response){ 
      console.assert(response.data.n == data.n, 'could not write '+ loc);
    })
    .fail(console.error);
  })
  .fail(console.error);
 