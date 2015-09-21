<?php
/**
 * Author: Todd Motto | @toddmotto
 * URL: html5blank.com | @html5blank
 * Custom functions, support, custom post types and more.
 */

require_once "modules/is-debug.php";

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
    Theme Support
\*------------------------------------*/


if (function_exists('add_theme_support'))
{

  // Add Thumbnail Theme Support
  add_theme_support('post-thumbnails');
  add_image_size('large', 1500, '', true); // Large Thumbnail
  add_image_size('medium', 750, '', true); // Medium Thumbnail
  add_image_size('small', 350, '', true); // Small Thumbnail
  add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

  // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
    'default-color' => 'FFF',
    'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

  // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
    'default-image'          => get_template_directory_uri() . '/img/headers/default.jpg',
    'header-text'            => false,
    'default-text-color'     => '000',
    'width'                  => 1000,
    'height'                 => 198,
    'random-default'         => false,
    'wp-head-callback'       => $wphead_cb,
    'admin-head-callback'    => $adminhead_cb,
    'admin-preview-callback' => $adminpreview_cb
    ));*/

  // Enables post and comment RSS feed links to head
  add_theme_support('automatic-feed-links');

  // Localisation Support
  load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
    Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_nav()
{
  wp_nav_menu(
    array(
      'theme_location'  => 'header-menu',
      'menu'            => '',
      'container'       => 'div',
      'container_class' => 'menu-{menu slug}-container',
      'container_id'    => '',
      'menu_class'      => 'menu',
      'menu_id'         => '',
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul>%3$s</ul>',
      'depth'           => 0,
      'walker'          => ''
    )
  );
}

// The Collective page navigation
function the_collective_nav()
{
  wp_nav_menu(
    array(
      'theme_location'  => 'collective-menu',
      'menu'            => '',
      'container'       => 'div',
      'container_class' => 'menu-{menu slug}-container',
      'container_id'    => '',
      'menu_class'      => 'menu',
      'menu_id'         => '',
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul id="collective-menu" class="detail dropdown">%3$s</ul>',
      'depth'           => 0,
      'walker'          => ''
    )
  );
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    if (HTML5_DEBUG) {
      // jQuery
      wp_deregister_script('jquery');
      wp_register_script('jquery', get_template_directory_uri() . '/bower_components/jquery/dist/jquery.js', array(), '1.11.1');

      // Conditionizr
      wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0');

      // Modernizr
      wp_register_script('modernizr', get_template_directory_uri() . '/bower_components/modernizr/modernizr.js', array(), '2.8.3');

      // Mixitup
      wp_register_script('mixitup', get_template_directory_uri() . '/bower_components/bower-mixitup/src/jquery.mixitup.js', array(), '2.1.8');

      // Sticky-kit
      wp_register_script('stickykit', get_template_directory_uri(). '/bower_components/sticky-kit/jquery.sticky-kit.js');

      // Text resizing by container size
      wp_register_script('textfill', get_template_directory_uri(). '/bower_components/jquery-textfill/source/jquery.textfill.js');

      wp_register_script('lazyload', get_template_directory_uri(). '/bower_components/jquery_lazyload/jquery.lazyload.js');

      // Custom scripts
      wp_register_script(
        'html5blankscripts',
        get_template_directory_uri() . '/js/scripts.js',
        array(
          'conditionizr',
          'modernizr',
          'jquery',
          'mixitup',
          'stickykit',
          'textfill',
          'lazyload'
        ),
        '1.0.0');

      // global $wp_query;
      // wp_localize_script( 'html5blankscripts', 'stProjectsFilter', array(
      //     'ajaxurl' => admin_url( 'admin-ajax.php' ),
      //     'query_vars' => json_encode( $wp_query->query )
      // ));

      // Enqueue Scripts
      wp_enqueue_script('html5blankscripts');

      // If production
    } else {
      // Scripts minify
      wp_register_script('html5blankscripts-min', get_template_directory_uri() . '/js/scripts.min.js', array(), '1.0.0');
      // Enqueue Scripts
      wp_enqueue_script('html5blankscripts-min');
    }
  }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
  if (is_page('pagenamehere')) {
    // Conditional script(s)
    wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0');
    wp_enqueue_script('scriptname');
  }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
  if (HTML5_DEBUG) {
    // normalize-css
    wp_register_style('normalize', get_template_directory_uri() . '/bower_components/normalize.css/normalize.css', array(), '3.0.1');

    // Custom CSS
    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array('normalize'), '1.0');

    // Register CSS
    wp_enqueue_style('html5blank');


  } else {
    // Custom CSS
    wp_register_style('html5blankcssmin', get_template_directory_uri() . '/style.css', array(), '1.0');
    // Register CSS
    wp_enqueue_style('html5blankcssmin');
  }
}


