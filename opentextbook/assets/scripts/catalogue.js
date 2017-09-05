/* jshint latedef:nofunc */
//needed for function hoisting for build 

(function($) {
        
    $(document).ready(function() {
                  
      var discovery = new ECommonsOntarioDiscovery
        ({
          dbURI:        'ecampusoer.semiprodint.ryerson.ca',
          dbPath:       '/rest',
          dbmethod:     'http'
        });
      
      discovery.init();
      
    });
  
})(jQuery);
