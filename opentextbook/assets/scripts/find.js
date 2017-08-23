/* jshint latedef:nofunc */
//needed for function hoisting for build 

(function($) {
    
    class DiscoveryController {
      constructor() {
      
      }  
    }
    
    class DiscoveryView {
      contructor() {
        
      }
    }
        
    class HTMLUIController extends DiscoveryController {
      constructor(controllerID) {
        super();
        this.id = $(controllerID);
        
      }
    }
    
    class HTMLView extends DiscoveryView {
      constructor(viewID) {
        super();
        this.id = $(viewID);
        
      }
    }
    
    class PaginatedHTMLView extends DiscoveryView {
      constructor() {
        super();
        
      }
    }
    
    /* !DATA HANDLER */
    
    class DiscoveryDataHandler {
      constructor(dbURI, dbmethod) {
        this.dburl = dbmethod + '://' + dbURI;
        this.paths = this.build_paths();
        this.query = {};
        this.XHROpts = this.resetXHROpts();
        this.results = {};
                
      }
      
      resetQueryParameters() {
        this.query = {};
      }
  
      // Placeholder. Will be particualar to database implementation. 
      
      setQueryParameter(parameter,value,operator='like') {
        this.query[Parameter] = value;
        return this;  
      }
      
      // Placeholder. Will be particular to database implementation
      
      setSearchTerm(term,operator='contains') {
        return this;
      }
      
      // Placeholder. Will be particualar to database implementation. 
      
      setLimit(limit,offset) {
        return this;
      }      
      
      // A wrapper for the query Parameter
      
      getQuery() {
        return this.query;
      }
      
      // Sets default options for the AJAX call.
      
      resetXHROpts() {
        this.XHROpts = {
          async: false,
          method: "GET", // default
          traditional: true,
          crossOrigin: true,
          error: this.xhrError,
          success: this.xhrResultsHandler
        };
      }
      
      // Set AJAX option as per http://api.jquery.com/jquery.ajax/
      
      setXHROpt(opt,value) {
        this.XHROpts[opt] = value;
        return this;
      }
      
      // Wrapper that returns AJAX options
      
      getXHROpts() {
        return this.XHROpts;
      }
      
      // Performs filtered query
      
      performQuery() {
        this.resetXHROpts();
        this
          .setXHROpt('url',this.makeURL(this.paths.query.filtered_items.path))
          .setXHROpt('method',this.paths.query.filtered_items.method)
          .setXHROpt('data',this.query);  
        this.retrieve(); 
        return this;     
      }
      
      getResults() {
        console.log('get results');
        console.log(this.results);
        return this.results;
      }
      
      makeURL(path) {
        return this.dburl + "/" + path;
      }
      
      /* ! -- AJAX call */
      
      /*
        A number of things are going on here. The data results need to be scoped to the object instance so the success
        a function expression was needed. The $.extend method allows us to do this and retain our this.XHROpts property.
        The success parameter is passed an array, which calls a second method for post-processing.
      */ 
                
        
      retrieve() {
        var self = this;
        $.ajax($.extend(this.XHROpts,{success: [function(data) { self.results = data; },self.xhrResultsHandler]}));
      }
      
      xhrError(xhr, ajaxOptions, thrownError) {
        console.log('error');
        console.log(xhr);
        console.log(thrownError);
      }
      
      // called after a successful ajax request 
      
      xhrResultsHandler(data,textStatus,jqXHR) {
      
      }
      
      // see DSpace Handler for an extended implementation
      
      build_paths() {
        return {
          items: {
            list: {                              // Returns a list of items
              method: "GET",
              path:     "[path]", 
              },                              
            item: {                               // Returns a single item with ID %%
              method: "GET",
              path:     "[path]/%%"
              },                           
            item_metadata: {                      // Returns metadata for item %%
              method: "GET",
              path:     "[path]/%%/[key]",  
              },       
            find_by_metadata: {                   // Returns items based on specified metadata value
              method: "POST",
              path:     "[path]"
            }     
          },
          query: {  
            filtered_items: {                     // Returns items based on chosen filters
              method: "GET",
              path:     "[path]",  
              },           
            filtered_collections: {               // Returns collections based on chosen filters
              method: "GET",
              path:     "[path]",
              }, 
            collection: {                         // Returns collection with ID %%
              method: "GET",
              path:     "[path]/%%",
              }         
          }
        };
      }
    }
    
    /* !DSPACE HANDLER */
    
    class DSpaceDataHandler extends DiscoveryDataHandler {
      constructor(dbURI, dbmethod) {
        super(dbURI, dbmethod);
        this.query = [];
        this.expansion = []; // expands the dataset
        this.filters = [];  // adds filters
        this.fields = []; // fields to show
      }
      
      resetQueryParameters() {
        this.query = [];
      }
  
      /* Available operators:
        
        exists
        doesnt_exist
        equals
        not_equals
        like
        not_like
        contains
        doesnt_contain
        matches
        doesnt_match
      */

      
      setQueryParameter(parameter,value,operator='like') {
        
        this.query.push({
          name:   "query_field[]",
          value:  parameter
        });
        
        this.query.push({
          name:   "query_op[]",
          value:  operator
        });
        
        this.query.push({
          name:   "query_val[]",
          value:  value
        });
        
        return this;  
      }
      
      // A search term is general across all metadata
      
      setSearchTerm(value,operator='contains') {
        this.setQueryParameter('*',value,operator);
        return this;
      }
      
      setAdditionalParameter(parameter,value) {
        this.query.push({
          name: parameter,
          value: value
          });
        return this;
      }
      
      // Rudimentary. Will be particualar to database implementation. 
      
      setLimit(limit=100,offset=0) {
        this
          .setAdditionalParameter('limit',limit)
          .setAdditionalParameter('offset',offset);
        return this;
      }
      
      setCollection(collectionID) {
        this.setAdditionalParameter('collSel[]',collectionID);
        return this;
      }
      
      /*  Expands the returned dataset. 
        
          Some values:
            metadata
            bitstreams
            parentCollection
            parentCollectionList
            parentCommunityList
      */
            
      expandQuery(expansion) {
        this.expansion.push(expansion);
        this.setAdditionalParameter('expand',this.expansion.join(','));
        return this;
      }
      
      // Filters the dataset. Exanmples include 'is_withdrawn' or 'is_discoverable'
      
      filterQuery(filter) {
        this.filters.push(filter);
        this.setAdditionalParameter('expand',this.filters.join(','));
        return this;
      }
      
      // A shortcut to include metadata in results
      
      includeMetaData() {
        this.expandQuery('metadata');
        return this;
      }
      
      // A shortcut to include bitstreams in results
      
      includeBitstreams() {
        this.expandQuery('bitstreams');
        return this;
      }
            
      // Builds DSpace-specific paths
      // TO DO: Build this into a common schema for all storage devices
      
      build_paths() {
        return {
          items: {
            list: {                              // Returns a list of items
              method: "GET",
              path:     "items", 
              },                              
            item: {                               // Returns a single item with ID %%
              method: "GET",
              path:     "items/%%"
              },                           
            item_metadata: {                      // Returns metadata for item %%
              method: "GET",
              path:     "items/%%/metadata",  
              },       
            item_bitstreams: {                    // Returns available bitstreams for item %%
              method: "GET",
              path:     "items/%%/bitstreams"  
              },
            find_by_metadata: {                   // Returns items based on specified metadata value
              method: "POST",
              path:     "items/find-by-metadata-field"
            }     
          },
          query: {  
            filtered_items: {                     // Returns items based on chosen filters
              method: "GET",
              path:     "filtered-items",  
              },           
            filtered_collections: {               // Returns collections based on chosen filters
              method: "GET",
              path:     "filtered-collections",
              }, 
            collection: {                         // Returns collection with ID %%
              method: "GET",
              path:     "filtered-collections/%%",
              }         
          },
          bitstreams: { 
            list: {                                // Returns all bitstreams in DSpace
              method: "GET",
              path:     "bitsreams"
            },
            item: {                               // Returns an item with bitstream ID %%
              method: "GET",
              path:     "bitstreams/{%%}"
            },
            item_policy: {                        // Returns the policy for a bitstream with ID %%
              method: "GET",
              path:     "bitstreams/%%/policy"
            },
            content: {                             // Retrieve content for a bitstream with ID %%
              method:  "GET",
              path:      "bitstreams/%%/retrieve"
            }
          },
          schemas: {
            list: {                        // Returns a list of all schemas
              method: "GET",
              path:     "registries/schema"
            },
            item: {                             // Returns a metadata schema with schema prefix %%
              method: "GET",
              path:     "registries/schema/%%"
            },
            field: {                              // Returns a metadata schema with field ID %%
              method: "GET",
              path:     "registries/metadata-fields/%%"
            }
          }
        };
      }
      
    }
    
    class Discovery {
      constructor() {
        // this.controller = new DiscoveryController();
        // this.view = new DiscoveryView();
        // this.DataHandler = new DiscoveryDataHandler();
      }
    }
    
    /* !ECO DISCOVERY CLASS */
    /*
      vars expects:
      
      {
        controllerID: '#discovery-interface',
        viewID:       '#results',
        dbURI:        'books.spi.ryerson.ca/rest',
        dbmethod:   'https'
      }
      
    */
    
    class ECommonsOntarioDiscovery extends Discovery {
      constructor(vars) {
        super();
        this.controller = new HTMLUIController(vars.controllerID);
        this.view = new PaginatedHTMLView(vars.viewID);
        this.data = new DSpaceDataHandler(vars.dbURI, vars.dbmethod);
        
      }
    }
    
    
    /* !DOCUMENT READY */
    
    $(document).ready(function() {
            
      var discovery = new ECommonsOntarioDiscovery
        ({
          controllerID: '#discovery-interface',
          viewID:       '#results',
          dbURI:        'books.spi.ryerson.ca/rest',
          dbmethod:     'https'
        });
      
      var results = discovery.data.setSearchTerm('Electrical').includeMetaData().performQuery().getResults();
      
    });
  
    
})(jQuery);



