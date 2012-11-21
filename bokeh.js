/**
 *  Bokeh effect
 *  via shaderlab.com
 */
;(function(scripts){
  var c = 6,
      elements = document.getElementsByTagName(scripts[scripts.length-1].innerHTML);

  for( var i = 0; i < elements.length; i++ ) {
      var e = elements[ i ],
          s = document.createElement('span');
      s.className = "a";
      while(e.firstChild)
          s.appendChild(e.removeChild(e.firstChild));
      e.appendChild(s);
      for(var n=0; n<c; n++) {
          var s2 = s.cloneNode(true);
          s2.className = "b b" + n;
          e.appendChild(s2);
      }
  }

  var bokehStyle = document.createElement('link');
  bokehStyle.rel = 'stylesheet';
  bokehStyle.href = 'bokeh.css';
  document.documentElement.children[0].appendChild(bokehStyle);

})(document.getElementsByTagName('script'));
