/* jshint latedef:nofunc */
//needed for function hoisting for build 

(function($) {
      
    $(document).ready(function() {
                  
      var catalogueItem = new ECommonsOntarioCatalogueItem(new ECommonsOntarioDiscovery
        ({
          dbURI:        'dsweb.semiprodint.ryerson.ca',
          dbPath:       '/rest',
          dbmethod:     'http'
        }));
    });
  
})(jQuery);
