/* tests */
(function(){
// xhr-handler
  var path ='/api/';
  $.getJSON(path)
  .done(function(response){ 
    console.assert(response.status == '200 OK');
    console.assert(response.query = path);
    console.dir(response);
  })
  .fail(function(response){ console.error(response.status) });
  
})();

