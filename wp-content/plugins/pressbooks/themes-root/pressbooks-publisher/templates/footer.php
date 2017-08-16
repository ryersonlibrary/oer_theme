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
	<div class="container"><?php if ( is_active_sidebar( 'footer' ) ) :
    dynamic_sidebar( 'footer' );
    endif; //#footer?>

    <div class="link-wrap">
    		<?php if ( is_user_logged_in() ) {
    			if ( is_super_admin() || is_user_member_of_blog() ) { ?>
    				<a href="<?php echo get_option( 'home' ); ?>/wp-admin" class="btn btn-primary btn-sm"><?php _e( 'Admin', 'opentextbook' ); ?></a>
    			<?php }
    			$user_info = get_userdata( get_current_user_id() );
    			if ( $user_info->primary_blog ) { ?>
    				<a href="<?php echo get_blogaddress_by_id( $user_info->primary_blog ); ?>wp-admin/index.php?page=pb_catalog" class="btn btn-primary btn-sm"><?php _e( 'My Books', 'opentextbook' ); ?></a>
    			<?php } ?>
    			<a href="<?php echo wp_logout_url(); ?>" class="btn btn-primary btn-sm"><?php _e( 'Sign Out', 'opentextbook' ); ?></a>
    		<?php }elseif ( ! is_user_logged_in() ) { ?>
    		<?php if ( class_exists( '\PressbooksOAuth\OAuth' ) ) {
    			do_action( 'pressbooks_oauth_connect' );
    		}	else { ?>
    			<a href="<?php echo wp_login_url( get_option( 'home' ) ); ?>" class="button"><?php _e( 'Sign In', 'opentextbook' ); ?></a>
    			<?php if ( get_option( 'users_can_register' ) ) { ?>
    				<a class="button" href="<?php echo esc_url( wp_registration_url() ); ?>"><?php _e( 'Register' ); ?></a>
    			<?php }
    		} ?>
    	<?php } ?>
    	</div>
    </div>
    </section>
    <footer id="credits-footer">
    	<div class="container"><div class="col-lg-11 col-md-11">Powered by <a href="https://pressbooks.com">Pressbooks</a> | Learn More</div>
    	<div class="col-lg-1 col-md-1"><img src="@asset('images/twitter-white.png')" id="footer-twitter"><img src="@asset('images/facebook-white.png')" id="footer-facebook"></div>
    	</div>
    </footer><!-- .content-info -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
