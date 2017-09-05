<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
?>

<section id="front-educators-section" class="whitebox">
	<div class="container">
    	<div class="content row">
        	<div id="educator-tools" class="row">
        		<div id="educator-header" class="row box-header">
                	<hr>
                	<h2>Tools for Educators</h2>
                	<p>Make an open textbook part of your next course, adapt an existing resource, remix open materials or write your own open textbook.</p>
            	</div>
            	<div class="col-lg-4 col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-3 col-xs-12">
            		<div id="adopt">
            			<hr>
               			<h3>Adopt</h3>
               			<p>Search our collection of open textbooks. This high-quality, curated collection features resources on some of the top subject areas in post-secondary education in Ontario today. Many of the textbooks have been reviewed and vetted by educators across Canada.</p>
               			<p class="footer"><a href="" id="adopt-btn">Find and Adopt</a></p>
               		</div>
               	</div>
            	<div class="col-lg-4 col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-3 col-xs-12">
               		<div id="adapt">
               			<hr>
               			<h3>Adapt</h3>
               			<p>Reuse, remix and repurpose open textbooks to suit your unique teaching needs, take advantage of the open textbook Creative Commons license and customize an open textbook to help your students achieve their learning goals.</p>
               			<p class="footer"><a href="" id="adapt-btn">Find and Adapt</a></p>
                   	</div>
               	</div>
            	<div class="col-lg-4 col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-3 col-xs-12">
               		<div id="create">
               			<hr>
               			<h3>Create</h3>
               			<p>Find all the tools you need to create your very own open learning resources including free publishing tools and support, as well as a way to connect with the growing community of open educational creators and editors.</p>
               			<p class="footer"><a href="" id="create-btn">Start Authoring</a></p>
               		</div>
               	</div>
            </div>
		</div>
	</div>
</section>
<section id="front-getinvolved-section" class="bgimg-2 bgbox">
	<div class="container">
    	<div class="content row">
        	<div id="getinvolved" class="center col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
            	<div id="getinvolved-box" class="row">
            		<div id="getinvolved-header" class="row box-header">
                    	<hr>
                        <h2>Get Involved</h2>
                    	<p>Become part of the global open educational resources (OER) community. The OER movement is playing a central role in making education affordable, putting higher education within reach for more Ontarians. Any individual who has attended college or university knows the financial burden of buying expensive textbooks. Help students and instructors lower the costs of higher education by becoming part of the community today.</p>
                	</div>
                	<div id="findoutmore-box" class="row">
                    	<a href="/educators" id="findoutmore-btn">Find out more</a>
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="front-peerreview-section" class="whitebox">
	<div class="container">
		<div class="content row">
  			<div id="peerreview"  class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
  				<div id="peerreview-header" class="row box-header">
               		<hr>
            		<h2>Peer Review</h2>
            		<p></p>
        		</div>
    	    	<div id="peerreview-box" class="row">
        	    	<div id="peerreview-list" class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            			<h3>Call for Reviewers</h3>
                		<ul>
                			<li>Interested faculty, meet the criteria and become a textbook reviewer.</li>
              		        <li>Instruct in the subject area of the open text.</li>
                    	    <li>Currently teach at a post-secondary institution in Ontario.</li>
                        	<li>Possess a willingness to adopt a high quality open textbook.</li>
                		</ul>
            		</div>
            		<div id="peerreview-logo" class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            			<img src="<?= get_template_directory_uri(); ?>/dist/images/ecampuslogo-white-trans.png">
            		</div>
            		<div id="submitapplication-box" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            			<a href="/contact" id="peerreview-btn">Submit an Application</a>
            		</div>
            	</div>
            </div>
		</div>
     </div>
</section>
<section id="front-openeducation-section"  class="bgimg-3 bgbox">
	<div class="container">
    	<div class="content row">
            <div id="openeducation"class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                <div id="openeducation-box" class="row">
                	<div id="openeducation-header" class="row box-header">
                       	<hr>
                    	<h2>Open Education around the Web</h2>
                	</div>
            		<div id="social-media-box" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
            			<div id="twitterfeed" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            				<h3><img src="<?= get_template_directory_uri(); ?>/dist/images/twitter-icon-green.png" id="openeducation-twitter-logo" alt="" title="Twitter Logo"></h3>
            				<p><a class="twitter-timeline" href="https://twitter.com/eCampusOntario">Tweets by eCampusOntario</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script></p>
            				<a href="https://twitter.com/eCampusOntario" id="twitter-btn">Visit our Twitter Feed</a>
        	    		</div>
            			<div id="rssfeed" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            				<h3><img src="<?= get_template_directory_uri(); ?>/dist/images/rss-icon-green.png" id="openeducation-rss-logo" alt="" title="RSS Logo"></h3>
            				<?php
echo do_shortcode( '[wp_rss_aggregator limit="10" links_before=\'<ul class="rss-aggregator">\' link_before=\'<li class="feed-item-link">\']' );
?>
            				<a href="https://www.diigo.com/rss/profile/Clintlalonde/open?query=%23open&sort=updated" id="rss-btn">Subscribe to our RSS Feed</a>
            			</div>
            		</div>
                </div>
            </div>
		</div>
	</div>
</section>