<?php
use Roots\Sage\Assets;

function opentextbook_publisher_admin_scripts($hook) {
    if ( 'sites.php' !== $hook ) {
        return;
    }

    wp_enqueue_script( 'opentextbook-publisher-admin', Assets\asset_path( 'scripts/catalog-admin.js' ), array('jquery'), '20150527' );
	wp_localize_script( 'opentextbook-publisher-admin', 'PB_Publisher_Admin', array(
		'publisherAdminNonce' => wp_create_nonce( 'opentextbook-publisher-admin' ),
		'catalog_updated' => __( 'Catalog updated.', 'opentextbook' ),
		'catalog_not_updated' => __( 'Sorry, but your catalog was not updated. Please try again.', 'opentextbook' ),
		'dismiss_notice' => __( 'Dismiss this notice.', 'opentextbook' ),
	));
}

add_action( 'admin_enqueue_scripts', 'opentextbook_publisher_admin_scripts' );

function opentextbook_publisher_update_catalog() {
	$blog_id = absint( $_POST['book_id'] );
	$in_catalog = $_POST['in_catalog'];

	if ( current_user_can( 'manage_network' ) && check_ajax_referer( 'opentextbook-publisher-admin' ) ) {
		if ( $in_catalog == 'true' ) {
			update_blog_option( $blog_id, 'opentextbook_publisher_in_catalog', 1 );
		} else {
			delete_blog_option( $blog_id, 'opentextbook_publisher_in_catalog' );
		}
	}
}

add_action( 'wp_ajax_opentextbook_publisher_update_catalog', 'opentextbook_publisher_update_catalog' );

function opentextbook_publisher_catalog_columns( $columns ) {
	$columns[ 'in_catalog' ] = __( 'In Catalog', 'opentextbook' );
	return $columns;
}

add_filter( 'wpmu_blogs_columns', 'opentextbook_publisher_catalog_columns' );

function opentextbook_publisher_catalog_column( $column, $blog_id ) {

	if ( 'in_catalog' == $column && ! is_main_site( $blog_id ) ) { ?>
		<input class="in-catalog" type="checkbox" name="in_catalog" value="1" <?php checked( get_blog_option( $blog_id, 'opentextbook_publisher_in_catalog' ), 1 ); ?> <?php
		if ( ! get_blog_option( $blog_id, 'blog_public' ) ) { ?>disabled="disabled" title="<?php _e( 'This book is private, so you can&rsquo;t display it in your catalog.', 'opentextbook' ); ?>"<?php } ?> />
	<?php }

}

add_action( 'manage_blogs_custom_column', 'opentextbook_publisher_catalog_column', 1, 3 );
add_action( 'manage_sites_custom_column', 'opentextbook_publisher_catalog_column', 1, 3 );
