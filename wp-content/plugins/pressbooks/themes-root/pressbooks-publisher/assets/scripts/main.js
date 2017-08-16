(function($) {
/***Pressbooks Default***/	
	$('.catalog').each(function() {
		$(this).children('.book').matchHeight();
	});

/***Opentextbook Preview.js***/
	var opentextbookxhr = null;

	function opentextbookpreview(id){
		id=id||false;
		if(id){
			opentextbookxhr = jQuery.getJSON( "/single_item.json",{uuid:id}, function(data){
				jQuery('#textbook-title').text(data.name+'---');
				var author='';
				var subjects=[];
				jQuery.each(data.metadata,function(k,v){
					console.log(v);
					console.log(v.key);
					if(v.key==='dc.contributor.author'){
						var authorelement='<div class="author-info"><h4 class="author-name">'+v.value+'</h4><p class="author-bio">';
						if(v.image_url){
							authorelement=authorelement+'<img class="author-portrait" src="'+v.image_url+'" class="author-portrait">';
						}
						if(v.bio){
							authorelement=authorelement+v.bio;
						}
						authorelement=authorelement+'</p></div>';
						jQuery('#authors').append(authorelement);
						jQuery('#textbook-title-authors').text(v.value+'---');
					}
					if(v.key==='dc.subject'){
						subjects.push(v.value);
					}
					if(v.key==='dc.description.abstract'){
						jQuery('#textbook-description-info').html('<p>'+v.value+'</p>');
					}
					if(v.key==='LRMI.EducationalAudience'){
						jQuery('#level').text(v.value);
					}
					if(v.key==='dc.date.created'){
						jQuery('#date-published').text(v.value);
					}
					if(v.key==='dc.type'){
						jQuery('#type').text(v.value);
					}
				});
				var subj=subjects.join(",");
				jQuery('#subjects').text(subj);
				jQuery('#preview-bookcover').attr('src',data.cover_url);
				
				jQuery('#textbook-table-of-contents-info').html();
				jQuery('#adapted-from').text();
				jQuery('#adoption-count').text();
				jQuery('#peerreview-count').text();
			});
		}
	}
})(jQuery);