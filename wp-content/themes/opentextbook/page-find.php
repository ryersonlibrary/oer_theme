<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
?>
<section id="discovery" class="whitebox">
	<div class="container">
    	<div class="content row">
        	<div id="discovery-box" class="col-lg-12 col-md-12">
            	<div id="discovery-interface" class="col-lg-3 col-md-3">
                	<h4>Find a Textbook</h4>
                	<div id="discovery-keyword">
                		<input type="text" value="" id="discovery-keyword-term" placeholder="AUTHOR OR KEYWORD">
                	</div>
                	<div id="discovery-facets">
                    	<h5>Subject</h5>
                    	<ul id="discovery-ui-subject" data-param="subject">
                    		<li data-term="" class="subjectfacet">All Subjects</li>
                    	</ul>
                    	<p class="showmore" id="discovery-moresubjects">Show 5 More Subjects</p>
                    	<h5>Type</h5>
                    	<ul id="discovery-ui-type" data-param="type">
                    		<li data-term="" class="typefacet">All Types</li>
                    		<li data-term="reader" class="typefacet">Course Readers</li>
                    		<li data-term="instruction" class="typefacet">Instructions</li>
    	               		<li data-term="lesson" class="typefacet">Lesson Plans</li>
                    	</ul>
                    	<h5>Education Level</h5>
                    	<ul id="discovery-ui-level" data-param="level">
                    		<li data-term="" class="levelfacet">All Levels</li>
                    		<li data-term="primary" class="levelfacet">Primary</li>
                    		<li data-term="secondary" class="levelfacet">Secondary</li>
    	               		<li data-term="postsecondary" class="levelfacet">Post-Secondary</li>
                    	</ul>
                    	<h5>Language</h5>
                    	<ul id="discovery-ui-language" data-param="language">
                    		<li data-term="" class="languagefacet">English and French</li>
                    		<li data-term="en" class="languagefacet">English</li>
    	               		<li data-term="fr" class="languagefacet">French</li>
                    	</ul>
                    	<h5>Date of Creation</h5>
                    	<ul id="discovery-ui-date" data-param="date">
                    		<li data-term="" class="createdfacet">Any Date</li>
                    		<li data-term="3months" class="createdfacet">Past 3 Months</li>
                    		<li data-term="year" class="createdfacet">Past Year</li>
    	               		<li data-term="5years" class="createdfacet">Past Five Years</li>
                    	</ul>
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
                	</div>
                	<div id="discovery-controls">
                		<span id="discovery-submit-btn" class="btn">Submit</span>
                		<span id="discovery-reset-btn" class="btn">Reset and Start Again</span>
                	</div>
            	</div>
            	<div id="discovery-results" class="col-lg-9 col-md-9">
                	<div id="results-header" class="col-lg-10 col-md-10 col-md-offset-1">
                		<h3>Displaying <span class="searchterm" id="search-limitations"></span> items <span class="searchterm" id="search-subject"></span> <span class="searchterm" id="search-keyword"></span> <span class="searchterm" id="search-created"></span></h3>
                	</div>
                	<div id="results-box" class="col-lg-12 col-md-12">
                    	<div id="results-prev" class="col-lg-1 col-md-1">
                    		<span class="catalogue-results-nav">&lt;</span>
                    	</div>
                    	<div id="results" class="col-lg-10 col-md-10">
                        	<div id="results-list" class="results-row col-lg-12 col-md-12">

                    		</div>
                    	</div>
                    	<div id="results-next" class="col-lg-1 col-md-1">
                    		<span class="catalogue-results-nav">&gt;</span>
                    	</div>
                	</div>
                	<div id="results-footer" class="col-lg-12 col-md-12">
                		<div id="results-pagecounter" class="col-lg-12 col-md-12">
                			<p id="results-pagecounter-pages"><span class="resultspage" id="resultspage-1">1</span><span class="resultspage" id="resultspage-2">2</span></p>
                		</div>
                		<div id="results-counterdetails" class="col-lg-12 col-md-12">
                			<p>Showing <span id="results-counter-thispage">1</span> of <span id="results-counter-totalpages">5</span> of <span id="results-counter-totalresults">20</span> Results</p>
                		</div>
                	</div>
            	</div>
            </div>
		</div>
	</div>
</section>
<section id="page-footer" class="bgimg-2 bgbox">
    <div class="container">
    	<div class="content row"></div>
	</div>
</section>