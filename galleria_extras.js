function galleria_load_set(key, setid) {
   jQuery(window).scrollTop(0);
   var flickr = new Galleria.Flickr(key);
   flickr.getSet(setid, function(data) {
        jQuery('#galleria').galleria({
            data_source: data,
            transition: 'fade',
            autoplay: true
        });
    });
}

function galleria_populate_sets(container, key, user) {
   var anchor = (document.location.hash != '' ? document.location.hash.substring(1) : null);
   jQuery.getJSON('http://api.flickr.com/services/rest/?method=flickr.collections.getTree&api_key='+key+'&format=json&jsoncallback=?&user_id='+user, function(data) {
      var sets = [];
      for ( var i=0; i<data.collections.collection.length; i++ ) {
         var collection = data.collections.collection[i];
         container.append(jQuery('<h2>'+collection.title+'</h2>'));
         ul = jQuery('<ul />');
         for ( var j=0; j<collection.set.length; j++ ) {
            var set = collection.set[j];
            sets.push(set.id);
            ul.append(jQuery('<li'+(anchor && anchor == set.id ? ' class="selected"' : '')+'><a href="#'+set.id+'" onclick="jQuery(this).parent().parent().parent().find(\'li\').removeClass(\'selected\'); jQuery(this).parent().addClass(\'selected\'); galleria_load_set(\''+key+'\', \''+set.id+'\');">'+set.title+'</a></li>'));
         }
         container.append(ul);
      }
      
      jQuery.getJSON('http://api.flickr.com/services/rest/?method=flickr.photosets.getList&api_key='+key+'&format=json&jsoncallback=?&user_id='+user, function(data) {
         var others = [];
         for ( var i=0; i<data.photosets.photoset.length; i++ ) {
            var set = data.photosets.photoset[i];
            var found = false;
            for ( var j=0; j<sets.length; j++ ) {
               if ( sets[j] == set.id ) {
                  found = true; break;
               }
            }
            if ( !found ) {
               others.push(set);
            }
         }
         
         if ( others.length > 0 ) {
            container.append(jQuery('<h2>Others</h2>'));
            ul = jQuery('<ul />');
            for ( var j=0; j<others.length; j++ ) {
               var set = others[j];
               ul.append(jQuery('<li'+(anchor && anchor == set.id ? ' class="selected"' : '')+'><a href="#'+set.id+'" onclick="jQuery(this).parent().parent().parent().find(\'li\').removeClass(\'selected\'); jQuery(this).parent().addClass(\'selected\'); galleria_load_set(\''+key+'\', \''+set.id+'\');">'+set.title._content+'</a></li>'));
            }
            container.append(ul);
         }
      });
   });
}

