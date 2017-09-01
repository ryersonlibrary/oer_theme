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
              	<div id="discovery-keyword" class='facet' data-facet data-op='setSearchTerm' data-param='%%|matches' data-ui-type="textfield" data-label='containing the term %%' data-label-plural='containing the Terms %%' data-label-position='after'>
              		<input id='search-value' data-user-input type="text" value="<?php if(isset($_GET['quick-search-term'])){ echo urldecode($_GET['quick-search-term']);}?>" id="discovery-keyword-term" placeholder="Author or Keyword" data-value>
              	</div>
              	<div id="discovery-facets">
                	  <div id="discovery-ui-subject" class='facet' data-facet data-op='setQueryParameter' data-param="dc:subject|%%" data-ui-type="list" data-label='with the subject %%' data-label-plural='with the subjects %%' data-label-position='after'>
                    	<h5 class='facet-title'>Subject</h5>
                    	<ul data-user-input-wrapper>
                    		<li data-value="*"><a title="Select All Subjects">All Subjects</a></li>
                    		<li data-value='Accessibility'><a title="Select Accessibility">Accessibility</a></li>
                        <li data-value='Applied Science'><a title="Select Applied Science">Applied Science</a></li>
                        <li data-value='Baking'><a title="Select Baking">Baking</a></li>
                        <li data-value='Book'><a title="Select Book">Book</a></li>
                        <li data-value='Business communication'><a title="Select Business communication">Business communication</a></li>
                        <li data-value='Calculus'><a title="Select Calculus">Calculus</a></li>
                        <li data-value='Canada'><a title="Select Canada">Canada</a></li>
                        <li data-value='Chemistry'><a title="Select Chemistry">Chemistry</a></li>
                        <li data-value='Commercial statistics'><a title="Select Commercial statistics">Commercial statistics</a></li>
                        <li data-value='Computer art'><a title="Select Computer art">Computer art</a></li>
                        <li data-value='Culture'><a title="Select Culture">Culture</a></li>
                        <li data-value='Desserts'><a title="Select Desserts">Desserts</a></li>
                        <li data-value='Differential equations'><a title="Select Differential equations">Differential equations</a></li>
                        <li data-value='Electrical engineering'><a title="Select Electrical engineering">Electrical engineering</a></li>
                        <li data-value='Engineering'><a title="Select Engineering">Engineering</a></li>
                        <li data-value='English language'><a title="Select English language">English language</a></li>
                        <li data-value='Farming'><a title="Select Farming">Farming</a></li>
                        <li data-value='Fluid mechanics'><a title="Select Fluid mechanics">Fluid mechanics</a></li>
                        <li data-value='Food service'><a title="Select Food service">Food service</a></li>
                        <li data-value='French language'><a title="Select French language">French language</a></li>
                        <li data-value='Graphic design'><a title="Select Graphic design">Graphic design</a></li>
                        <li data-value='History'><a title="Select History">History</a></li>
                        <li data-value='Indians of North America'><a title="Select Indians of North America">Indians of North America</a></li>
                        <li data-value='Information resources management'><a title="Select Information resources management">Information resources management</a></li>
                        <li data-value='Keyword'><a title="Select Keyword">Keyword</a></li>
                        <li data-value='Laxton'><a title="Select Laxton">Laxton</a></li>
                        <li data-value='Literature'><a title="Select Literature">Literature</a></li>
                        <li data-value='Mass media'><a title="Select Mass media">Mass media</a></li>
                        <li data-value='Medical personnel'><a title="Select Medical personnel">Medical personnel</a></li>
                        <li data-value='Medieval'><a title="Select Medieval">Medieval</a></li>
                        <li data-value='Meteorology'><a title="Select Meteorology">Meteorology</a></li>
                        <li data-value='Microbiology'><a title="Select Microbiology">Microbiology</a></li>
                        <li data-value='Non-governmental organizations'><a title="Select Non-governmental organizations">Non-governmental organizations</a></li>
                        <li data-value='OER'><a title="Select OER">OER</a></li>
                        <li data-value='Open source software'><a title="Select Open source software">Open source software</a></li>
                        <li data-value='Open Textbooks'><a title="Select Open Textbooks">Open Textbooks</a></li>
                        <li data-value='Pastry'><a title="Select Pastry">Pastry</a></li>
                        <li data-value='Patient care'><a title="Select Patient care">Patient care</a></li>
                        <li data-value='Personnel management'><a title="Select Personnel management">Personnel management</a></li>
                        <li data-value='Philosophy, Modern'><a title="Select Philosophy, Modern">Philosophy, Modern</a></li>
                        <li data-value='Physical geology'><a title="Select Physical geology">Physical geology</a></li>
                        <li data-value='Physics'><a title="Select Physics">Physics</a></li>
                        <li data-value='Police ethics'><a title="Select Police ethics">Police ethics</a></li>
                        <li data-value='Pressbooks'><a title="Select Pressbooks">Pressbooks</a></li>
                        <li data-value='Psychology'><a title="Select Psychology">Psychology</a></li>
                        <li data-value='Social media'><a title="Select Social media">Social media</a></li>
                        <li data-value='Social psychology'><a title="Select Social psychology">Social psychology</a></li>
                        <li data-value='Teaching'><a title="Select Teaching">Teaching</a></li>
                    	</ul>
                	  </div>
                	  <div id="discovery-ui-language" class='facet' data-facet data-op='setQueryParameter' data-param="dc:language.iso|%%" data-ui-restriction='single' data-ui-type="list" data-label='%%' data-label-position='before'>
                    	<h5 class='facet-title'>Language</h5>
                    	<ul data-user-input-wrapper>
                    		<li data-value="*"><a title="Select English and French">English and French</a></li>
                    		<li data-value="en" data-default-value><a title="Select English">English</a></li>
    	               		<li data-value="fr"><a title="Select French">French</a></li>
                    	</ul>
                	  </div>
                	  <div id="discovery-ui-date"  class='facet' data-facet data-op='setQueryParameter' data-param="dc.date.updated|%%|equals" data-ui-restriction='single' data-ui-type="list"  data-label='updated in the %%' data-label-position='after'>
                    	<h5 class='facet-title'>Date of Creation</h5>
                    	<ul data-user-input-wrapper>
                    		<li data-value="*" class="createdfacet"><a title='Select items created anytime'>Any Date</a></li>
                    		<li data-value="NOW-3MONTHS"><a title="Select items created in the past 3 months">Past 3 Months</a></li>
                    		<li data-value="NOW-1YEAR"><a title="Select items created in the past year">Past Year</a></li>
    	               		<li data-value="NOW-5YEARS"><a title="Select items created in the past five years">Past Five Years</a></li>
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
                  	  <div class="result-item col-lg-3 col-md-4 col-sm-4 col-xs-6">
                    	  <span id="%%uuid%%" class="textbook"><span id="%%uuid%%-cover" class="textbook-cover"></span>
                    	  <p class="textbook-header">%%subjects%%</p><h4 class="textbook-title">%%dc.title%%</h4>
                    	  <p class="textbook-authors">%%byline%%</p>
                    	  <p class="textbook-footer"><a href="preview/?id=%%uuid%%'" title='About this book'>About this book</a></p>
                	    </div>
                	  </div>
                	  <div data-view-template-name='new_book_capsule' data-view-template-wrapper>
                  	  <div class="result-item create-new-item col-lg-3 col-md-4 col-sm-4 col-xs-6">
                    	  <span id="new-textbook" class="textbook"><span class="textbook-cover"></span>
                    	  <p class="textbook-header">&nbsp;</p>
                    	  <h4 class="textbook-title">Create your own textbook</h4>
                    	  <p class="textbook-authors">Add a text to this (or any) topic.</p>
                    	  <p class="textbook-footer"><a id="start-authoring-btn" href="" class="btn btn-secondary">Start Authoring</a></p></span>
                      </div>
                	  </div>
                  </div>
                	<div id="results-header" class="row">

                  	<!-- Discovery UI: View Title Stage-->

                		<h3 data-view-title-term-class='searchterm' data-view-title-prefix='Viewing all' data-view-title-none='Sorry, we can’t find any items that match your selection' data-view-title-label='items' data-view-title-stage></h3>

                		<!-- View Title Stage End -->
                	</div>

                	<!-- Discovery UI: Pagination Controller -->

                  <div data-widget='discovery-controller' data-controller-item-limit='6' data-controller-current-page='1' data-controller-paginator>
                	  <div id="results-box" class="row">
                      		<div id="results-list" class="results-row row" data-view-stage>

                  			</div>
                	  </div>
                	  <div id="results-footer" class="row">
                		<div id="results-more" class="row">
                    		<span id="results-more-btn" class="btn">View More</span>
                    </div>
                		<div id="results-pagecounter" class="row" >

                		<span id="results-prev-btn" class="catalogue-results-nav" data-controller-previous><img src="/wp-content/themes/opentextbook/dist/images/ui-darkbullet-left.png"></span>
                			<span id="results-pagecounter-pages" data-controller-pagebtns>
                				<a href='#' class="resultspage" data-pageref='%%' title='Show page %% of results' data-controller-pagebtn>%%</a>
                			</span>
                			<span id="results-next-btn" class="catalogue-results-nav" data-controller-next><img src="/wp-content/themes/opentextbook/dist/images/ui-darkbullet-right.png"></span>
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