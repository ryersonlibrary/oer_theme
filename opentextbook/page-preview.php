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
            		<p><span id="textbook-adopt-adapt">
            		<span class="btn btn-primary" id="adopt-btn">Adopt this text</span>
            		<span class="btn btn-inverted" id="adapt-btn">Adapt this text</span>
            		</span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vulputate erat vel interdum congue. Etiam eleifend in lacus non dignissim. Praesent a eleifend risus, eu semper urna. Nam blandit purus vitae semper fermentum. Quisque velit nulla, hendrerit ac nisl tempor, hendrerit tincidunt eros. Morbi finibus dolor est, in rhoncus sem sodales eu. Ut gravida scelerisque libero, pellentesque blandit libero vehicula eu. Suspendisse euismod massa et ipsum bibendum, a consequat dui sagittis. Integer aliquam justo et metus sagittis, placerat fermentum purus auctor. Ut turpis mauris, mollis sit amet nibh ultricies, placerat aliquet dui. Vivamus orci eros, viverra ullamcorper est quis, vehicula blandit lectus. Sed vestibulum malesuada quam a maximus. Donec facilisis felis enim, eget blandit est scelerisque in. Quisque neque nibh, sollicitudin eu ante a, aliquet pulvinar tellus. Morbi accumsan, elit at efficitur hendrerit, risus sapien sagittis eros, ut aliquet eros neque in erat.</p>
            		<p>Mauris quam est, lacinia a interdum eget, tristique in lectus. Proin tempor ex quis lacus laoreet ultrices. Sed id orci vitae orci aliquet varius. Fusce sit amet consectetur libero. Aenean erat tortor, consequat vitae euismod eu, consectetur laoreet urna. Morbi at ultrices orci. Nam faucibus lacus non dapibus consequat. Sed vehicula lacinia sapien, in consectetur eros ornare imperdiet. Pellentesque quis bibendum nisi. Praesent aliquet egestas turpis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
            		<p>In aliquam blandit sagittis. Vestibulum libero massa, auctor vel semper quis, lobortis id libero. Curabitur eu orci enim. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec volutpat libero id rutrum sagittis. Sed varius condimentum eros quis mattis. Praesent nec diam eu tellus faucibus eleifend. Ut eget placerat ligula. Proin tortor lacus, congue at purus a, ornare eleifend felis. Vestibulum ac pharetra purus. Aliquam vehicula laoreet volutpat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec quis urna lorem. Nunc vestibulum, eros eget blandit congue, mi tellus mollis magna, vel suscipit sapien ex vel augue.</p>
            		<p>Maecenas a turpis tempus, consectetur turpis eget, consequat dolor. Nulla sodales consequat nunc sit amet aliquet. Sed diam enim, bibendum quis placerat a, interdum nec risus. Sed nisi augue, efficitur sagittis ullamcorper sit amet, laoreet sit amet ipsum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin mattis eleifend metus, a cursus enim ullamcorper quis. Donec vehicula ex nulla, nec aliquet mi mollis sit amet. Sed nulla tellus, tincidunt a egestas ut, vulputate vel quam. Vivamus pharetra ultricies felis ac tincidunt. Ut pharetra magna at dolor tempus, et scelerisque ligula dignissim. Donec tincidunt turpis quis eros gravida maximus.</p>
        		</div>
        		<h2 id="preview-table-of-contents">See Table of Contents &#129130;</h2>
            	</div>
            	<div id="preview-info" class="col-lg-4 col-md-4">
            		<img id="preview-bookcover" src="/wp-content/themes/opentextbook/dist/images/ryerson_stock_bg.jpg">
            		<div id="authors" class="col-lg-12 col-md-12">
            			<div class="author-info">
            				<h4 class="author-name">Author Name</h4>
            				<p class="author-bio">Maecenas a turpis tempus, consectetur turpis eget, consequat dolor. Nulla sodales consequat nunc sit amet aliquet. Sed diam enim, bibendum quis placerat a, interdum nec risus. </p>
            			</div>
            			<div class="author-info">
            				<h4 class="author-name">Author Name</h4>
            				<p class="author-bio"><img class="author-portrait" src="/wp-content/themes/opentextbook/dist/images/ryerson_stock_bg.jpg" class="author-portrait">Maecenas a turpis tempus, consectetur turpis eget, consequat dolor. Nulla sodales consequat nunc sit amet aliquet. Sed diam enim, bibendum quis placerat a, interdum nec risus. </p>
            			</div>
            		</div>
            		<div id="preview-about" class="col-lg-12 col-md-12">
            			<hr>
            			<h3>About</h3>
            			<div class="row">
                			<div id="preview-metadata" class="col-lg-6 col-md-6">
                    			<h6>Date Published</h6>
                    			<p id="date-published">2017 July 08</p>
                    			<h6>Subjects</h6>
                    			<p id="subjects">Science, History</p>
                    			<h6>Type</h6>
                    			<p id="type">Course of Study</p>
                    			<h6>Level</h6>
                    			<p id="level">Post-Secondary</p>
                    			<h6>Adapted From</h6>
                    			<p id="adapted-from">Some other text</p>
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
jQuery.getJSON( "/single_item.json",{id:'<?php echo $_GET['id'];?>'}, function(data){
	console.log(data);
	var author='';
	var subjects=[];
	jQuery.each(data.metadata,function(k,v){
		if(v.key==='dc.contributor.author'){
			author=v.value;
		}
		if(v.key==='dc.subject'){
			subjects.push(v.value);
		}
	});
	var subj=subjects.join(",");
	jQuery('#textbook-title').text(data.name);
	jQuery('#textbook-title-authors').text(author);
});
</script>
<?php }?>