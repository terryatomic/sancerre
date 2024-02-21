<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";
	
	$css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_styles );

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version );
	wp_enqueue_script( 'jquery' );
	
	$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_scripts );
	
	wp_enqueue_style( 'slick-css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array() );

	wp_enqueue_script( 'slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), true );

	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $js_version, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );


function admin_style($hook_suffix) {  // Notice the $hook_suffix parameter here
	$post_types_to_target = array('post', 'page', 'communities'); // Add your custom post type slug(s) here

    if (in_array(get_post_type(), $post_types_to_target) && in_array($hook_suffix, array('post.php', 'page.php', 'post-new.php', 'page-new.php'))) {
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		// Grab asset urls.
		$theme_styles  = "/css/child-theme{$suffix}.css";
		
		$css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_styles );

		wp_enqueue_style( 'slick-css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array() );
		wp_enqueue_script( 'slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), true );

		// wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(),$css_version );
		wp_enqueue_script( 'admin-nexcore', get_stylesheet_directory_uri() . '/js/admin.js', 	array(),$css_version );
		}
}
add_action('admin_enqueue_scripts', 'admin_style', 2000);




/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );


function nexcore_register_acf_blocks() {
    /**
     * We register our block's with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */
    register_block_type( __DIR__ . '/blocks/sancerre-button' );
    register_block_type( __DIR__ . '/blocks/nexcore-button' );
	register_block_type( __DIR__ . '/blocks/mobile-only-block' );
	register_block_type( __DIR__ . '/blocks/responsive-image' );
	register_block_type( __DIR__ . '/blocks/background-pattern-block' );
	register_block_type( __DIR__ . '/blocks/gallery-2-photos-new' );
	register_block_type( __DIR__ . '/blocks/accordion' );
	register_block_type( __DIR__ . '/blocks/floor-plans' );
	register_block_type( __DIR__ . '/blocks/team' );
	register_block_type( __DIR__ . '/blocks/footer-block' );
	register_block_type( __DIR__ . '/blocks/community-hero' );
	register_block_type( __DIR__ . '/blocks/icon-grid' );
	register_block_type( __DIR__ . '/blocks/highlights' );
	register_block_type( __DIR__ . '/blocks/jump-links' );
	register_block_type( __DIR__ . '/blocks/amenity-list' );
	register_block_type( __DIR__ . '/blocks/gallery-carousel' );
}
// Here we call our tt3child_register_acf_block() function on init.
add_action( 'init', 'nexcore_register_acf_blocks' );

function osteo_img_sizes($sizes) {
    return '100vw';
}
add_filter( 'wp_calculate_image_sizes', 'osteo_img_sizes');

function wrap_me( $variable ) {
    // Escape the output to make it safe for displaying in HTML
    $escaped_output = htmlspecialchars(print_r($variable, true));

    // Wrap in <pre> tags and return
    return "<pre>{$escaped_output}</pre>";
}

function theme_scripts() {
    wp_enqueue_script( 'accordion-nexcore', get_stylesheet_directory_uri() . '/js/accordion-nexcore.min.js' );
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

function set_default_page_template() {
    // Function to filter and set the default page template
    add_filter('default_page_template_title', function() {
        return 'Full Width Page'; // Replace with your template name
    }, 20, 2);

    // Optionally, filter the available templates if needed
    add_filter('theme_page_templates', function($page_templates) {
        // Modify $page_templates if needed
        return $page_templates;
    }, 20, 3);
}

add_action('after_setup_theme', 'set_default_page_template');

//Update Gravity Forms button output to support long button
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
    $uri = get_stylesheet_directory_uri();
    $uri_image = $uri . "/img/arrows.svg";
    return "<button class='button gform_button contact-button' id='gform_submit_button_{$form['id']}'>Submit</button>";
}


function my_reusable_block_shortcode($atts) {
    $atts = shortcode_atts(array('id' => ''), $atts);
    if (!$atts['id']) {
        return ''; // Return empty if no ID is provided
    }

    $post = get_post($atts['id']); // Get the post by ID
    return $post ? do_blocks($post->post_content) : ''; // Return the post content
}
add_shortcode('reusable_block', 'my_reusable_block_shortcode');


function add_custom_link_to_admin_menu() {
    // Add a new link under the Appearance menu
    add_menu_page(
        'Edit Patterns',     // Page title
        'Edit Patterns',     // Menu title
        'edit_posts',        // Capability required to see this option
        'edit.php?post_type=wp_block', // The 'slug' - file to display when clicking the link
        '',                  // Function name (not needed in this case)
        'dashicons-layout',  // Icon (Dashicon class name)
        20                   // Position in the menu order
    );
}

add_action('admin_menu', 'add_custom_link_to_admin_menu');


add_filter('nav_menu_css_class', 'add_mega_class_if_has_mega', 10, 3 );
function add_mega_class_if_has_mega($classes, $item) {
    if(get_field('mega', $item)) {
		$classes[] = "mega-menu";
	}
    return $classes;
}
function add_mega_menu_to_item_args( $args, $item, $depth ) {
	// loop
		//$mega = get_field('mega', $item);
		if (get_field('mega', $item)) {
			$dropcontent = get_field('dropdown_menu_items', $item);
			if ($dropcontent) {
				$mlist = '<div class="mega-menu-carrot"></div><div class="dropdown-pane bottom">
				<div class="container">';
				while (have_rows('dropdown_menu_items', $item)) : the_row();
					$title = get_the_title($item->ID); // Get the title of the current item
					$trimTitle = trim_title($title); // Use your custom trim function here
					$mlist .= '<div class="dropdown-pane--column">';
					$link = get_sub_field('heading_text_link', $item);
					if ($link):
						$link_target = $link['target'] ? $link['target'] : '_self';
						$mlist .= '<a class="dropdown-pane--link" href="' . $link['url'] . '" target="' . $link_target . '">';
					endif;
					$mlist .= '<div class="dropdown-pane--heading"><img class="dropdown-pane--icon" src="' . get_sub_field('icon') . '" />' . $link['title'] . '</div>';
					$mlist .= '</a>';
					$mlist .= '<div class="dropdown-pane--description">' . get_sub_field('text') . '</div>';
					$mlist .= '</div>';
				endwhile;
		
				$mlist .= '<div class="dropdown-pane--column menu-featured-post">';
				$featured_post = get_field('featured_post', $item);
				if ($featured_post):
					$title = get_the_title($featured_post->ID); // Get the title of the featured post
					$trimTitle = trim_title($title); // Use your custom trim function here
					$mlist .= '<div class="menu-featured-post--thumbnail">' . get_the_post_thumbnail($featured_post->ID, 'medium') . '</div>';
					$mlist .= '<div class="menu-featured-post--heading">' . $trimTitle;
					$mlist .= '<div class="menu-featured-post--more"><a href="' . get_permalink($featured_post->ID) . '">Read more</a></div></div>';
				endif;
				$mlist .= '</div>';
				$mlist .= '</div>';
				$args->after = $mlist;
			}
		}
	    // if($item->type == 'post_type' && $item->object == 'page') {
	    // 	//print_r($item);
	    // 	$logo = get_field('svg_logo', $item->object_id);
	    // 	if($logo) {
	    // 		//$args->link_before = '<img src="'.$logo.'">';
	    // 	}
	    // }

	// return
	return $args;	
}
add_filter( 'nav_menu_item_args', 'add_mega_menu_to_item_args', 10, 3 );

// removes default understrap post button and excerpt on blog page
if ( ! function_exists( 'understrap_all_excerpts_get_more_link' ) ) {
    function understrap_all_excerpts_get_more_link( $post_excerpt ) {
        if ( ! is_admin() ) {
            $post_excerpt = $post_excerpt . '...</p>';
        }
        return $post_excerpt;
    }
}
add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );


