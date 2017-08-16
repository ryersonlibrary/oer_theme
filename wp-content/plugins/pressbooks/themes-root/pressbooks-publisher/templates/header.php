<header id="main-header">
  <div class="container">
  <img src="/wp-content/uploads/2017/07/ecampus_logo_dark.png" id="headerlogo">
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
		</div><!-- .site-header-menu -->
	<?php endif; ?>
	</div>
</header>
