/* jshint latedef:nofunc */
//needed for function hoisting for build 

(function($) {
  
    /* DISCOVERY CONTROLLER CLASS */
    
    // Core Controller Class
    
    class DiscoveryController {
      constructor(discoveryObj) {
        this.discoveryObj = discoveryObj;
        this.controller = null;
      }  
            
      submit() {
        
      }
      
    }
    
    // Manages UIs that submit filter criteria.
    
    class CriteriaSelectionController extends DiscoveryController {
      constructor(discoveryObj) {
        super(discoveryObj);
        this.facets = null;
        this.queue = [];
      }
      
      enqueue() {
        
      }
    }
    
    // Manages Pagination UIs.
    
    class PaginationController extends DiscoveryController {
      constructor(discoveryObj) {
        super(discoveryObj);
        this.nextPage = null;
        this.previousPage = null;
        this.pageMarkers = null;
      }
    }
    
    // Manages HTML5-Based Pagination UIs
    
    class HTMLPaginationController extends PaginationController {
      constructor(discoveryObj) {
        super(discoveryObj);
      }
    }
    
    // Manages standalone Search Box UIs
    
    class HTMLSearchBox extends CriteriaSelectionController {
      constructor(discoveryObj) {
        super(discoveryObj);
      }
    }
        
    /* !HTMLUIController */
        
    class HTMLCriteriaController extends CriteriaSelectionController {
      constructor(discoveryObj) {
        super(discoveryObj);
        this.controller = $("[data-widget='discovery-controller']");
        this.facets = this.controller.find("[data-facet]");
        this.initUI();
      }
      
      initUI() {
        var self = this;
        
        /* 
           Allows us to define widget initialization methods based on the ui-type.
           Methods are in the form init[ui-type], with ui-type capitalized.
           
           Initialization functions are responsible for the following:
           - Binding the appropriate change event (e.g. a click for a list or change for a selection). 
           - Adding its parent facet to the query queue by assigning it a 'data-enqueue' attribute.
           - Adding a 'data-selected' attribute to any selected item.
           - Resetting the facet if a user selects an “all” or “none” value, indicated in the controller by a '*' data-value.
           - Firing the controller’s submit method.
           - Performing any UX event modifications (such as preventing default link behaviour on link lists).
        */
        
        this.facets.each(function() {
          var facet = $(this);
          if (typeof facet.data('ui-type') === undefined) { return; }
          var initfnc = "init" + facet.data('ui-type').ucfirst();
          if (typeof self[initfnc] !== 'function') { return; }
          self[initfnc](facet);
        });
      }
                  
      initList(facet) {
        var self = this;
        facet.find('[data-user-input-wrapper]').find('li').each(function() {
          $(this).bind('click',function(event) {
            event.preventDefault();
            var item = $(this);
            item.toggleClass('selected');
            if (item.data('value') === '*') {
              facet.removeAttr('data-enqueue');
              item.siblings('li').removeAttr('data-selected');
            } else {
              facet[0].setAttribute('data-enqueue',''); // Use native JS to set boolean attribute
              item[0].setAttribute('data-selected',''); 
            }
            self.submit();
          });
        });        
      }
      
      initTextfield(facet) {
        var self = this;
        facet.find('[data-user-input]').each(function() {
          $(this).bind('keypress',function(event) {
            var input = $(this);
            if(input.val().length > 2) { // Don’t submit if there are less than three characters in the text field
              facet[0].setAttribute('data-enqueue',''); // Use native JS to set boolean attribute
              input[0].setAttribute('data-selected','');
              input.attr('data-value',input.val());
              self.submit();
            } else {
              facet.removeAttr('data-enqueue');
              input.removeAttr('data-selected');
            }
          })
          .bind('keypress', function(event) { // intercepts return character which would otherwise "submit" the form
            if ((event.keyCode ? event.keyCode : event.which) === 13) {
              self.submit();
              return false;
            } else { 
              return true;
            }
          });
        });
      }   
      
      /* 
          Adds a list of data retrieval objects to the queue. Data retrieval objects contain a
          data op (corresponding to a method of the data object) and values corresponding to its
          arguments.
      */   
      
      enqueue() {
        var self = this;
        this.queue = [];
        this.controller.find('[data-enqueue]').each(function() {
          var facet = $(this);
          var values = [];
          facet.find('[data-selected]').each(function() {
            self.queue.push(
              {
                op: facet.data('op'),
                values: facet.data('param').replace('%%',$(this).attr('data-value')).split('|')
              }
            );
          });
          
        });
      }
      
      submit() {
        super.submit();
        this.enqueue();
        this.discoveryObj.stateChange();
      }
      
      
    }
    
    /* !DISCOVERY VIEW CLASS */
    
    class DiscoveryView {
      contructor(discoveryObj) {
        this.items = [];
      }
      
      setItems(items) {
        this.items = items;
        return this;
      }
      
      displayQueryResults() {

      }
    }
    
    
    /* !HTML VIEW CLASS */
    
    
    // Displays results on HTML5 Stage
    
    class HTMLView extends DiscoveryView {
      constructor(discoveryObj) {
        super(discoveryObj);
        this.view = $('[data-view-results]');
        this.stage = this.view.find('[data-view-stage]');
        this.titleStage = this.view.find('[data-view-title-stage]');
        this.templates = {};
        
        this.parseTemplates();        
      }
      
      // Finds templates in the DOM and adds them to the templates object.
      // Templates are designated in the DOM by a [data-view-template-wrapper] boolean attribute.
      // This script expects that each wrapper have [data-template-name], which will be used as
      // an object property. The template block is then removed from the DOM.
      
      parseTemplates() {
        var self = this;
        var templates = this.view.find('[data-view-templates]');
        templates.find('[data-view-template-wrapper]').each(function(){
          var twrapper = $(this);
          self.templates[twrapper.data('view-template-name')] = twrapper.html();
        })
        .remove();
      }
      
      // Tokens are processed as follows:  
      // %%DataKey%%
      
      processTokens(template,item) {
        var processed = template;
        template.match(/\%\%[^\%]*\%\%/g).forEach(function(token) {
          var key = token.replaceAll('%%','');
          processed = processed.replaceAll(token,item.values[key]);
        });
        
        return processed;
      }
      
      displayQueryResults() {
        var self = this;
        self.stage.html('');
        
        this.items.forEach(function(item) {
          self.stage.append(self.processTokens(self.templates.book_capsule,item));
        });
      }
    }
    
    // Displays controller particular to the ECommonsOntario site
    
    class ECommonsOntarioCriteriaController extends HTMLCriteriaController {
      constructor(discoveryObj) {
        super(discoveryObj);
      }
    }
    
    // Displays results particular to the ECommonsOntario site
    
    class ECommonsOntarioHTMLView extends HTMLView {
      constructor(discoveryObject) {
        super(discoveryObject);
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
      
      // Placeholder. Will be particular to database implementation
      
      setDateIssed(value,operator='<') {
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
      
      processResults() {
        
      }
      
      getResults() {
        this.processResults();
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
  
      /* 
        
        Available operators:
        
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
      
      processResults() {
        super.processResults();
        var self = this;
        var items = this.results.items;
        
        for(var i=0; i<items.length; i++) {
          var item = this.results.items[i];
          
          // Set default values.
                  
          var values = {
            uuid: item.uuid,
            subject: '',
            byline: '',
            title: ''
          };
          
          if (typeof item.metadata !== "undefined") {
            for(var j=0; j<item.metadata.length; j++) {
              var md = item.metadata[j];
              var key = md.key;
              if (typeof values[key] === "undefined") {
                values[key] = [];
              }
              values[key].push(md.value);
            }
          }
          
          // Join multiple values as single string
          
          for(var prop in values) {
            if (values[prop] === "undefined" || typeof values[prop] !== 'object') {
              values[prop] = '';
            } else {
              values[prop] = values[prop].join('%%');
            }
          }
          

          
          // Process contributors
          values.byline = self.serializeDisplayString(values,'dc.contributor.author');
          values.subjects = self.serializeDisplayString(values,'dc.subject');
          
          this.results.items[i].values = values;
        }
      }
      
      serializeDisplayString(values,key) {
        var output = '';
        
        if (typeof values[key] !== "undefined") {
          output = values[key].replaceAll('%%',', ');
          output = output.replaceLast(',',' and');
        }
        
        return output;
      }
      
      setAdditionalParameter(parameter,value) {
        this.query.push({
          name: parameter,
          value: value
          });
        return this;
      }
      
      // TO DO
      
      setDateIssed(term,operator='<') {
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
            list: {                               // Returns all bitstreams in DSpace
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
            list: {                               // Returns a list of all schemas
              method: "GET",
              path:     "registries/schema"
            },
            item: {                               // Returns a metadata schema with schema prefix %%
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
    
    /* !DISCOVERY CLASS */
    
    class Discovery {
      constructor() {
        this.dataOpQueue = [];
        this.results = {};
        this.items = [];
        this.view = {};
        
        /* Example:
          this.criteriaController = new ECommonsOntarioCriteriaController(this);
          this.paginationController = new HTMLPaginationController(this);
          this.view = new ECommonsOntarioHTMLView(this);
          this.data = new DSpaceDataHandler(vars.dbURI, vars.dbmethod);
        */
      }
      
      // fired by Controller when it changes state
      
      stateChange() {
        this.dataOpQueue = this.criteriaController.queue;
        this.retrieveData().extractItems(); // populates this items
        this.view
          .setItems(this.items)
          .displayQueryResults();
      }
      
      // Clears data parameters
      
      resetDataParameters() {
        this.data.resetQueryParameters();
      }
      
      retrieveData() {
        var self = this;
        self.resetDataParameters();
        this.dataOpQueue.forEach(function(item){
          self.data[item.op].apply(self.data,item.values);
        });
        self.results = self.data.performQuery().getResults();
        return this;
      }
      
      // The Discovery class expects the results object to have an “items” property
      // containing an array of items.
      
      extractItems() {
        this.items = typeof this.results.items !== undefined ? this.results.items : [];
        return this;
      }
    }
    
    /* !ECO DISCOVERY CLASS */
    /*
      vars expects:
      
      {
        dbURI:      'books.spi.ryerson.ca/rest',
        dbmethod:   'https'
      }
      
    */
    
    class ECommonsOntarioDiscovery extends Discovery {
      constructor(vars) {
        super();
        this.criteriaController = new ECommonsOntarioCriteriaController(this);
        this.paginationController = new HTMLPaginationController(this);
        this.view = new ECommonsOntarioHTMLView(this);
        this.data = new DSpaceDataHandler(vars.dbURI, vars.dbmethod);
      }
      
      resetDataParameters() {
        super.resetDataParameters();
        this.data.includeMetaData();
      }
      
    }
    
    /* !DOCUMENT READY */
    
    $(document).ready(function() {
            
      var discovery = new ECommonsOntarioDiscovery
        ({
          dbURI:        'books.spi.ryerson.ca/rest',
          dbmethod:     'https'
        });
      
      // var results = discovery.data.setSearchTerm('Electrical').includeMetaData().performQuery().getResults();
      
    });
  
})(jQuery);

// Functions like PHP’s ucfirst()

String.prototype.ucfirst = function() {
  return this.charAt(0).toUpperCase() + this.slice(1);
};

// Replaces all instances of a string

String.prototype.replaceAll = function(search, replacement) {
  var target = this;
  return target.replace(new RegExp(search, 'g'), replacement);
};

String.prototype.replaceLast = function(find, replace) {
  var index = this.lastIndexOf(find);

  if (index >= 0) {
      return this.substring(0, index) + replace + this.substring(index + find.length);
  }

  return this.toString();
};