function add_publish_year_to_new_post($post_id) {
    // Check if this is a new post (not an update).
    if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
        return;
    }

    // Get the post object.
    $post = get_post($post_id);

    // Check if the post is of the desired post type (e.g., 'post').
    if ($post->post_type == 'post') {
        // Get the year of the publish date.
        $publish_year = get_the_date('Y', $post);

        // Update the post meta field 'publish_year'.
        update_post_meta($post_id, 'publish_year', $publish_year);
    }
}

// Hook the function to the 'save_post' action.
add_action('save_post', 'add_publish_year_to_new_post');



function custom_excerpt_filter($excerpt) {
    // Remove only paragraph tags from the excerpt
    $excerpt = preg_replace('/<p[^>]*>/', '', $excerpt);
    $excerpt = str_replace('</p>', '', $excerpt);
    return $excerpt;
}

add_filter('get_the_excerpt', 'custom_excerpt_filter');

function trim_title($fullTitle, $length = 45) {
    if (strlen($fullTitle) > $length) {
        $trimmedTitle = substr($fullTitle, 0, $length);
        // Find the last space within the trimmed portion
        $lastSpace = strrpos($trimmedTitle, ' ');
        if ($lastSpace !== false) {
            // Trim to the last space
            $trimmedTitle = substr($trimmedTitle, 0, $lastSpace);
        }
        return $trimmedTitle . "...";
    } else {
        return $fullTitle;
    }
}



function custom_excerpt_length() {
    return 200;
}

function custom_excerpt() {
    global $post;
    $length = custom_excerpt_length();
    if (has_excerpt()) {
        return get_the_excerpt();
    } else {
        $text = get_the_content();
        $text = strip_shortcodes($text);
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
        $text = strip_tags($text); // Remove HTML tags
        $text = substr($text, 0, $length);
        $text = rtrim($text, ".,!?'\" "); // Remove trailing punctuation
        $text = substr($text, 0, strrpos($text, ' ')); // Ensure we end on a word boundary
        $text = $text . '...';
        return $text;
    }
}


// Editor Color Palette
function sancerre_after_setup() {

	add_theme_support( 'editor-color-palette', array(
        
        array(
			'name'  => __( 'White', 'understrap-child' ),
			'slug'  => 'white',
			'color' => '#FFFFFF',
		),
        
        array(
			'name'  => __( 'Black', 'understrap-child' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
        
    	array(
			'name'  => __( 'Charcoal', 'understrap-child' ),
			'slug'  => 'charcoal',
			'color' => '#4D545E',
		),
	
		array(
			'name'	=> __( 'Gold', 'understrap-child' ),
			'slug'	=> 'gold',
			'color'	=> '#E0BA5C',
		),

        array(
			'name'  => __( 'Beige', 'understrap-child' ),
			'slug'  => 'beige',
			'color'	=> '#ECE6DA',
		),
        
        array(
			'name'  => __( 'Blue', 'understrap-child' ),
			'slug'  => 'blue',
			'color'	=> '#86A5A9',
		),
        array(
			'name'  => __( 'Dark Navy', 'understrap-child' ),
			'slug'  => 'dark-navy',
			'color'	=> '#334252',
		),
        array(
			'name'  => __( 'Dark Gray', 'understrap-child' ),
			'slug'  => 'dark-gray',
			'color'	=> '#4D4D4D',
		),
        array(
			'name'  => __( 'Rust', 'understrap-child' ),
			'slug'  => 'rust',
			'color'	=> ' #BF6B33',
		),
    ) );
}
add_action( 'after_setup_theme', 'sancerre_after_setup', 100 );

