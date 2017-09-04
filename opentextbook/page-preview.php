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
        		<!--
        		<h2 id="preview-table-of-contents">See Table of Contents &#129130;</h2>
        		<div id="textbook-table-of-contents-info"></div>
            -->
            	</div>
            	<div id="preview-info" class="col-lg-4 col-md-4">
              	<!--
            		<img id="preview-bookcover" src="/wp-content/themes/opentextbook/dist/images/ryerson_stock_bg.jpg">
            		<div id="authors" class="col-lg-12 col-md-12"></div>
            		-->
            		<div id="preview-about" class="col-lg-12 col-md-12">
            			<hr>
            			<h3>About</h3>
            			<div class="row">
                			<div id="preview-metadata" class="col-lg-6 col-md-6">
                  			  <div class='metadata-item'>
                      			<h6>Date Published</h6>
                      			<p id="date-published"></p>
                  			  </div>
                  			  <div class='metadata-item'>
                      			<h6>Subjects</h6>
                      			<p id="subjects"></p>
                  			  </div>
                  			  <div class='metadata-item'>
                      			<h6>Type</h6>
                      			<p id="type"></p>
                  			  </div>
                  			  <div class='metadata-item'>
                      			<h6>Level</h6>
                      			<p id="level"></p>
                  			  </div>
                  			  <div class='metadata-item'>
                      			<h6>Adapted From</h6>
                      			<p id="adapted-from"></p>
                  			  </div>
                			</div>
                			<div id="preview-use-data" class="col-lg-6 col-md-6">
                  			<!--
                				<h5 id="adoption-count">5 Adoptions</h5>
                				<h5 id="peerreview-count">3 Peer Reviews</h5>
                				-->
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