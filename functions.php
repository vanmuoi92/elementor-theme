<?php

/**
 * Beyond Advisors functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Beyond_Advisors
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function beyond_advisors_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Beyond Advisors, use a find and replace
		* to change 'beyond-advisors' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('beyond-advisors', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'beyond-advisors'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'beyond_advisors_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'beyond_advisors_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function beyond_advisors_content_width()
{
	$GLOBALS['content_width'] = apply_filters('beyond_advisors_content_width', 640);
}
add_action('after_setup_theme', 'beyond_advisors_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function beyond_advisors_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'beyond-advisors'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'beyond-advisors'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'beyond_advisors_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function beyond_advisors_scripts()
{
	wp_enqueue_style('beyond-advisors-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('beyond-advisors-style', 'rtl', 'replace');

	wp_enqueue_script('beyond-advisors-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'beyond_advisors_scripts');


if (!function_exists('child_theme_configurator_css')) :
	function child_theme_configurator_css()
	{
		wp_enqueue_style('chld_thm_cfg_child', trailingslashit(get_stylesheet_directory_uri()) . 'style.css', array('hello-elementor', 'hello-elementor', 'hello-elementor-theme-style', 'hello-elementor-header-footer'));
		wp_enqueue_style('tcc2024-app', get_stylesheet_directory_uri() . '/assets/css/app.css', array(), _S_VERSION);
		wp_enqueue_style('slick-css', get_stylesheet_directory_uri() . '/assets/libs/slick/slick.css', array(), _S_VERSION);
		wp_enqueue_style('slick-theme-css', get_stylesheet_directory_uri() . '/assets/libs/slick/slick-theme.css', array(), _S_VERSION);
		wp_enqueue_script('slick-js', get_stylesheet_directory_uri() . '/assets/libs/slick/slick.js', array(), _S_VERSION, true);
		wp_enqueue_script('tcc2024-main', get_stylesheet_directory_uri() . '/assets/scripts/main.js', array(), _S_VERSION, true);
	}
endif;
add_action('wp_enqueue_scripts', 'child_theme_configurator_css', 10);

// END ENQUEUE PARENT ACTION

function deep_scan($dir = __DIR__, $files = [])
{
	$new_files = $files;
	$current_files = array_diff(scandir($dir), array('..', '.'));
	if (!empty($current_files)) {
		foreach ($current_files as $file) {
			$path =  $dir . '/' . $file;
			if (preg_match("/.php$/i", $path)) {
				$new_files[] = $path;
			} else if (is_dir($path)) {
				$new_files = array_merge($new_files, deep_scan($path, []));
			}
		}
	}

	return $new_files;
}

// auto import all files in inc folder
$template_directory  = get_stylesheet_directory();
$folders = ['inc'];
foreach ($folders as $key => $folder) {
	$files = deep_scan($template_directory . '/' . $folder, []);
	if (!empty($files)) {
		foreach ($files as $file) {
			require($file);
		}
	}
}

include_once $template_directory . '/elementor/init.php';
