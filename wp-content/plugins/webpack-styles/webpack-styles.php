<?php
/**
 * Plugin Name: Stractured Webpack Example with Source Map
 * Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
 * Description: Simple WordPress plugin that uses webpack.
 * Version:     1.0.0
 * Author:      WebDevStudios
 * Author URI:  https://www.webdevstudios.com
 * Text Domain: wds-wwe
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Enqueue frontend scripts.
 */
function swesm_frontend_scripts() {
	
	wp_register_style( 'swesm_css', plugins_url('/css/build/styles.css', __FILE__), false, '1.0.0' );
	wp_enqueue_style('swesm_css');

	wp_enqueue_script(
	'wds-wwe-frontend-js',
	plugins_url( 'js/build/scripts.js', __FILE__ ),
	[ 'jquery' ],
	'11272018'
	);

}
add_action( 'wp_enqueue_scripts', 'swesm_frontend_scripts' );
/**
 * Enqueue admin scripts.
 */
// function swesm_admin_scripts() {
// 	wp_enqueue_script(
// 	'wds-wwe-admin-js',
// 	plugins_url( 'assets/js/admin.js', __FILE__ ),
// 	[ 'jquery' ],
// 	'11272018'
// 	);
// }
// add_action( 'admin_enqueue_scripts', 'swesm_admin_scripts' );





// /**
//  * summary
//  */
// class  CustomPostTypeName {

//     public $postTypeSlug;
//     public $postTypeLngTag;

//     /**
//      * summary
//      */
//     public function __construct($postTypeSlug) {
//         $this->postTypeSlug = $postTypeSlug;
//         $this->postTypeLngTag = $this->postTypeSlug;
//         $this->init();
//     }

//     public function init()
//     {
//         add_action('init', array( $this, 'support_register_func'), 1); 
//         add_action('init', array( $this, 'support_taxonomy'), 1); 


//         add_filter( 'manage_edit-'.$this->postTypeSlug.'_columns', array( $this, 'support_edit_columns') );
//         add_action( 'manage_posts_custom_column', array( $this, 'support_column_display'), 10, 2 );

//         add_action( 'add_meta_boxes', array( $this, 'support_meta_boxes') );

//         add_action( 'save_post', array( $this, 'support_save_post_meta_func') );
        
//     }

//     public function support_register_func() {  

//         $labels = array(
//             'name'               => esc_html__( 'Support', $this->postTypeLngTag ),
//             'singular_name'      => esc_html__( 'Support', $this->postTypeLngTag ),
//             'add_new'            => esc_html__( 'Add New Support', $this->postTypeLngTag ),
//             'add_new_item'       => esc_html__( 'Add New Support', $this->postTypeLngTag ),
//             'edit_item'          => esc_html__( 'Edit Support', $this->postTypeLngTag ),
//             'new_item'           => esc_html__( 'Add New Support', $this->postTypeLngTag ),
//             'view_item'          => esc_html__( 'View Support', $this->postTypeLngTag ),
//             'search_items'       => esc_html__( 'Search Supports', $this->postTypeLngTag ),
//             'not_found'          => esc_html__( 'No Supports found', $this->postTypeLngTag ),
//             'not_found_in_trash' => esc_html__( 'No Supports found in trash', $this->postTypeLngTag )
//         );

//         $args = array(  
//             'labels'          => $labels,
//             'public'          => true,  
//             'show_ui'         => true,  
//             'capability_type' => 'post',  
//             'hierarchical'    => false,  
//             'menu_icon'       => 'dashicons-paperclip',
//             'rewrite'         => array('slug' => $this->postTypeSlug), // Permalinks format
//             'supports'        => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats' ),
//         );  

//         register_post_type( $this->postTypeSlug , $args );  
//         // remove_post_type_support( 'curated-links' , 'editor' );

//     }  

//     /* ----------------------------------------------------- */
//     /* Register Taxonomy
//     /* ----------------------------------------------------- */
//     function support_taxonomy() {
        
