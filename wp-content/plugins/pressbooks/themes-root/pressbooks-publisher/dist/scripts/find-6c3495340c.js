!function(e){function t(e){i=e*n-n,s()}function s(){jQuery("#results-list").html('<img class="ajaxloader" src="/wp-content/themes/opentextbook/dist/images/ajax-loader.gif">'),null!=r&&(r.abort(),r=null);var t="";e.each(o,function(e,s){var c=e;switch(e){case"date":c=e+".issued"}t=t+"query_field[]=dc."+c+"&query_op[]=contains&query_val[]="+s+"&"}),a=jQuery("#discovery-keyword-term").val(),console.log(a);var s=t+"query_field[]=*&query_op[]=contains&query_val[]="+a+"&limit="+n.toString()+"&offset="+i.toString();r=jQuery.getJSON("/10_items.json",s,function(t){jQuery("#results-list,.searchterm").empty(),jQuery("#results-counter-totalresults").text(t.length);var s="",c=["peerreview","source","rights","language","level","type"];e.each(c,function(t,c){""!==o[c]&&(s=s+" "+e('[data-term="'+o[c]+'"]').text())}),jQuery("#search-limitations").text(s.replace(/Items Only/gi,"")),""!==o.subject&&jQuery("#search-subject").html(' <span class="notsearchterm">in</span> '+e('[data-term="'+o.subject+'"]').text()),""!==a&&jQuery("#search-keyword").html(' <span class="notsearchterm">with the keyword "</span>'+a+'<span class="notsearchterm">"</span>'),""!==o.date&&jQuery("#search-created").html(' <span class="notsearchterm">created within the</span> '+e('[data-term="'+o.date+'"]').text()),jQuery.each(t,function(e,t){var s="",c=[];jQuery.each(t.metadata,function(e,t){"dc.contributor.author"===t.key&&(s=t.value),"dc.subject"===t.key&&c.push(t.value)});var r=c.join(",");jQuery("#results-list").append('<div class="result-item col-lg-3 col-md-4 col-sm-6 col-xs-6"><span id="'+t.uuid+'" class="textbook"><span id="'+t.uuid+'-cover"class="textbook-cover"></span><p class="textbook-header">'+r+'</p><h4 class="textbook-title">'+t.name+'</h4><p class="textbook-authors">'+s+'</p><p class="textbook-footer">&gt;&nbsp;&nbsp;<a href="preview/?id='+t.uuid+'">About this book</a></p>'),jQuery("#"+t.uuid+"-cover").css("backgroundImage","url('/wp-content/themes/opentextbook/dist/images/ryerson_stock_bg.jpg')")}),jQuery("#results-list").append('<div class="result-item create-new-item col-lg-3 col-md-4 col-sm-6 col-xs-6"><span id="new-textbook" class="textbook"><span class="textbook-cover"></span><p class="textbook-header">&nbsp;</p><h4 class="textbook-title">Create your own textbook</h4><p class="textbook-authors">Add a text to this (or any) topic.</p><p class="textbook-footer"><a id="start-authoring-btn" href="" class="btn btn-secondary">Start Authoring</a></p></span></div>')})}function c(){i=0,e("li").removeClass("selectedfacet"),jQuery.getJSON("/subjects.json",function(t){e.each(t.subjects,function(e,t){jQuery("#discovery-ui-subject").append('<li data-term="'+t+'" class="subjectfacet">'+t+"</li>")});var s=5;jQuery("#discovery-ui-subject").children("li").hide(),jQuery("#discovery-ui-subject > li").slice(0,s).show(),e("#discovery-moresubjects").click(function(){e("#discovery-ui-subject > li:hidden").slice(0,s).show(),0===e("#discovery-ui-subject > li:hidden").length&&e("#discovery-moresubjects").hide()})}).done(function(){e.each(o,function(t,s){e("#discovery-ui-"+t).children("li").each(function(){e(this).attr("data-term")===s&&e(this).addClass("selectedfacet")}),e("#discovery-ui-"+t).children("li").click(function(){i=0,o[t]=e(this).attr("data-term"),e("#discovery-ui-"+t).children("li").removeClass("selectedfacet"),e(this).addClass("selectedfacet")})}),s()})}var r=null,o={subject:"",type:"",date:"3months",peerreview:"reviewed",level:"postsecondary",language:"",rights:"",source:""},a="",i=0,n=10;c(),jQuery("#resultspage-2").click(function(){t(2)}),jQuery("#discovery-submit-btn").click(function(){s()}),jQuery("#discovery-reset-btn").click(function(){o={subject:"",type:"",date:"3months",peerreview:"reviewed",level:"postsecondary",language:"",rights:"",source:""},c()}),e("#discovery-keyword-term").keypress(function(e){i=0,13===e.which&&s()})}(jQuery);