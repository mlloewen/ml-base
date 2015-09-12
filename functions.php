<?php
// Minimize css
define('CSS_MIN', false);

/**
 * ml-base functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package ml-base
 */

/**
 *
 * Kirki Customiser toolkit
 * https://github.com/aristath/kirki
 *
*/
include_once( dirname( __FILE__ ) . '/kirki/kirki.php' );
/**
 * Change the URL that will be used by Kirki
 * to load its assets in the customizer.
 */
function kirki_update_url( $config ) {

    $config['url_path'] = get_stylesheet_directory_uri() . '/kirki/';
    return $config;

}
add_filter( 'kirki/config', 'kirki_update_url' );

/* include the css crush pre processor*/
require_once 'css-crush/CssCrush.php';

/*  css menumaker menu walker */
require_once 'inc/css-menu-maker.php';

if ( ! function_exists( 'ml_base_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ml_base_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on ml-base, use a find and replace
     * to change 'ml-base' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'ml-base', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'ml-base' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    /*
     * Enable support for Post Formats.
     * See https://developer.wordpress.org/themes/functionality/post-formats/
     */
    add_theme_support( 'post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'ml_base_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );
}
endif; // ml_base_setup
add_action( 'after_setup_theme', 'ml_base_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ml_base_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'ml_base_content_width', 640 );
}
add_action( 'after_setup_theme', 'ml_base_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ml_base_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'ml-base' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'ml_base_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ml_base_scripts() {
  //  wp_enqueue_style( 'ml-base-style', get_stylesheet_uri() );
    if (WP_DEBUG or !CSS_MIN) {
        wp_enqueue_style( 'ml-base-style', 'http://' . $_SERVER['HTTP_HOST'] . csscrush_file(get_template_directory() . '/style.css' , array('minify' => 'false' , 'formatter' => 'block' ) ));
    } else {
        wp_enqueue_style( 'ml-base-style', 'http://' . $_SERVER['HTTP_HOST'] . csscrush_file(get_template_directory() . '/style.css' ));
    }

    wp_enqueue_script( 'ml-base-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

    wp_enqueue_script( 'ml-base-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

// menu maker script to add responsivenes
    wp_enqueue_script( 'menumaker', 'https://cdn.rawgit.com/cssmenumaker/jQuery-Plugin-Responsive-Drop-Down/3da6b5060acfed9097bdb02c4b5c234db7bc3600/js/min/menumaker.min.js', array(), '20130115', true );


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'ml_base_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
