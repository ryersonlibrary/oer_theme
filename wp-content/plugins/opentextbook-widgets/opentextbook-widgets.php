<?php
/**
 * Plugin Name: Opentextbook Widgets
 * Plugin URI:
 * Description: This plugin adds standard widgets for eCampusOntario Opentextbook.
 * Version: 1.0.0
 * Author: Matthew Milner
 * Author URI: http://www.matthewmilner.name
 * License: GPL2
 */

class opentextbook_quicksearch_widget extends WP_Widget {
    function __construct() {
        parent::__construct(

        // Base ID of your widget
            'opentextbook_quicksearch_widget',

            // Widget name will appear in UI
            __('Opentextbook Quicksearch', 'opentextbook'),

            // Widget description
            array( 'description' => __( 'Opentextbook Quick Search Form', 'opentextbook' ), )
            );
    }

    // Creating widget front-end

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

            // This is where you run the code and display the output
            echo __( 'Hello, World!', 'opentextbook' );
            echo $args['after_widget'];
    }

    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'opentextbook' );
        }
        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class opentextbook_quicksearch_widget ends here

class opentextbook_pageexcerpt_widget extends WP_Widget {
    function __construct() {
        parent::__construct(

            // Base ID of your widget
            'opentextbook_pageexcerpt_widget',

            // Widget name will appear in UI
            __('Opentextbook Page Excerpt', 'opentextbook'),

            // Widget description
            array( 'description' => __( 'Opentextbook Page Excerpt', 'opentextbook' ), )
            );
    }

    // Creating widget front-end

    public function widget( $args, $instance ) {
        extract($args, EXTR_SKIP);
        echo $before_widget;
        $page_data = get_page($instance['page_id']);
        $title = $page_data->post_title;
        $permalink = get_permalink($instance['page_id']);
        echo $page_data->post_content;
        echo $after_widget;
    }

    // Widget Backend
    public function form( $instance ) {
        $default = 	array(
            'title'				=> 'Opentextbook Page Excerpt Widget'
        );
        $instance = wp_parse_args( (array) $instance, $default );
        $page_id = $this->get_field_name('page_id');
        _e("Page to display: " );
        ?>
			<select name="<?php echo $page_id; ?>">
				<?php
					$pages = get_pages();
					foreach ($pages as $page){
						if ($page->ID == $instance['page_id']){
							$selected = 'selected="selected"';
						}
						else {
							$selected='';
						}
						echo '<option value="'
							.$page->ID.'"'
							.$selected.'>'
							.$page->post_title
							.'</option>';
					};
				?>
			</select>
		<?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['page_id'] = strip_tags($new_instance['page_id']);
        return $instance;
    }
} // Class opentextbook_pageexcerpt_widget ends here



// Register and load the widget
function opentextbook_load_widgets() {
    register_widget( 'opentextbook_quicksearch_widget' );
    register_widget( 'opentextbook_pageexcerpt_widget' );
}
add_action( 'widgets_init', 'opentextbook_load_widgets' );