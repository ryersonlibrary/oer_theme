<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
?>
<section id="discovery-section" class="whitebox">
	<div class="container">
    	<div class="content row">
        	<div id="discovery" class="row">
          	
          	  <!-- Discovery UI: Criteria Selection Controller -->
          	
            	<div id="discovery-interface" data-widget='discovery-controller' class="col-lg-3 col-md-3 col-sm-3" data-controller-criteria>
              	<h4>Find a Textbook</h4>
              	<div id="discovery-keyword" class='facet' data-facet data-op='setSearchTerm' data-param='%%|matches' data-ui-type="textfield">
              		<input id='search-value' data-user-input type="text" value="<?php if(isset($_GET['quick-search-term'])){ echo urldecode($_GET['quick-search-term']);}?>" id="discovery-keyword-term" placeholder="Author or Keyword" data-value>
              	</div>
              	<div id="discovery-facets">
                	  <div id="discovery-ui-subject" class='facet' data-facet data-op='setQueryParameter' data-values="dc:subject|%%" data-ui-type="list">
                    	<h5 class='facet-title'>Subject</h5>
                    	<ul data-user-input-wrapper>
                    		<li data-value="*">All Subjects</li>
                    		<li data-value='Accessibility'>Accessibility</li>
                        <li data-value='Applied Science'>Applied Science</li>
                        <li data-value='Baking'>Baking</li>
                        <li data-value='Book'>Book</li>
                        <li data-value='Business communication'>Business communication</li>
                        <li data-value='Calculus'>Calculus</li>
                        <li data-value='Canada'>Canada</li>
                        <li data-value='Chemistry'>Chemistry</li>
                        <li data-value='Commercial statistics'>Commercial statistics</li>
                        <li data-value='Computer art'>Computer art</li>
                        <li data-value='Culture'>Culture</li>
                        <li data-value='Desserts'>Desserts</li>
                        <li data-value='Differential equations'>Differential equations</li>
                        <li data-value='Electrical engineering'>Electrical engineering</li>
                        <li data-value='Engineering'>Engineering</li>
                        <li data-value='English language'>English language</li>
                        <li data-value='Farming'>Farming</li>
                        <li data-value='Fluid mechanics'>Fluid mechanics</li>
                        <li data-value='Food service'>Food service</li>
                        <li data-value='French language'>French language</li>
                        <li data-value='Graphic design'>Graphic design</li>
                        <li data-value='History'>History</li>
                        <li data-value='Indians of North America'>Indians of North America</li>
                        <li data-value='Information resources management'>Information resources management</li>
                        <li data-value='Keyword'>Keyword</li>
                        <li data-value='Laxton'>Laxton</li>
                        <li data-value='Literature'>Literature</li>
                        <li data-value='Mass media'>Mass media</li>
                        <li data-value='Medical personnel'>Medical personnel</li>
                        <li data-value='Medival'>Medival</li>
                        <li data-value='Meteorology'>Meteorology</li>
                        <li data-value='Microbiology'>Microbiology</li>
                        <li data-value='Non-governmental organizations'>Non-governmental organizations</li>
                        <li data-value='OER'>OER</li>
                        <li data-value='Open source software'>Open source software</li>
                        <li data-value='Open Textbooks'>Open Textbooks</li>
                        <li data-value='Pastry'>Pastry</li>
                        <li data-value='Patient care'>Patient care</li>
                        <li data-value='Personnel management'>Personnel management</li>
                        <li data-value='Philosophy, Modern'>Philosophy, Modern</li>
                        <li data-value='Physical geology'>Physical geology</li>
                        <li data-value='Physics'>Physics</li>
                        <li data-value='Police ethics'>Police ethics</li>
                        <li data-value='Pressbooks'>Pressbooks</li>
                        <li data-value='Psychology'>Psychology</li>
                        <li data-value='Social media'>Social media</li>
                        <li data-value='Social psychology'>Social psychology</li>
                        <li data-value='Teaching'>Teaching</li>
                    	</ul>
                	  </div>
                	  <div id="discovery-ui-language" class='facet' data-facet data-op='setQueryParameter' data-param="dc:language.iso|%%" data-ui-type="list">
                    	<h5 class='facet-title'>Language</h5>
                    	<ul data-user-input-wrapper>
                    		<li data-value="*">English and French</li>
                    		<li data-value="en" data-default-value>English</li>
    	               		<li data-value="fr">French</li>
                    	</ul>
                	  </div>
                	  <div id="discovery-ui-date"  class='facet' data-facet data-op='setQueryParameter' data-param="dc:date.issued|%%" data-ui-type="list">
                    	<h5 class='facet-title'>Date of Creation</h5>
                    	<ul data-user-input-wrapper>
                  		<li data-value="*" class="createdfacet">Any Date</li>
                  		<li data-value="<?php print (time() - (90 * 24 * 60 * 60)); ?>">Past 3 Months</li>
                  		<li data-value="<?php print (time() - (365 * 24 * 60 * 60)); ?>">Past Year</li>
  	               		<li data-value="<?php print (time() - (5 * 365 * 24 * 60 * 60)); ?>">Past Five Years</li>
                    	</ul>
                	  </div>

                	  <!--
                  	<h5>Peer Review <img class="icon" src="<?= get_template_directory_uri(); ?>/dist/images/ui-star-dark.svg"></h5>
                  	<ul id="discovery-ui-peerreview" data-param="peerreview">
                  		<li data-term="" class="peerreviewfacet">Reviewed and Unreviewed</li>
                  		<li data-term="mostreviewed" class="peerreviewfacet">Most Reviewed</li>
                  		<li data-term="reviewed" class="peerreviewfacet">Reviewed Items Only</li>
  	               		<li data-term="unreviewed" class="peerreviewfacet">Unreviewed Items Only</li>
                  	</ul>
                  	<h5>Adoption Status</h5>
                  	<ul id="discovery-ui-source" data-param="source">
                  		<li data-term="" class="adoptionfacet">Adopted and Unadopted</li>
                  		<li data-term="mostadopted" class="adoptionfacet">Most Adopted</li>
                  		<li data-term="adopted" class="adoptionfacet">Adopted Items Only</li>
  	               		<li data-term="unadopted" class="adoptionfacet">Unadopted Items Only</li>
                  	</ul>
                  	<h5>Conditions of Use</h5>
                  	<ul id="discovery-ui-rights" data-param="rights">
                  		<li data-term="" class="usefacet">All Usage Conditions</li>
                  		<li data-term="nsa" class="usefacet">No Strings Attached</li>
                  		<li data-term="remixshare" class="usefacet">Remix and Share</li>
  	               		<li data-term="share" class="usefacet">Share Only</li>
                  	</ul>
                  	-->
              	</div>
              	<div id="discovery-controls">
              		<span id="discovery-submit-btn" class="btn" data-submit>Submit</span>
              		<span id="discovery-reset-btn" class="btn" data-reset>Reset and Start Again</span>
              	</div>
            	</div>
      
              <!-- Criteria Selection Controller End -->
              
              <!-- Discovery UI: Results View -->

            	<div id="discovery-results" class="col-lg-9 col-md-9 col-sm-9" data-view-results>
              	  <div id="results-templates"  style='display: none' data-view-templates>
                	  <div data-view-template-name='book_capsule' data-view-template-wrapper>
                  	  <div class="result-item col-lg-3 col-md-4 col-sm-6 col-xs-6">
                    	  <span id="%%uuid%%" class="textbook"><span id="%%uuid%%-cover" class="textbook-cover"></span>
                    	  <p class="textbook-header">%%subjects%%</p><h4 class="textbook-title">%%dc.title%%</h4>
                    	  <p class="textbook-authors">%%byline%%</p>
                    	  <p class="textbook-footer"><a href="preview/?id=%%uuid%%'" title='About this book'>About this book</a></p>
                	    </div>
                	  </div>
                	  <div data-view-template-name='new_book_capsule' data-view-template-wrapper>
                  	  <div class="result-item create-new-item col-lg-3 col-md-4 col-sm-6 col-xs-6">
                    	  <span id="new-textbook" class="textbook"><span class="textbook-cover"></span>
                    	  <p class="textbook-header">&nbsp;</p>
                    	  <h4 class="textbook-title">Create your own textbook</h4>
                    	  <p class="textbook-authors">Add a text to this (or any) topic.</p>
                    	  <p class="textbook-footer"><a id="start-authoring-btn" href="" class="btn btn-secondary">Start Authoring</a></p></span>
                      </div>
                	  </div>
                  </div>
                	<div id="results-header" class="row">
                		<h3 data-view-title-stage>Displaying <span class="searchterm" id="search-limitations"></span> items <span class="searchterm" id="search-subject"></span> <span class="searchterm" id="search-keyword"></span> <span class="searchterm" id="search-created"></span></h3>
                	</div>
                	                	
                	<!-- Discovery UI: Pagination Controller -->
                	
                  <div data-widget='discovery-controller' data-controller-item-limit='6' data-controller-current-page='1' data-controller-paginator>
                	  <div id="results-box" class="row">
                    	<div id="results-prev" class="col-lg-1 col-md-1">
                    		<span id="results-prev-btn" class="catalogue-results-nav" data-controller-previous>&lt;</span>
                    	</div>
                    	<div id="results" class="col-lg-10 col-md-10 col-sm-12">
                      	<div id="results-list" class="results-row row" data-view-stage>

                  		  </div>
                    	</div>
                    	<div id="results-next" class="col-lg-1 col-md-1">
                    		<span id="results-next-btn" class="catalogue-results-nav" data-controller-next>&gt;</span>
                    	</div>
                	  </div>
                	  <div id="results-footer" class="row">
                		<div id="results-more" class="row">
                    		<span id="results-more-btn" class="btn">View More</span>
                    </div>
                		<div id="results-pagecounter" class="row" >
                			<p id="results-pagecounter-pages" data-controller-pagebtns><a href='#' class="resultspage" data-pageref='%%' title='Show page %% of results' data-controller-pagebtn>%%</a></p>
                		</div>
                		<div id="results-counterdetails" class="row">
                			<p>Showing <span id="results-counter" data-controller-current-range></span> of <span id="results-counter-totalresults" data-controller-total-results></span> Results</p>
                		</div>
                	</div>
                </div>
                
                <!-- Pagination Controller End -->
                
            	</div>
            	
              <!-- Results View End -->

            </div>
		</div>
	</div>
</section>
<section id="page-footer-section" class="bgimg-2 bgbox">
    <div class="container">
    	<div class="content row"></div>
	</div>
</section>