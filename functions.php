<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
require_once( 'library/custom-post-type.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
require_once get_template_directory() . '/library/admin.php';

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );

  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

  // new excerpt length
  add_filter('excerpt_length', 'my_custom_excerpt_length');

  // Add support to upload SVG to media library
  add_filter( 'upload_mimes', 'cc_mime_types' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-1600', 1600, 800, true );
add_image_size( 'bones-thumb-800', 800, 500, true );
add_image_size( 'bones-thumb-400', 400, 250, true );
add_image_size( 'bones-thumb-360', 360, 360, true );
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/************* Related Posts By Custom Taxonomy Query *********************/
// Create a query for the custom taxonomy
// function related_posts_by_taxonomy( $post_id, $taxonomy, $args=array() ) {
//     $query = new WP_Query();
//     $terms = wp_get_object_terms( $post_id, $taxonomy );

//     // Make sure we have terms from the current post
//     if ( count( $terms ) ) {
//         $post_ids = get_objects_in_term( $terms[0]->term_id, $taxonomy );
//         $post = get_post( $post_id );
//         $post_type = get_post_type( $post );

//         // Only search for the custom taxonomy on whichever post_type
//         // we AREN'T currently on
//         // This refers to the custom post_types you created so
//         // make sure they are spelled/capitalized correctly
//         if ( strcasecmp($post_type, 'cpt_1') == 0 ) {
//             $type = 'cpt_2';
//         } else {
//             $type = 'cpt_1';
//         }

//         $args = wp_parse_args( $args, array(
//                 'post_type' => $type,
//                 'post__in' => $post_ids,
//                 'taxonomy' => $taxonomy,
//                 'term' => $terms[0]->slug,
//             ) );
//         $query = new WP_Query( $args );
//     }

//     // Return our results in query form
//     return $query;
// }


/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
//function bones_fonts() {
  //wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
  //wp_enqueue_style( 'googleFonts');
//}

//add_action('wp_print_styles', 'bones_fonts');

/**
 * Add Function to return Page Parent slug
 */
function the_parent_slug() {
  global $post;
  if($post->post_parent == 0) return '';
  $post_data = get_post($post->post_parent);
  return $post_data->post_name;
}

/**
*Add Odd Even Classes to project article lists
**/
// function oddeven_post_class ( $classes ) {
//    global $current_class;
//    $classes[] = $current_class;
//    $current_class = ($current_class == 'odd') ? 'even' : 'odd';
//    return $classes;
// }
// add_filter ( 'post_class' , 'oddeven_post_class' );
// global $current_class;
// $current_class = 'odd';

/**
*Add Custom Royalslider Skin
**/
add_filter('new_royalslider_skins', 'new_royalslider_add_custom_skin', 10, 2);
function new_royalslider_add_custom_skin($skins) {
      $skins['myCustomSkin'] = array(
           'label' => 'Custom Skin',
           'path' => get_stylesheet_directory_uri() . '/library/css/modules/custom-slider/rs-custom.css'  // get_stylesheet_directory_uri returns path to your theme folder
      );
      return $skins;
}

/* DON'T DELETE THIS CLOSING TAG */ ?>
<?php register_sidebar( array(
        'id' => 'connect-links',
        'name' => 'Connect With Us',
       'before_widget' => '<nav>',
       'after_widget' => '</nav>',
       'before_title' => '<h3>',
       'after_title' => '</h3>'
) );
?>
<?php
/**
*Init Royal Slider
**/
register_new_royalslider_files(1);
?>