//         register_taxonomy(
//             "support",
//             array($this->postTypeSlug),
//             array(
//                 "hierarchical" => true,
//                 "label" => " Support Category",
//                 "singular_label" => " Support Category",
//                 "rewrite" => true
//             )
//         );

//         // Add new taxonomy, NOT hierarchical (like tags)
//         $labels = array(
//             'name' => _x( 'Tags', $this->postTypeLngTag ),
//             'singular_name' => _x( 'Tag', $this->postTypeLngTag ),
//             'search_items' =>  __( 'Tags' ),
//             'popular_items' => __( 'Popular Tags' ),
//             'all_items' => __( 'All Tags' ),
//             'parent_item' => null,
//             'parent_item_colon' => null,
//             'edit_item' => __( 'Edit Tag' ), 
//             'update_item' => __( 'Update Tag' ),
//             'add_new_item' => __( 'Add New Tag' ),
//             'new_item_name' => __( 'New Tag Name' ),
//             'separate_items_with_commas' => __( 'Separate tags with commas' ),
//             'add_or_remove_items' => __( 'Add or remove tags' ),
//             'choose_from_most_used' => __( 'Choose from the most used tags' ),
//             'menu_name' => __( 'Tags' ),
//         ); 

//         register_taxonomy(
//             'tag',
//             array($this->postTypeSlug),
//             array(
//                 'hierarchical' => false,
//                 'labels' => $labels,
//                 'show_ui' => true,
//                 'update_count_callback' => '_update_post_term_count',
//                 'query_var' => true,
//                 'rewrite' => array( 'slug' => 'tag' ),
//             )
//         );
//     }  

//     function support_edit_columns( $columns ) {
//         $columns = array(
//             "cb"          => "<input type=\"checkbox\" />",
//             "title"       => esc_html__('Title', $this->postTypeLngTag),
//             "support"       => esc_html__('Support Category', $this->postTypeLngTag),
//             "tag"       => esc_html__('Tag', $this->postTypeLngTag),
//             "date"        => esc_html__('Date', $this->postTypeLngTag),
//         );
//         return $columns;
//     }


//     /* ----------------------------------------------------- */

//     function support_column_display( $columns, $post_id ) {
//         switch ( $columns ) {

//             case "support":     
//                 if ( $support_list = get_the_term_list( $post_id, 'support', '', ', ', '' ) ) {
//                     echo $support_list; // No need to escape
//                 } else {
//                     echo esc_html__('None', $this->postTypeLngTag);
//                 }
//             break;

//             case "tag":     
//                 if ( $tag_list = get_the_term_list( $post_id, 'tag', '', ', ', '' ) ) {
//                     echo $tag_list; // No need to escape
//                 } else {
//                     echo esc_html__('None', $this->postTypeLngTag);
//                 }
//             break;         
//         }
//     }



//     /* CONTACT META BOXES */
//     function support_meta_boxes() {
//         add_meta_box( 'support_meta_box', 'MEATABOX_TITLE', array($this, 'support_callback_func'), $this->postTypeSlug );
//     }

//     function support_callback_func( $post ) {

//         wp_nonce_field( 'support_save_post_meta', 'support_meta_box_nonce' );

//         $meta_data = get_post_meta( $post->ID, 'ITEM_meta_key', true );

//     }


//     function support_save_post_meta_func( $post_id ) {

//         if( ! isset( $_POST['support_meta_box_nonce'] ) )
//             return;     
//         if( ! wp_verify_nonce( $_POST['support_meta_box_nonce'], 'support_save_post_meta') ) 
//             return;     
//         if( ! current_user_can( 'edit_post', $post_id ) ) 
//             return;

//         $meta_data = $_POST['custom_field_name_field'];   

//         update_post_meta( $post_id, 'ITEM_meta_key', $meta_data );  

//     }

    
// } // end of  CustomPostTypeName


// $lorem = new  CustomPostTypeName('support');

