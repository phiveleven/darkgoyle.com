/* tests */
[ 'xhr-handler',
  'js-handler' ].map(function(name){
    return $.getScript('test-'+name+'.js');
  });
