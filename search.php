<?php

/*
Plugin Name: Autocomplete Search 
Plugin URI: http://example.com
Description: Simple non-bloated WordPress Contact Form
Version: 1.0
Author: Rega Cahya Gumilang
Author URI: http://w3guy.com
*/

/**
 * Adds Foo_Widget widget.
 */
class Search_Autocomplete_widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'search_autocomplete_widget', // Base ID
            __( 'Autocomplete Search', 'text_domain' ), // Name
            array( 'description' => __( 'Search Your Post with Autocomplete', 'text_domain' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        // echo $args['before_widget'];
        // if ( ! empty( $instance['title'] ) ) {
        //     echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        // }
        // global $wpdb;
        // // $data = $wpdb->get_row("SELECT * FROM testimonial order by rand",ARRAY_A);
        // $data = $wpdb->get_row( "SELECT * FROM testimonial order by rand()", ARRAY_A );
        // // print_r($data);
        // echo "<h4>".$data['testimonial']."</h4>";
        // echo "<i>".$data['name']."</i>";
        // echo __( esc_attr( 'Hello, World!' ), 'text_domain' );
        // echo $args['after_widget'];
        echo $args['before_widget'];
        ?>
        <form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>?action=ac_search_action" method="get">
            <div class="form-group">
                <input id="Autocomplete1" type="text" name="s" placeholder="type everything" class="form-control">
            </div>
            <input type="hidden" name="action" value="ac_search_action">
            <div class="form-group">
                <input  type="submit" name="search_submit" class="button" value="Search"> 
            </div>
        </form>
        <?php
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label> 
        <input  class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

} // class Search_Autocomplete_widget


// register Search_Autocomplete_widget widget
function register_search_autocomplete() {
    register_widget( 'Search_Autocomplete_widget' );
}
add_action( 'widgets_init', 'register_search_autocomplete' );



/**
 * Register jquery autocomplete.
 */
function adding_jquery_autocomplete() {
    
    // wp_enqueue_style( 'css_autocomplete', plugins_url().'/search_autocomplete/js/jquery.auto-complete.css');
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script('jquery_autocomplete','https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'));
    // wp_enqueue_script( 'jquery-ui-autocomplete' );
    
    wp_register_style( 'css_autocomplete','http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
    wp_enqueue_style( 'css_autocomplete');

    wp_register_script('my-autocomplete', plugins_url().'/search_autocomplete/js/tes_jquery.js', array('jquery', 'jquery_autocomplete'),'1.0',false);

    wp_localize_script( 'my-autocomplete', 'MyAutocomplete', array( 'url' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_script( 'my-autocomplete' );
    // wp_register_script( 'jquery_autocomplete', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js',array ( 'jquery' ));
    // wp_enqueue_script( 'jquery_autocomplete' );

}
add_action( 'wp_enqueue_scripts', 'adding_jquery_autocomplete' );


// function wpdocs_dequeue_script() {
//         wp_dequeue_script( 'jquery' ); 
// } 
// add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );


// ajax action front
add_action( 'wp_ajax_my_search', 'my_search' );
add_action( 'wp_ajax_nopriv_my_search', 'my_search' );
function my_search() {
    // global $wpdb; // this is how you get access to the database

    // $whatever = intval( $_POST['whatever'] );

    // $whatever += 10;

    //     echo $whatever;

    // wp_die(); // this is required to terminate immediately and return a proper response
    // global $wpdb; //get access to the WordPress database object variable

    // //get names of all businesses
    // $term = strtolower( $_GET['term'] );
    // $name = $wpdb->esc_like(stripslashes($term)).'%'; //escape for use in LIKE statement
    // $sql = "select post_title 
    //     from $wpdb->posts 
    //     where post_title like %s 
    //     and post_type='job_listing' and post_status='publish'";

    // $sql = $wpdb->prepare($sql, $name);
    
    // $results = $wpdb->get_results($sql);

    // //copy the business titles to a simple array
    // $titles = array();
    // foreach( $results as $r )
    //     $titles[] = addslashes($r->post_title);
    // echo "<script>console.log('".$titles."')</script>";
        
    // echo json_encode($titles); //encode into JSON format and output

    // die(); //stop "0" from being output  
    $term = strtolower( $_POST['term'] );
    // echo "<script>console.log('aaaa".$term."')</script>";
    // echo $term;
        $suggestions = array();
        
        $loop = new WP_Query( 's=' . $term );
        
        while( $loop->have_posts() ) {
            $loop->the_post();
            $suggestion = array();
            $suggestion['label'] = get_the_title();
            // $suggestion = get_the_title();
            // $suggestion['value'] = get_permalink();
            $suggestion['value'] = get_the_title();
            
            $suggestions[] = $suggestion;
        }
        
        wp_reset_query();
        
        
        $response = json_encode( $suggestions );
        echo $response;
        exit();  
}

// script search 
function ac_search_action(){
    if (isset($_GET['action']) && ($_GET['action'] == 'ac_search_action')) {
        echo "string";
        //   global $wpdb;

        //   $wpdb->delete(
        //     "testimonial",
        //     [ 'id_testimonial' => $_GET['id_testimonial'] ]
        //   );
        // echo "<script>alert('testimonial has been deleted')</script>";
        # code...
        // echo "<script>alert=".$_GET['id_testimonial']."</h1>";
        
    }
}
// add_action('wp_')
add_action( 'init', 'ac_search_action', 1 );
