<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
?>
<section id="post-<?php the_ID(); ?>-section" <?php post_class('whitebox'); ?>>
	<div class="container">
    	<div class="content row">
      		<div id="post-<?php the_ID(); ?>"  class="page-content col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
            	<div id="post-<?php the_ID(); ?>-header" class="row box-header">
            		<hr>
            		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
            	</div>
            	<div id="post-<?php the_ID(); ?>-box" class="entry-content">
					<?php the_content();?>
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