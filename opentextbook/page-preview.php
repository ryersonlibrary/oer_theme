<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
?>
<section id="preview" class="whitebox">
	<div class="container">
    	<div class="content row">
        	<div id="preview-box" class="col-lg-12 col-md-12">
        	<?php if($_GET['id']){?>
        		<div id="preview-description" class="col-lg-8 col-md-8">
        		<h2>Book Description</h2>
        		<div id="textbook-description">
            		<span id="textbook-adopt-adapt">
            		<span class="btn btn-primary" id="adopt-btn">Adopt this text</span>
            		<span class="btn btn-inverted" id="adapt-btn">Adapt this text</span>
            		</span>
            		<span id="textbook-description-info">
            		</span>
        		</div>
        		<h2 id="preview-table-of-contents">See Table of Contents &#129130;</h2>
        		<div id="textbook-table-of-contents-info"></div>
            	</div>
            	<div id="preview-info" class="col-lg-4 col-md-4">
            		<img id="preview-bookcover" src="/wp-content/themes/opentextbook/dist/images/ryerson_stock_bg.jpg">
            		<div id="authors" class="col-lg-12 col-md-12">
            		</div>
            		<div id="preview-about" class="col-lg-12 col-md-12">
            			<hr>
            			<h3>About</h3>
            			<div class="row">
                			<div id="preview-metadata" class="col-lg-6 col-md-6">
                    			<h6>Date Published</h6>
                    			<p id="date-published"></p>
                    			<h6>Subjects</h6>
                    			<p id="subjects"></p>
                    			<h6>Type</h6>
                    			<p id="type"></p>
                    			<h6>Level</h6>
                    			<p id="level"></p>
                    			<h6>Adapted From</h6>
                    			<p id="adapted-from"></p>
                			</div>
                			<div id="preview-use-data" class="col-lg-6 col-md-6">
                				<h5 id="adoption-count">5 Adoptions</h5>
                				<h5 id="peerreview-count">3 Peer Reviews</h5>
                			</div>
            			</div>
            			<div class="row">
                			<div id="preview-rights-logo" class="col-lg-3 col-md-3">
                				<img src="/wp-content/themes/opentextbook/dist/images/creative-commons-darkteal.png">
                			</div>
                			<div id="preview-rights" class="col-lg-9 col-md-9">
                				This text is licensed under Creative Commons ShareAlike 4.0. Your are free to copy and redistribute the material in any medium or format. You may remix, transform, and build upon the material for any purpose, even commercially.
                			</div>
            			</div>
            		</div>
            	</div>
            <?php }else{?>
            no id!
            <?php }?>
            </div>
		</div>
	</div>
</section>
<section id="page-footer" class="bgimg-2 bgbox">
    <div class="container">
    	<div class="content row"></div>
	</div>
</section>
<?php if($_GET['id']){?>
<script>
	jQuery('#available-versions').hide();
	jQuery.getJSON( "/single_item.json",{uuid:'<?php echo $_GET['id'];?>'}, function(data){
		jQuery('#textbook-title').text(data.name);
		var author='';
		var subjects=[];
		jQuery.each(data.metadata,function(k,v){
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
				jQuery('#textbook-title-authors').text(v.value);
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

		jQuery.each(data.bitstreams,function(k,v){
			jQuery('#available-versions ul').append('<li><a href="'+v.retrieveLink+'" target="_blank">'+v.format+'</a></li>');
		});
	});
	jQuery('#download-btn').click(function(){
		jQuery('#download-btn').toggleClass('noradiusbtn');
		jQuery('#available-versions').toggle();
	});
</script>
<?php }?>