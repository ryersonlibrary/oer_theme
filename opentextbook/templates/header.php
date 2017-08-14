<header id="main-header" class="bgimg-1 bgbox">
  <div class="container">
  <img src="<?= get_template_directory_uri(); ?>/dist/images/ecampus_logo_dark.png" id="headerlogo">
	<?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
		<div id="site-header-menu" class="site-header-menu">
			<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu'); ?>">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'primary-menu',
						'menu_class'     => 'primary-menu',
					 ) );
				?>
			</nav><!-- .main-navigation -->
			<div id="social-controls">
				<img src="<?= get_template_directory_uri(); ?>/dist/images/search-icon-yellow.png" class="icon">
				<img src="<?= get_template_directory_uri(); ?>/dist/images/twitter-icon-dark.png" class="icon">
				<img src="<?= get_template_directory_uri(); ?>/dist/images/facebook-icon-dark.png" class="icon">
				<img src="<?= get_template_directory_uri(); ?>/dist/images/linkedin-icon-dark.png" class="icon">
				<img src="<?= get_template_directory_uri(); ?>/dist/images/youtube-icon-dark.png" class="icon">
			</div>
		</div><!-- .site-header-menu -->
	<?php endif; ?>
	</div>
	<?php $showquicksearch=false;
	$showquicksearchon=array('educators','learners','catalogue');
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
      		<div id="ecampus-openlibrary-title" class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
          		<div class="col-lg-4 col-md-4">
          			<img src="<?= get_template_directory_uri(); ?>/dist/images/ecampus-elogo.png" id="titlelogo">
          		</div>
           		<div class="col-lg-8 col-md-8">
           			<h2>eCampusOntario</h2>
           			<h1>Open Library</h1>
           		</div>
           	</div>
           	<?php endif;?>
           	<div id="quick-search" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
           		<div id="quick-searchbox" class="col-lg-8 col-md-8">
           			<input value="" placeholder="SEARCH FOR TEXTBOOKS BY TITLE, AUTHOR AND KEYWORD" type="text">
           			<img src="<?= get_template_directory_uri(); ?>/dist/images/search-icon-dark.png">
           		</div>
           		<div class="col-lg-3 col-lg-push-1 col-md-3 col-md-push-1">
           			<a href="" class="btn btn-primary" id="browse-btn">Browse the Catalogue</a>
           		</div>
           	</div>
    	</div>
	</div>
<?php elseif(is_page('find')):?>
    <div id="maintitle" class="container">
    	<div class="content row">
    		<div id="discovery-title" class="col-lg-12 col-md-12">
           		<h1>Open Library Catalogue</h1>
           		<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
           	</div>
      	</div>
    </div>
<?php elseif(is_page('preview')):?>
    <div id="maintitle" class="container">
    	<div class="content row">
    		<div id="preview-header" class="col-lg-12 col-md-12">
           		<h1 id="textbook-title">Open Library Catalogue</h1>
           		<h3 id="textbook-title-authors"></h3>
               	<div class="col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2">
               		<span class="btn" id="download-btn">Download and Read &#9660;</span>
               		<a href="" class="btn" id="print-btn">Order Print Version</a>
               	</div>
           	</div>
      	</div>
    </div>
<?php endif;?>
</header>
