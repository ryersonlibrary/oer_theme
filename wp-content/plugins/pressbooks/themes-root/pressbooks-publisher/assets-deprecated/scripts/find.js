/* jshint latedef:nofunc */
//needed for function hoisting for build

(function($) {

	/***OpenTextBook***/
	var opentextbookxhr = null;
	var searchfacets={"subject":"","type":"","date":"3months","peerreview":"reviewed","level":"postsecondary","language":"","rights":"","source":""};
	var searchterm='';
	var offset=0;
	var defaultitemstodisplay=10;
	
	function opentextbookxhrpaginate(v){
		offset=(v*defaultitemstodisplay)-defaultitemstodisplay; //subtract default to handle offset of 0*10 and pagination; i.e. offset is *start* of page, not end (page 1 contains items 0-9; page 2, 10-19)
		opentextbookdspacexhr();
	}
	
	function opentextbookdspacexhr(){
		jQuery('#results-list').html('<img class="ajaxloader" src="/wp-content/themes/opentextbook/dist/images/ajax-loader.gif">');
		/* if there is a previous ajax request, then we abort it and then set xhr to null */
		if( opentextbookxhr != null ) {
			opentextbookxhr.abort();
			opentextbookxhr = null;
		}
		/**build querydata**/
		var querydata='';
		$.each(searchfacets,function(k,v){
			var dspacefriendlyterm=k;
			switch(k){
				case "date":
					dspacefriendlyterm=k+".issued";
				break;
			}
			querydata=querydata+"query_field[]=dc."+dspacefriendlyterm+"&query_op[]=contains&query_val[]="+v+"&";
		});
		searchterm=jQuery('#discovery-keyword-term').val();
		var searchdata=querydata+"query_field[]=*&query_op[]=contains&query_val[]="+searchterm+"&limit="+defaultitemstodisplay.toString()+"&offset="+offset.toString();
		/* and now we can safely make another ajax request since the previous one is aborted */
		opentextbookxhr = jQuery.getJSON( "/10_items.json", searchdata, function(data){
			jQuery('#results-list,.searchterm').empty();
			jQuery('#results-counter-totalresults').text(data.length);
			var searchlimitations='';
			//maintain array order! it is syntactic. date is handled afterwards for similar reasons.
			var searchlimitationsparams=["peerreview","source","rights","language","level","type"];
			
			/*jshint -W069 */
			/*Disable Warning Justification:
			    Using bracket notation to facilitate querystring params for DSpace API which use periods, e.g. dc.contributor.author */
			$.each(searchlimitationsparams,function(k,v){
				if(searchfacets[v]!==''){
					searchlimitations=searchlimitations+' '+$('[data-term="'+searchfacets[v]+'"]').text();
				}
			});
			jQuery('#search-limitations').text(searchlimitations.replace(/Items Only/gi, ""));
			if(searchfacets["subject"]!==''){
				jQuery('#search-subject').html(' <span class="notsearchterm">in</span> '+$('[data-term="'+searchfacets["subject"]+'"]').text());
			}
			if(searchterm!==''){
				jQuery('#search-keyword').html(' <span class="notsearchterm">with the keyword "</span>'+searchterm+'<span class="notsearchterm">"</span>');
			}
			if(searchfacets["date"]!==''){
				jQuery('#search-created').html(' <span class="notsearchterm">created within the</span> '+$('[data-term="'+searchfacets["date"]+'"]').text());
			}
			/*jshint +W069 */
			
			/*** NEED PAGINATION in JSON
			jQuery('#results-counter-totalpages').text(data.totalpages);
			jQuery('#results-counter-thispage').text(data.thispage);
			jQuery.each(data.totalpages,function(k,v)){
				jQuery('#results-pagecounter-pages').append('<span class="resultspage" id="resultspage-'+k+'">'+k+'</span>');
				jQuery('#resultspage-'+k).click(function(){
					opentextbookxhrpaginate(k);
				});
			});
			***/
			jQuery.each(data,function(k,v){
				var author='';
				var subjects=[];
				jQuery.each(v.metadata,function(k,v){
					if(v.key==='dc.contributor.author'){
						author=v.value;
					}
					if(v.key==='dc.subject'){
						subjects.push(v.value);
					}
				});
				var subj=subjects.join(",");
				jQuery('#results-list').append('<div class="result-item col-lg-3 col-md-4"><span id="'+v.uuid+'" class="textbook"><span id="'+v.uuid+'-cover"class="textbook-cover"></span><p class="textbook-header">'+subj+'</p><h4 class="textbook-title">'+v.name+'</h4><p class="textbook-authors">'+author+'</p><p class="textbook-footer">&gt;&nbsp;&nbsp;<a href="preview/?id='+v.uuid+'">About this book</a></p>');
				jQuery('#'+v.uuid+'-cover').css("backgroundImage","url('/wp-content/themes/opentextbook/dist/images/ryerson_stock_bg.jpg')");
			});
			jQuery('#results-list').append('<div class="result-item create-new-item col-lg-3 col-md-4"><span id="new-textbook" class="textbook"><span class="textbook-cover"></span><p class="textbook-header">&nbsp;</p><h4 class="textbook-title">Create your own textbook</h4><p class="textbook-authors">Add a text to this (or any) topic.</p><p class="textbook-footer"><input type="button" value="Start Authoring" class="btn btn-secondary"></p></span></div>');
		});
	}
	
	/**set up discovery ui facets**/
	function opentextbooksetupdiscovery(){
		offset=0; //reset offset
		$('li').removeClass('selectedfacet');
		jQuery.getJSON( "/subjects.json", function(data){
			$.each(data.subjects,function(k,v){
				jQuery('#discovery-ui-subject').append('<li data-term="'+v+'" class="subjectfacet">'+v+'</li>');
			});
			var subjectstoshow=5;
			jQuery('#discovery-ui-subject').children('li').hide();
			jQuery('#discovery-ui-subject > li').slice(0,subjectstoshow).show();
			$('#discovery-moresubjects').click(function() {
				$('#discovery-ui-subject > li:hidden').slice(0,subjectstoshow).show();
				if($('#discovery-ui-subject > li:hidden').length === 0){
					$('#discovery-moresubjects').hide();
				}
			});
		}).done(function(){
			$.each(searchfacets,function(k,v){
				$('#discovery-ui-'+k).children('li').each(function(){
					if($(this).attr('data-term')===v){
						$(this).addClass('selectedfacet');
					}
				});
				$('#discovery-ui-'+k).children('li').click(function(){
					offset=0; //changing search params, reset offset for pagination
					searchfacets[k]=$(this).attr('data-term');
					$('#discovery-ui-'+k).children('li').removeClass('selectedfacet');
					$(this).addClass('selectedfacet');
				});
			});
			//auto run a search to populate results.
			opentextbookdspacexhr();
		});
	}
	
	opentextbooksetupdiscovery();
	
	//test purposes only!
	jQuery('#resultspage-2').click(function(){
		opentextbookxhrpaginate(2);
	});
	
	jQuery('#discovery-submit-btn').click(function(){
		opentextbookdspacexhr();
	});
	jQuery('#discovery-reset-btn').click(function(){
		searchfacets={"subject":"","type":"","date":"3months","peerreview":"reviewed","level":"postsecondary","language":"","rights":"","source":""};
		opentextbooksetupdiscovery();
	});
	
	/**make term input fire**/
	$('#discovery-keyword-term').keypress(function(e) {
		offset=0; //reset offset anytime typing occurs in keyword-term
	    if(e.which === 13) {
	    	opentextbookdspacexhr();
	    }
	});
})(jQuery);
