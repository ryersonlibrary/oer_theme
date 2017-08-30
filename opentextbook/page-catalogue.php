<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
?>
<section id="discovery-section" class="whitebox">
	<div class="container">
    	<div class="content row">
        	<div id="discovery" class="row">
            	<div id="discovery-interface" data-widget='discovery-controller' class="col-lg-3 col-md-3 col-sm-3" data-controller-criteria>
                	<h4>Find a Textbook</h4>
                	<div id="discovery-keyword" class='facet' data-facet data-op='setSearchTerm' data-param='%%|contains' data-ui-type="textfield">
                		<input id='search-value' data-user-input type="text" value="<?php if(isset($_GET['quick-search-term'])){ echo urldecode($_GET['quick-search-term']);}?>" id="discovery-keyword-term" placeholder="Author or Keyword" data-value>
                	</div>
                	<div id="discovery-facets">
                  	  <div id="discovery-ui-subject" class='facet' data-facet data-op='setQueryParameter' data-values="dc:subject|%%" data-ui-type="list">
                      	<h5 class='facet-title'>Subject</h5>
                      	<ul data-user-input-wrapper>
                      		<li data-value="*">All Subjects</li>
                      	</ul>
                      	<p class="showmore" id="discovery-moresubjects">Show 5 More Subjects</p>
                  	  </div>
                    	<!--
                    	<h5>Type</h5>
                    	<ul id="discovery-ui-type" data-param="type">
                    		<li data-term="" class="typefacet">All Types</li>
                    		<li data-term="reader" class="typefacet">Course Readers</li>
                    		<li data-term="instruction" class="typefacet">Instructions</li>
    	               		<li data-term="lesson" class="typefacet">Lesson Plans</li>
                    	</ul>
                    	<h5>Education Level</h5>
                    	<ul id="discovery-ui-level" data-param="level">
                    		<li data-term=""t class="levelfacet">All Levels</li>
                    		<li data-term="primary" class="levelfacet">Primary</li>
                    		<li data-term="secondary" class="levelfacet">Secondary</li>
    	               		<li data-term="postsecondary" class="levelfacet">Post-Secondary</li>
                    	</ul>
                    	-->
                  	  <div id="discovery-ui-language" class='facet' data-facet data-op='setQueryParameter' data-param="dc:language.iso|%%" data-ui-type="list">
                      	<h5 class='facet-title'>Language</h5>
                      	<ul data-user-input-wrapper>
                      		<li data-value="*">English and French</li>
                      		<li data-value="en">English</li>
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
                  <div data-controller-item-limit='6' data-controller-current-page='1' data-controller-paginator>
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
                			<p id="results-pagecounter-pages" data-controller-pagebtns><span class="resultspage" id="resultspage-1">%%</span></p>
                		</div>
                		<div id="results-counterdetails" class="row">
                			<p>Showing <span id="results-counter-thispage" data-controller-visible-results>1</span> of <span id="results-counter-totalpages">5</span> of <span id="results-counter-totalresults" data-controller-total-results>20</span> Results</p>
                		</div>
                	</div>
                  </div>
            	</div>
            </div>
		</div>
	</div>
</section>
<section id="page-footer-section" class="bgimg-2 bgbox">
    <div class="container">
    	<div class="content row"></div>
	</div>
</section>