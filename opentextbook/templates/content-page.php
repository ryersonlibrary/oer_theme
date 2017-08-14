<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
?>
<section id="post-<?php the_ID(); ?>-section" <?php post_class('whitebox'); ?>>
	<div class="container">
    	<div class="content row">
      		<div id="post-<?php the_ID(); ?>"  class="page-content col-md-10 col-md-offset-1">
            	<hr>
            	<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
            	<div id="post-<?php the_ID(); ?>-box" class="entry-content">
					<?php the_content();?>
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