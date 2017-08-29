<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Opentextbook Publisher
 */
?>

	</div><!-- #content -->

	<section id="main-footer">
	<div class="container">
	<div class="row"><?php if ( is_active_sidebar( 'footer' ) ) :
    dynamic_sidebar( 'footer' );
    endif; //#footer?></div>
    </div>
    </section>
    <footer id="credits-footer">
    	<div class="container"><div id="credits-pressbooks" class="col-sm-8 col-sm-offset-2 col-xs-10"  id="credit">Powered by <a href="https://pressbooks.com">Pressbooks</a> | Learn More</div>
    	<div id="credits-social-icons" class="col-xs-2"><a href="https://twitter.com/pressbooks" title="@Pressbooks on Twitter" target="_blank"><img src="<?= get_template_directory_uri(); ?>/dist/images/twitter-icon-white.png" id="footer-twitter"></a><a href="https://www.facebook.com/pressbooks2/" title="Pressbooks on Facebook" target="_blank"><img src="<?= get_template_directory_uri(); ?>/dist/images/facebook-icon-white.png" id="footer-facebook"></a></div>
    	</div>
    </footer><!-- .content-info -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
