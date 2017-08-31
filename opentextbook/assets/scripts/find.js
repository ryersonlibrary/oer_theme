/* jshint latedef:nofunc */
//needed for function hoisting for build 

(function($) {
  
    /* !DISCOVERY CONTROLLER CLASS */
    
    // Core Controller Class
    
    class DiscoveryController {
      constructor(discoveryObj) {
        this.discoveryObj = discoveryObj;
        this.controller = null;
        this.queue = [];
      }  
      
      // To be called when results return from the data handler. Used to update results-dependent control devices such as paginators.
      
      updateController() {
        
      }
      
      // The controller is responsible for adding Data Class operators and values to the this.queue array, using the following form:
      // { op: 'dataOpName', value: [list,of,op,arguments] }
      
      enqueue() {
        
      }
      
      // Submit enqueues and activates a controller state change in the main Disocvery object. 
      // If you want to manually retrieive values just enqueue the controller (listing its ops)
      
      // Reset should reset the controller to its default options.
      
      reset() {
        
      }
            
      submit() {
        this.enqueue();
        this.discoveryObj.controllerStateChange();
      }
      
    }
    
    // Manages UIs that submit filter criteria.
    
    /* !CRITERIA SELECTION CONTROLLER CLASS */
    
    class CriteriaSelectionController extends DiscoveryController {
      constructor(discoveryObj) {
        super(discoveryObj);
        this.facets = null;
      }
      
      updateController() {
        super.updateController();
      }
      
      enqueue() {
        super.enqueue();
      }
      
      submit() {
        super.submit();
      }
      
    }
    
    /* !PAGINATION CONTROLLER CLASS */
    // Manages Pagination UIs.
    
    class PaginationController extends DiscoveryController {
      constructor(discoveryObj) {
        super(discoveryObj);
      }
      
      updateController() {
        super.updateController();
      }
      
      initUI() {
        
      }
      
      enqueue()  {
        super.enqueue();
      }
      
      submit() {
        super.submit();
      }
    }
    
    /* !HTML PAGINATION CONTROLLER CLASS */
    
    // Manages HTML5-Based Pagination UIs
    class HTMLPaginationController extends PaginationController {
      constructor(discoveryObj) {
        super(discoveryObj);
        
        // Components
        this.discoveryObj = discoveryObj;
        this.paginator = $('[data-controller-paginator]');
        this.nextbtn = this.paginator.find('[data-controller-next]');
        this.prevbtn = this.paginator.find('[data-controller-previous]');
        this.pagebtns = this.paginator.find('[data-controller-pagebtns]');
        this.pageIndicator = this.pagebtns.html();
        
        this.currentPageIndicator = this.paginator.find('[data-controller-current-page]');
        this.totalResultsIndicator = this.paginator.find('[data-controller-total-results]');
        this.currentRangeIndicator = this.paginator.find('[data-controller-current-range]');
        
        // Settings
        
        this.itemLimit = this.paginator.data('controller-item-limit');
        this.currentPage = this.paginator.data('controller-current-page');
                        
        this.initUI();
      }
      
      nextPage() {
        var resultsInfo = this.discoveryObj.data.getResultInfo();
        var nextPage = (resultsInfo.currentPage + 1) > resultsInfo.totalPages ? 1 : (resultsInfo.currentPage + 1);
        this.viewPage(nextPage);
      }
      
      previousPage() {
        var resultsInfo = this.discoveryObj.data.getResultInfo();
        var prevPage = (resultsInfo.currentPage - 1) === 0 ? resultsInfo.totalPages : (resultsInfo.currentPage - 1);
        this.viewPage(prevPage);
      }
            
      viewPage(page) {        
        var resultsInfo = this.discoveryObj.data.getResultInfo();
        this.paginator.attr('data-controller-current-page',page);
      }
      
      updateController() {
        this.initUI();
      }
      
      initUI() {
        super.initUI();
        
        var self = this;
        var resultsInfo = this.discoveryObj.data.getResultInfo();
                        
        // Resent click event handlers and hide control elements.        
        
        if (this.nextbtn.length > 0) {
          this.nextbtn.unbind('click').hide();
          
          this.nextbtn.bind('click',function(event){
            event.preventDefault();
            self.nextPage();
            self.submit();
          });
          
          if (resultsInfo.currentPage < resultsInfo.totalPages) {
            this.nextbtn.show();
          } 
        }
        
        if(this.prevbtn.length > 0) {
          this.prevbtn.unbind('click').hide();
          
          this.prevbtn.bind('click',function(event){
            event.preventDefault();
            self.previousPage();
            self.submit();
          });
          
          if (resultsInfo.currentPage > 1) {
            this.prevbtn.show();
          }   
        
        }
        
        this.pagebtns.hide();
        this.pagebtns.html('');
          
        if (this.paginator.length > 0) {
        
          // Build paginators
          
          if (resultsInfo.totalPages > 0) {
            for (var i=1;i<resultsInfo.totalPages+1;i++) {
              this.pagebtns.append(this.pageIndicator.replaceAll('%%',i)); 
            }
                        
            this.pagebtns.find('[data-controller-pagebtn]').each(function(){
              $(this).bind('click',function(event) {
                event.preventDefault();
                self.viewPage($(this).attr('data-pageref'));
                self.submit();
              });
            });
            
            this.pagebtns.show();

            
            if (this.currentPageIndicator.length > 0) {
              this.currentPageIndicator.html(resultsInfo.currentPage);
            }
            
            if (this.totalResultsIndicator.length > 0) {
              this.totalResultsIndicator.html(resultsInfo.totalResults);
            }
            
            if (this.currentRangeIndicator.length > 0) {
              var start = ((resultsInfo.currentPage-1) * resultsInfo.itemLimit) + 1;
              var end = ((resultsInfo.currentPage-1) * resultsInfo.itemLimit) + resultsInfo.itemLimit;
              end = end > resultsInfo.totalResults ? resultsInfo.totalResults : end;
              this.currentRangeIndicator.html(start + " – " + end);
            }
            
            this.paginator.show();
          }
        }        
      }
      
      enqueue() {
        this.queue = [];
        this.queue.push(
          {
            op: 'setItemLimit',
            values: [this.paginator.attr('data-controller-item-limit'),this.paginator.attr('data-controller-current-page')]
          });          
      }
      
      
    }
    
    /* !HTML SEARCH BOX CLASS */
    // Manages standalone Search Box UIs
    
    class HTMLSearchBox extends CriteriaSelectionController {
      constructor(discoveryObj) {
        super(discoveryObj);
      }
    }
        
    /* !HTMLUI CONTROLLER */
        
    class HTMLCriteriaController extends CriteriaSelectionController {
      constructor(discoveryObj) {
        super(discoveryObj);
        this.controller = $("[data-widget='discovery-controller']");
        this.facets = this.controller.find("[data-facet]");
        
        // Settings
        this.maxlistitems = 10;
        
        // Init
        this.setDefaultState();
        this.initUI();
        
        
      }
      
      // Finds any item marked 'data-default-value' and sets it for inclusion in the queue.
      
      setDefaultState() {
        this.controller.find('[data-default-value]').each(function(){
          $(this)[0].setAttribute('data-selected','');
          $(this).closest('[data-facet]')[0].setAttribute('data-enqueue','');
        });
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
          self[initfnc](facet,self);
        });
      }
                  
      initList(facet,self) {
        var itemcnt = 0;
        var showmore = false;
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
          
          if (itemcnt++ > self.maxlistitems) {
            $(this).hide();
            showmore = true;
          }
        });  
        
        // UI Animation for showing and hiding long item lists
        
        if (showmore === true) {
                    
          var morebtn = $("<p data-controller-ui-showmore><a title='Show all items'>Show all items</a><p>");
          var fewerbtn = $("<p data-controller-ui-showfewer><a title='Show fewer items'>Show fewer items</a><p>");
          
          morebtn
            .css('cursor','pointer')
            .addClass('showmore')
            .bind('click',function(event) {
              event.preventDefault();
              facet.find('li:hidden').each(function(){
                $(this).fadeIn(200);
              });
              $(this).hide();
              facet.find('[data-controller-ui-showfewer]').fadeIn(200);
            });
            
          fewerbtn
            .css('cursor','pointer')
            .css('display','none')
            .addClass('showmore')
            .bind('click',function(event) {
              event.preventDefault();
              var i=0;
              facet.find('li').each(function(){
                if (i++ > self.maxlistitems) {
                  $(this).fadeOut(200);
                }
              });
              $(this).hide();
              facet.find('[data-controller-ui-showmore]').fadeIn(200);
              $('html, body').animate({
                  scrollTop: self.controller.offset().top
              }, 800);
            });
          
          facet.append([morebtn,fewerbtn]); 
          
        }      
      }
      
      initTextfield(facet,self) {
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
      
      reset() {
        this.controller.find('[data-enqueue]').each(function(){
          $(this).removeAttr('data-enqueue');
        });
        
        this.controller.find('[data-selected]').each(function(){
          $(this).removeAttr('data-selected');
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
        
    /* !DISCOVERY DATA HANDLER */
    
    class DiscoveryDataHandler {
      constructor(dbURI, dbmethod) {
        this.dburl = dbmethod + '://' + dbURI;
        
        this.paths = this.build_paths();
        this.query = {};
        this.resultsComplete = null;
        this.XHROpts = this.resetXHROpts();
        this.results = {};
        this.itemLimit = 6;
        this.currentPage = 0;
        this.totalResults = 0;
        this.totalPages = 0;
        
        this.expandedResults = {}; // results without limits
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
      
      setSearchTerm(term,operator='matches') {
        return this;
      }      
      // Placeholder. Will be particular to database implementation
      
      setDateIssed(value,operator='<') {
        return this;
      }
      
      // Placeholder. Will be particualar to database implementation. 
      
      setItemLimit(limit,page) {
        var offset = limit * (page - 1);
        this.itemLimit = limit;
        this.currentPage = page;
        return this;
      }      
      
      // A wrapper for the query Parameter
      
      getQuery() {
        return this.query;
      }
      
      // Sets default options for the AJAX call.
      
      resetXHROpts() {
        this.XHROpts = {
          async: true,
          method: "GET", // default
          //traditional: true,
          //crossOrigin: true,
          error: this.xhrError,
        };
        
        this.resultsComplete= $.Deferred();
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
      
      executeQuery() {
        this.resetXHROpts();
        this.prepareQuery();
        this
          .setXHROpt('url',this.makeURL(this.paths.query.filtered_items.path))
          .setXHROpt('method',this.paths.query.filtered_items.method)
          .setXHROpt('data',this.query);  
        this.retrieve(); 
        return this;     
      }
      
      processResults() {
        var self = this;
        $.when(this.resultsComplete).done(function() {
          
        });
      }
      
      // To be called after results are processed. Each data class must return a total result count outside of filter limits.
      
      updateResultsInfo(totalResults) {
        this.totalResults = totalResults;
        this.totalPages = Math.ceil(this.totalResults / this.itemLimit);
      }
      
      // Returns a handy object with result resultsInfo. Useful for updating pagination controllers.
      
      getResultInfo() {
        return {
          itemLimit: parseInt(this.itemLimit),
          totalResults: parseInt(this.totalResults),
          currentPage: parseInt(this.currentPage),
          totalPages: parseInt(this.totalPages)
        };
      }
      
      // A shortcut to the results. Can only be called when this.resultsComplete is resolved.
      
      getResults() {
        return this.results;
      }
      
      makeURL(path) {
        return this.dburl + "/" + path;
      }
            
      // Retrieves data from storage. On success it calls an xhrResultsHandler (which is passed data directly)
      // and a processResults (which is handed no arguments and is intended to operate on this.results)
                      
      retrieve() {
        var self = this;
        $.ajax($.extend(this.XHROpts,
          {
            success: 
              function(data,textStatus,jqXHR) { 
                self.results = data; 
                self.xhrResultsHandler(data,textStatus,jqXHR,self);
                self.processResults();
                self.resultsComplete.resolve(); 
              },
          }
        ));
      }
      
      
      // Handles XHR Errors. This function must be explicity set as part of the $.ajax() parameters.
      
      xhrError(xhr, ajaxOptions, thrownError) {
        console.log('error');
        console.log(xhr);
        console.log(thrownError);
      }
      
      // called after a successful ajax request 
      // marks resultsComplete as resolve.
      
      xhrResultsHandler(data,textStatus,jqXHR,self) {
      
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
    
    /* !DSPACE DATA HANDLER */
    
    class DSpaceDataHandler extends DiscoveryDataHandler {
      constructor(dbURI, dbmethod) {
        super(dbURI, dbmethod);
        this.resetQueryParameters();
      }
      
      resetQueryParameters() {
        this.query = [];
        this.expansion = []; // expands the dataset
        this.filters = [];  // adds filters
        this.fields = []; // fields to show
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
      
      // Handles any special processing
      
      prepareQuery() {

      }
      
      // A search term is general across all metadata
      // Note: the “matches” operator alongside framing wildcards (“*value*”) returns a general case-insensitive result.
      
      setSearchTerm(value,operator='matches') {
        this.setQueryParameter('*','(?i).*' + value + '*',operator);
        return this;
      }
      
      // called after a successful ajax request 
      
      xhrResultsHandler(data,textStatus,jqXHR) {
        super.xhrResultsHandler(data,textStatus,jqXHR);
        if (typeof this.results.items === 'undefined') {
          this.results.items = [];
        }
      }
      
      processResults() {
        super.processResults();
        var self = this;
                
        if (typeof self.expandedResults['unfiltered-item-count'] !== "undefined") {
          self.updateResultsInfo(self.expandedResults['unfiltered-item-count']);
        }
        
        for(var i=0; i<self.results.items.length; i++) {
          var item = self.results.items[i];
          
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
          
          self.results.items[i].values = values;
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
            
      setItemLimit(limit=6,page=1) {
        super.setItemLimit(limit,page);
        var offset= limit * (page - 1);
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
            
      expandQuery(expansionValue) {
        if (this.expansion.includes(expansionValue) === false) {
          this.expansion.push(expansionValue);
          this.setAdditionalParameter('expand',this.expansion.join(','));
        }
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
      
      /* ! -- AJAX call */
      // See “HACK” below for explanation. Need to eliminate this.
      
      retrieve() {
        var self = this;
        $.ajax($.extend(this.XHROpts,
          {
            success: 
              function(data,textStatus,jqXHR) { 
                self.results = data; 
                self.xhrResultsHandler(data,textStatus,jqXHR,self);
                self.retrieveExpandedResults();
              },
          }
        ));
      }
      
      // HACK: Can't seem to find a way to retrieve both a paginated result and the total number of results without pagination.
      // This total value is required to set up a proper pagination UI.
      // One option would be to retrieve all results unpaginated and parse them on the client side. 
      // As of now we're querying twice to get the number of unfiltered items.
      
      retrieveExpandedResults() {
        var self = this;
                        
        $.ajax({
            method: "GET",
            async: true,
            url: this.makeURL(this.paths.query.filtered_items.path),
            data: this.query.filter(function(item){
              return (item.name === 'limit' || item.name === 'offset') !== true;
            }),
            success: 
              function(data,textStatus,jqXHR) { 
                self.expandedResults = data;
                self.processResults();
                self.resultsComplete.resolve(); 
              }
            });
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
        this.controllers = {};

        
        /* Example:
          this.view = new ECommonsOntarioHTMLView(this);
          this.data = new DSpaceDataHandler(vars.dbURI, vars.dbmethod);
        */
      }
      
      registerController(label,controller) {
        this.controllers[label] = controller;
      }
      
      inboundState() {
        
      }
            
      // fired by Controller when it changes state.
      // All controllers current op queues are reassembled.
      
      controllerStateChange() {
        
        this.resetDataOps();
        
        for (var controller in this.controllers) {
          if (this.controllers[controller].queue.length > 0) {
            this.dataOpQueue = this.dataOpQueue.concat(this.controllers[controller].queue);
          }
        }
                        
        this.execute();
      }
      
      setItemLimit(limit,page) {
        this.data.setItemLimit(limit,page);
      }
      
      resetDataOps() {
        this.dataOpQueue = [];
      }
            
      setDataOp(op,values) {

        // remove spaces from values
                
        values = values.map(function(val){
          val = val.trim();
          return val;
        });
        
        this.dataOpQueue.push({
          op: op,
          values: values
        });
      }
      
      quickSearch(term) {
        this.dataOpQueue = [];
        this.setDataOp('setSearchTerm',[term]);
        this.execute();
      }
            
      // Clears data parameters
      
      resetDataParameters() {
        this.data.resetQueryParameters();
      }
      
      // retrieves and displays data
      
      execute() {
        var self = this;
        self.retrieveData();
        $.when(this.data.resultsComplete).done(function(){
          self.results = self.data.getResults();
          self.items = typeof self.results.items !== "undefined" ? self.results.items : [];
          self.displayResults();
          self.updateControllers();
          
        });
      }
      
      // Updates all registered controllers
      
      updateControllers() {
        for(var controller in this.controllers) {
          this.controllers[controller].updateController();
        } 
      }
      
      // An Alias for reset Data Parameters
      
      newQuery() {
         this.resetDataParameters();
      }
      
      /* !-- Retrieve Data */

      retrieveData() {
        var self = this;
        this.resetDataParameters();
        this.dataOpQueue.forEach(function(item){
          self.data[item.op].apply(self.data,item.values);
        });
        self.data.executeQuery();
        return this;
      }      
      
      // This function can only be called when this.data.resultsComplete has been resolved.
      
      displayResults() {
        this.view
          .setItems(this.items)
          .displayQueryResults();
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
        this.data = new DSpaceDataHandler(vars.dbURI, vars.dbmethod);
        this.view = new ECommonsOntarioHTMLView(this);
        
        // TO DO: There could be auto-discovery here
        
        this.registerController('criteriaController',new ECommonsOntarioCriteriaController(this));
        this.registerController('paginationController', new HTMLPaginationController(this));
        
        this.inboundState();
      }
      
      /* !--Initial State of Application */
      
      // Right now only accepts search parameters
      
      inboundState() {
        var op = getUrlParameter('op');
        var value = decodeURIComponent(getUrlParameter('value'));
  
        if (op === 'setSearchTerm') {
          this.controller.criteriaController.reset();
          $('#search-value').val(value);
        }
        
        
        for(var controller in this.controllers) {

          this.controllers[controller].enqueue();
        }
        
        // Executes the initial state of the controllers.
        
        this.controllerStateChange();
        
      }
      
      setItemLimit(limit,page) {
        super.setItemLimit(limit,page);
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
          dbURI:        'dsweb.semiprodint.ryerson.ca/rest',
          dbmethod:     'http'
        });
      
      // var results = discovery.data.setSearchTerm('Electrical').includeMetaData().executeQuery().getResults();
      
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

// With thanks to http://www.jquerybyexample.net/2012/06/get-url-parameters-using-jquery.html

function getUrlParameter (sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
    sURLVariables = sPageURL.split('&'),
    sParameterName,
    i;

  for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split('=');

    if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined ? true : sParameterName[1];
    }
  }
}


