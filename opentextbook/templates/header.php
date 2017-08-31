<header id="main-header" class="<?php if(is_page('find') || is_page('catalogue') || is_page('preview')){ print "librarybg";}?> bgimg-1 bgbox">
  <div class="container">
  <img src="<?= get_template_directory_uri(); ?>/dist/images/ecampus_logo_dark.png" id="headerlogo">
	<?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
		<div id="site-header-menu" class="site-header-menu">
			<div id="site-header-menu-mobile-btn">
				<img src="<?= get_template_directory_uri(); ?>/dist/images/mobile-nav-icon.png">
			</div>
			<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu'); ?>">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'primary-menu',
						'menu_class'     => 'primary-menu',
					 ) );
				?>
			</nav><!-- .main-navigation -->
			<div id="social-controls">
				<a href="/catalogue/"><img src="<?= get_template_directory_uri(); ?>/dist/images/search-icon-yellow.png" class="icon"></a>
				<a href="http://www.twitter.com/ecampusontario" target="_blank"><img src="<?= get_template_directory_uri(); ?>/dist/images/twitter-icon-dark.png" class="icon"></a>
				<a href="https://www.facebook.com/ecampusontario/" target="_blank"><img src="<?= get_template_directory_uri(); ?>/dist/images/facebook-icon-dark.png" class="icon"></a>
				<a href="https://ca.linkedin.com/company/ecampusontario" target="_blank"><img src="<?= get_template_directory_uri(); ?>/dist/images/linkedin-icon-dark.png" class="icon"></a>
				<a href="https://www.youtube.com/channel/UCwVGE7c6gCnNpxV2OLzJQEg" target="_blank"><img src="<?= get_template_directory_uri(); ?>/dist/images/youtube-icon-dark.png" class="icon"></a>
			</div>
		</div><!-- .site-header-menu -->
	<?php endif; ?>
	</div>
	<?php $showquicksearch=false;
	$showquicksearchon=array('educators','learners');
	if( is_front_page() ):
	    $showquicksearch=true;
	endif;
	foreach($showquicksearchon as $quicksearchpage){
	    if(is_page($quicksearchpage)){
	        $showquicksearch=true;
	    }
	}
if( $showquicksearch ): ?>
	<div id="front-interface" class="container">
		<div class="content row">
		<?php if( is_front_page() ):?>
      		<div id="ecampus-openlibrary-title" class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
          		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          			<img src="<?= get_template_directory_uri(); ?>/dist/images/ecampus-elogo.png" id="titlelogo">
          		</div>
           		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
           			<h2>eCampusOntario</h2>
           			<h1>Open Library</h1>
           		</div>
           	</div>
           	<?php endif;?>
           	<div id="quick-search" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
           		<div id="quick-searchbox" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
           			<form action="/catalogue/" method="get" id="quick-search">
           				<input value="" id="quick-search-term" name="quick-search-term" placeholder="SEARCH FOR TEXTBOOKS BY TITLE, AUTHOR AND KEYWORD" type="text">
           				<img id="quick-search-btn" src="<?= get_template_directory_uri(); ?>/dist/images/search-icon-dark.png" title="quick search for this term">
           			</form>
           		</div>
           		<div id="quick-browsebox" class="col-lg-3 col-lg-push-1 col-md-3 col-md-push-1 col-sm-12 col-xs-12">
           			<a href="/catalogue/" class="btn btn-primary" id="browse-btn">Browse the Catalogue</a>
           		</div>
           	</div>
    	</div>
	</div>
<?php elseif(is_page('find')):?>
    <div id="maintitle" class="container">
    	<div class="content row">
    		<div id="discovery-title" class="row">
           		<h1>Open Library Catalogue</h1>
           		<p>Your home for finding free and open educational resources to support your higher education goals</p>
           	</div>
      	</div>
    </div>
<?php elseif(is_page('catalogue')):?>
    <div id="maintitle" class="container">
    	<div class="content row">
    		<div id="discovery-title" class="row">
           		<h1>Open Library Catalogue</h1>
           		<p>Your home for finding free and open educational resources to support your higher education goals</p>
           	</div>
      	</div>
    </div>
<?php elseif(is_page('preview')):?>
    <div id="maintitle" class="container">
    	<div class="content row">
    		<div id="preview-header" class="row">
           		<h1 id="textbook-title"></h1>
           		<h3 id="textbook-title-authors"></h3>
				<div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
               		<div id="read-versions" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
               			<span class="btn" id="download-btn">Download and Read ▼</span>
               			<div id="available-versions" style="display: none;">
               				<ul></ul>
               			</div>
               		</div>
               		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                   		<a href="" class="btn" id="print-btn">Order Print Version</a>
                   	</div>
			    </div>
               	<div id="textbook-social-media" class="col-lg-2 col-md-2 col-lg-offset-5 col-md-offset-5 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
               		<a href="http://www.twitter.com" target="_blank"><img src="<?= get_template_directory_uri(); ?>/dist/images/twitter-icon-dark.png" class="icon" title="Tweet about this textbook!"></a>
				<a href="http://www.facebook.com" target="_blank"><img src="<?= get_template_directory_uri(); ?>/dist/images/facebook-icon-dark.png" class="icon" title="Share this textbook!"></a>
               	</div>
               	<div id="textbook-read-description" class="col-lg-2 col-md-2 col-lg-offset-5 col-md-offset-5 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
               	&#129123;
               	</div>
           	</div>
      	</div>
    </div>
<?php endif;?>
</header>