// Register HTML5 Blank Navigation
function register_html5_menu()
{
  register_nav_menus(array( // Using array to specify more menus if needed
    'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
    'collective-menu' => __('Sidebar Menu for The Collective', 'the_collective'), // Sidebar Navigation
  ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
  $args['container'] = false;
  return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
  return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
  return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
  global $post;
  if (is_home()) {
    $key = array_search('blog', $classes);
    if ($key > -1) {
      unset($classes[$key]);
    }
  } elseif (is_page()) {
    $classes[] = sanitize_html_class($post->post_name);
  } elseif (is_singular()) {
    $classes[] = sanitize_html_class($post->post_name);
  }

  return $classes;
}

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
  $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
  return $html;
}


// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
  // Define Sidebar Widget Area 1
  register_sidebar(array(
    'name' => __('Widget Area 1', 'html5blank'),
    'description' => __('Description for this widget-area...', 'html5blank'),
    'id' => 'widget-area-1',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

  // Define Sidebar Widget Area 2
  register_sidebar(array(
    'name' => __('Widget Area 2', 'html5blank'),
    'description' => __('Description for this widget-area...', 'html5blank'),
    'id' => 'widget-area-2',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
  global $wp_widget_factory;
  remove_action('wp_head', array(
    $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
    'recent_comments_style'
  ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
  global $wp_query;
  $big = 999999999;
  echo paginate_links(array(
    'base' => str_replace($big, '%#%', get_pagenum_link($big)),
    'format' => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'total' => $wp_query->max_num_pages
  ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
  return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
  return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
  global $post;
  if (function_exists($length_callback)) {
    add_filter('excerpt_length', $length_callback);
  }
  if (function_exists($more_callback)) {
    add_filter('excerpt_more', $more_callback);
  }
  $output = get_the_excerpt();
  $output = apply_filters('wptexturize', $output);
  $output = apply_filters('convert_chars', $output);
  $output = '<p>' . $output . '</p>';
  echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
  global $post;
  return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
  return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
  return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
  $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
  return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
  $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
  $avatar_defaults[$myavatar] = "Custom Gravatar";
  return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
  if (!is_admin()) {
    if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script('comment-reply');
    }
  }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
  $GLOBALS['comment'] = $comment;
  extract($args, EXTR_SKIP);

  if ( 'div' == $args['style'] ) {
    $tag = 'div';
    $add_below = 'comment';
  } else {
    $tag = 'li';
    $add_below = 'div-comment';
  }
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
    <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
    </div>
<?php if ($comment->comment_approved == '0') : ?>
    <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
    <br />
<?php endif; ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
<?php
  printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
?>
    </div>

    <?php comment_text() ?>

    <div class="reply">
    <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php }

/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('wp_enqueue_scripts', 'fontAwesome_styles'); // Font Awesome
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination
add_action( 'p2p_init', 'st_connection_types' ); //Troper to Project Connection
// add_action( 'wp_ajax_nopriv_projects_filter', 'st_projects_filter' ); //Ajax Projects Filter
// add_action( 'wp_ajax_projects_filter', 'st_projects_filter' ); //Ajax Projects Filter

add_action('wp_head', 'swiftype_javascript_config');


// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('post_thumbnail_html', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter('image_send_to_editor', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter('pre_get_posts', 'query_post_type'); // Query Projects as well as blog posts for tags

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

// custom class for dropdown nav menu
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class($classes, $item){
  $parent = $item->menu_item_parent;
  if( $parent == 0 ){ //Notice you can change the conditional from is_single() and $item->title
    $classes[] = "special-class";
  }
    return $classes;
}

/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

function query_post_type($query) {
  if(is_tag() || is_category()) {
    $post_type = get_query_var('post_type');
    if($post_type)
      $post_type = $post_type;
    else
      $post_type = array('post', 'project'); // replace cpt to your custom post type
    $query->set('post_type', $post_type);
    return $query;
  }
}

/*------------------------------------*\
    Font Awesome
\*------------------------------------*/

function fontAwesome_styles()
{
  wp_register_style('fontAwesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array());
  wp_enqueue_style('fontAwesome');
}

/*------------------------------------*\
    ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
  return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
  return '<h2>' . $content . '</h2>';
}

/*------------------------------------*\
    Typekit Fonts
\*------------------------------------*/

function theme_typekit() {
  wp_enqueue_script( 'theme_typekit', '//use.typekit.net/ehq6htz.js');
}

function theme_typekit_inline() {
  if ( wp_script_is( 'theme_typekit', 'done' ) ) { ?>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<?php }
}

/*------------------------------------*\
    Troper to Project Connection
\*------------------------------------*/

function st_connection_types() {
  p2p_register_connection_type( array(
    'name' => 'project_to_troper',
    'from' => 'project',
    'to' => 'troper'
  ) );
}

/*------------------------------------*\
    Filter Projects
\*------------------------------------*/

function st_get_tax($tax_name) {
  $args = array(
    'orderby'           => 'count', 
    'order'             => 'DESC',
    'hide_empty'        => true, 
    'exclude'           => array(), 
    'exclude_tree'      => array(), 
    'include'           => array(),
    'number'            => '', 
    'fields'            => 'all', 
    'slug'              => '',
    'parent'            => '',
    'hierarchical'      => true, 
    'child_of'          => 0,
    'childless'         => false,
    'get'               => '', 
    'name__like'        => '',
    'description__like' => '',
    'pad_counts'        => false, 
    'offset'            => '', 
    'search'            => '', 
    'cache_domain'      => 'core'
  ); 

  return $terms = get_terms($tax_name, $args);
}

/*------------------------------------*\
    Swiftype Search Settings
\*------------------------------------*/


function swiftype_search_params_filter( $params ) {
  // set the fields to search and their boosts
  $params['search_fields[posts]'] = array( 'title^3', 'terms^2', 'author^2', 'body', 'excerpt', 'project_description', 'flex_text', 'troper_job', 'troper_bio' );

  return $params;
}

function swiftype_javascript_config() {
?>
  <script type="text/javascript">
  var swiftypeConfig = {
    fetchFields: {'posts': ['title', 'object_type', 'terms']},
    searchFields: {'posts': ['title', 'terms', 'author', 'body', 'excerpt', 'project_description', 'flex_text', 'troper_job', 'troper_bio']}
  };
  </script>
<?php
}

function swiftype_document_builder_filter( $document, $post ) {
  $term_names = array();
  $taxonomy_names = get_object_taxonomies( $post );
  foreach ( $taxonomy_names as $taxonomy ) {
    $terms = get_the_terms( $post->ID, $taxonomy );
    if ( is_array( $terms ) ) {
      foreach ( $terms as $term ) {
        array_push( $term_names, $term->name );
      }
    }
  }
  $document['fields'][] = array( 'name' => 'terms', 'type' => 'string', 'value' => $term_names );

  $document['fields'][] = array( 'name' => 'project_description',
    'type' => 'text',
    'value' => get_post_meta( $post->ID, 'st_project_description', true ));

  $document['fields'][] = array( 'name' => 'flex_text',
    'type' => 'text',
    'value' => get_post_meta( $post->ID, 'text', true ));

  $document['fields'][] = array( 'name' => 'troper_job',
    'type' => 'string',
    'value' => get_post_meta( $post->ID, 'st_job_title', true ));

  $document['fields'][] = array( 'name' => 'troper_bio',
    'type' => 'text',
    'value' => get_post_meta( $post->ID, 'st_bio', true ));

  return $document;
}

add_filter( 'swiftype_search_params', 'swiftype_search_params_filter', 8, 1 );
add_filter( 'swiftype_document_builder', 'swiftype_document_builder_filter', 8, 2 );

// Utility for showing all of the custom taxonomies of a post type
// get taxonomies terms links
function custom_taxonomies_terms_links(){
  global $post;
  // get post by post id
  $post = get_post( $post->ID );

  // get post type by post
  $post_type = $post->post_type;

  // get post type taxonomies
  $taxonomies = get_object_taxonomies( $post_type, 'objects' );

  // reorder so that tags are last
  $tags = $taxonomies["project_tag"];
  unset($taxonomies["project_tag"]);
  $taxonomies["project_tag"] = $tags;

  foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

    // get the terms related to post
    $terms = get_the_terms( $post->ID, $taxonomy_slug );

    if ( !empty( $terms ) ) {
      echo "<li class='label'>" . $taxonomy->labels->name . "</li>";
      the_terms($post->ID, $taxonomy_slug, "<li class='value'>", " / ", "</li>");
    }
  }

  wp_reset_query();
}

function project_studios(){
  global $post;

  $post = get_post( $post->ID );

  $studios = get_the_terms( $post->ID, "studio" );

  foreach ( $studios as $studio ) {
    $studio_array[] = $studio->slug;
  }

  wp_reset_query();

  return $studio_array;
}

// ACF options page
if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
    'page_title' 	=> 'Studiotrope General Options',
    'menu_title'	=> 'Studiotrope Options',
    'menu_slug' 	=> 'general-options',
    'capability'	=> 'edit_posts',
    'redirect'		=> false
  ));

  acf_add_options_sub_page(array(
    'page_title' 	=> 'Projects Filter Options',
    'menu_title'	=> 'Projects Filter',
    'parent_slug'	=> 'general-options',
  ));

  acf_add_options_sub_page(array(
    'page_title' 	=> 'Tropers Index Options',
    'menu_title'	=> 'Tropers Index',
    'parent_slug'	=> 'general-options',
  ));

}

//Previous and Next Posts Based on Menu Order Rather than Chronologically
function my_previous_post_where( $in_same_term, $excluded_terms ) {

  global $post, $wpdb;

  return $wpdb->prepare( "WHERE p.menu_order < %s AND p.post_type = %s AND p.post_status = 'publish'", $post->menu_order, $post->post_type);
}
add_filter( 'get_previous_post_where', 'my_previous_post_where', 10, 2 );

function my_next_post_where( $in_same_term, $excluded_terms ) {

  global $post, $wpdb;

  return $wpdb->prepare( "WHERE p.menu_order > %s AND p.post_type = %s AND p.post_status = 'publish'", $post->menu_order, $post->post_type);
}
add_filter( 'get_next_post_where', 'my_next_post_where', 10, 2 );

function my_previous_post_sort() {

  return "ORDER BY p.menu_order desc LIMIT 1";
}
add_filter( 'get_previous_post_sort', 'my_previous_post_sort' );

function my_next_post_sort() {

  return "ORDER BY p.menu_order asc LIMIT 1";
}
add_filter( 'get_next_post_sort', 'my_next_post_sort' );

// Check if query returned any of Post Type

function any_of_post_type($post_type) {
  global $post;
  if (have_posts()): while (have_posts()) : the_post(); 
    $returned_types[] = get_post_type($post);
  endwhile;
  endif;

  if (isset($returned_types)) {
    return in_array($post_type, $returned_types);
  } else {
    return false;
  }
}

//Get projects link for specific studio

function custom_term_link($post_type, $term, $taxonomy) {
  $link = get_post_type_archive_link( $post_type );
  $taxonomy_object = get_taxonomy($taxonomy);
  if ( '' != get_option('permalink_structure') ) {
    // using pretty permalinks, append to url
    $link = user_trailingslashit( $link . $taxonomy . "s/" . $term ); // www.example.com/pagename/test
  } else {
    $link = add_query_arg( array($taxonomy => $term), $link );
  }
  return $link;
}


//Hide ACF Menu so nothing gets changed

//add_filter('acf/settings/show_admin', '__return_false');
?>
