<?php
/**
 * Thespis functions and definitions
 *
 * @package Thespis
 * @since Thespis 0.0.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Thespis 0.0.1
 */
if ( ! isset( $content_width ) )
	$content_width = 790; /* Default the embedded content width to 790px */


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */

/*
 * These lines are required to persuade user to install certain plugins for the theme
 */
require_once get_template_directory().'/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'ocwsthps__register_required_plugins' );

function ocwsthps__register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
            array(
			'name'               => 'Simple Fullscreen Responsive Slider', // The plugin name.
			'slug'               => 'simple-fullscreen-responsive-slider', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/simple-fullscreen-responsive-slider.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
        );
        
        /*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'thespis',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'thespis' ),
			'menu_title'                      => __( 'Install Plugins', 'thespis' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'thespis' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'thespis' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'thespis' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'thespis'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'thespis'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'thespis'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'thespis'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'thespis'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'thespis'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'thespis'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'thespis'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'thespis'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'thespis' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'thespis' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'thespis' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'thespis' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'thespis' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'thespis' ),
			'dismiss'                         => __( 'Dismiss this notice', 'thespis' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'thespis' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'thespis' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
} // end function ocwsthps__register_required_plugins

if ( ! function_exists( 'Thespis_setup' ) ) {
	function Thespis_setup() {
		global $content_width;

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on Thespis, use a find and replace
		 * to change 'Thespis' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'Thespis', trailingslashit( get_template_directory() ) . 'languages' );
                
                if (!current_user_can('administrator') && !is_admin()) {
                    show_admin_bar(false);
                }

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );

		// Create an extra image size for the Post featured image
		add_image_size( 'post_feature_full_width', 792, 300, true );

		// This theme uses wp_nav_menu() in one location
		register_nav_menus( array(
				'primary' => esc_html__( 'Primary Menu', 'Thespis' )
			) );

		// This theme supports a variety of post formats
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );

		// Add theme support for HTML5 markup for the search forms, comment forms, comment lists, gallery, and caption
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

		// Enable support for Custom Backgrounds
		add_theme_support( 'custom-background', array(
				// Background color default
				'default-color' => 'fff',
				// Background image default
				'default-image' => trailingslashit( get_template_directory_uri() ) . 'images/cardboard.jpg'
			) );

		// Enable support for Custom Headers (or in our case, a custom logo)
		add_theme_support( 'custom-header', array(
				// Header image default
				'default-image' => trailingslashit( get_template_directory_uri() ) . 'images/logo.png',
				// Header text display default
				'header-text' => false,
				// Header text color default
				'default-text-color' => '000',
				// Flexible width
				'flex-width' => true,
				// Header image width (in pixels)
				'width' => 300,
				// Flexible height
				'flex-height' => true,
				// Header image height (in pixels)
				'height' => 80
			) );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Enable support for WooCommerce
		add_theme_support( 'woocommerce' );

		// Enable support for Theme Options.
		// Rather than reinvent the wheel, we're using the Options Framework by Devin Price, so huge props to him!
		// http://wptheming.com/options-framework-theme/
		if ( !function_exists( 'optionsframework_init' ) ) {
			define( 'OPTIONS_FRAMEWORK_DIRECTORY', trailingslashit( get_template_directory_uri() ) . 'inc/' );
			require_once trailingslashit( dirname( __FILE__ ) ) . 'inc/options-framework.php';

			// Loads options.php from child or parent theme
			$optionsfile = locate_template( 'options.php' );
			load_template( $optionsfile );
		}

		// If WooCommerce is running, check if we should be displaying the Breadcrumbs
		if( Thespis_is_woocommerce_active() && !of_get_option( 'woocommerce_breadcrumbs', '1' ) ) {
			add_action( 'init', 'Thespis_remove_woocommerce_breadcrumbs' );
		}
	}
}

add_action( 'after_setup_theme', 'Thespis_setup' );


/**
 * Enable backwards compatability for title-tag support
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function Thespis_slug_render_title() { ?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php }
	add_action( 'wp_head', 'Thespis_slug_render_title' );
}


/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of Tenor Sans and Kreon by default is localized. For languages that use characters not supported by the fonts, the fonts can be disabled.
 *
 * @since Thespis 0.0.1
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function Thespis_fonts_url() {
	$fonts_url = '';
	$subsets = 'latin';

	/* translators: If there are characters in your language that are not supported by Tenor Sans, translate this to 'off'.
	 * Do not translate into your own language.
	 */
	$tenor_sans = _x( 'on', 'Tenor Sans font: on or off', 'Thespis' );

	/* translators: To add an additional Tenor Sans character subset specific to your language, translate this to 'greek', 'cyrillic' or 'vietnamese'.
	 * Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Tenor Sans font: add new subset (cyrillic)', 'Thespis' );

	if ( 'cyrillic' == $subset )
		$subsets .= ',cyrillic';

	/* translators: If there are characters in your language that are not supported by Kreon, translate this to 'off'.
	 * Do not translate into your own language.
	 */
	$kreon = _x( 'on', 'Kreon font: on or off', 'Thespis' );

	if ( 'off' !== $tenor_sans || 'off' !== $kreon ) {
		$font_families = array();

		if ( 'off' !== $pt_sans )
			$font_families[] = 'Tenor+Sans:400,400italic,700,700italic';

		if ( 'off' !== $Kreon )
			$font_families[] = 'Kreon:400';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => $subsets,
		);
		$fonts_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $fonts_url;
}


/**
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @since Thespis 0.0.1
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string The filtered CSS paths list.
 */
function Thespis_mce_css( $mce_css ) {
	$fonts_url = Thespis_fonts_url();

	if ( empty( $fonts_url ) ) {
		return $mce_css;
	}

	if ( !empty( $mce_css ) ) {
		$mce_css .= ',';
	}

	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $fonts_url ) );

	return $mce_css;
}
add_filter( 'mce_css', 'Thespis_mce_css' );


/**
 * Register widgetized areas
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */
function Thespis_widgets_init() {
	register_sidebar( array(
			'name' => esc_html__( 'Main Sidebar', 'Thespis' ),
			'id' => 'sidebar-main',
			'description' => esc_html__( 'Appears in the sidebar on posts and pages except the optional Front Page template, which has its own widgets', 'Thespis' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Blog Sidebar', 'Thespis' ),
			'id' => 'sidebar-blog',
			'description' => esc_html__( 'Appears in the sidebar on the blog and archive pages only', 'Thespis' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Single Post Sidebar', 'Thespis' ),
			'id' => 'sidebar-single',
			'description' => esc_html__( 'Appears in the sidebar on single posts only', 'Thespis' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Page Sidebar', 'Thespis' ),
			'id' => 'sidebar-page',
			'description' => esc_html__( 'Appears in the sidebar on pages only', 'Thespis' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'First Front Page Banner Widget', 'Thespis' ),
			'id' => 'frontpage-banner1',
			'description' => esc_html__( 'Appears in the banner area on the Front Page', 'Thespis' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Second Front Page Banner Widget', 'Thespis' ),
			'id' => 'frontpage-banner2',
			'description' => esc_html__( 'Appears in the banner area on the Front Page', 'Thespis' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'First Front Page Widget Area', 'Thespis' ),
			'id' => 'sidebar-homepage1',
			'description' => esc_html__( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'Thespis' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Second Front Page Widget Area', 'Thespis' ),
			'id' => 'sidebar-homepage2',
			'description' => esc_html__( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'Thespis' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Third Front Page Widget Area', 'Thespis' ),
			'id' => 'sidebar-homepage3',
			'description' => esc_html__( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'Thespis' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Fourth Front Page Widget Area', 'Thespis' ),
			'id' => 'sidebar-homepage4',
			'description' => esc_html__( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'Thespis' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'First Footer Widget Area', 'Thespis' ),
			'id' => 'sidebar-footer1',
			'description' => esc_html__( 'Appears in the footer sidebar', 'Thespis' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Second Footer Widget Area', 'Thespis' ),
			'id' => 'sidebar-footer2',
			'description' => esc_html__( 'Appears in the footer sidebar', 'Thespis' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Third Footer Widget Area', 'Thespis' ),
			'id' => 'sidebar-footer3',
			'description' => esc_html__( 'Appears in the footer sidebar', 'Thespis' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

	register_sidebar( array(
			'name' => esc_html__( 'Fourth Footer Widget Area', 'Thespis' ),
			'id' => 'sidebar-footer4',
			'description' => esc_html__( 'Appears in the footer sidebar', 'Thespis' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );
}
add_action( 'widgets_init', 'Thespis_widgets_init' );


/**
 * Enqueue scripts and styles
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */
function Thespis_scripts_styles() {

	/**
	 * Register and enqueue our stylesheets
	 */

	// Start off with a clean base by using normalise. If you prefer to use a reset stylesheet or something else, simply replace this
	wp_register_style( 'normalize', trailingslashit( get_template_directory_uri() ) . 'css/normalize.css' , array(), '3.0.2', 'all' );
	wp_enqueue_style( 'normalize' );

	// Register and enqueue our icon font
	// We're using the awesome Font Awesome icon font. http://fortawesome.github.io/Font-Awesome
	wp_register_style( 'fontawesome', trailingslashit( get_template_directory_uri() ) . 'css/font-awesome.min.css' , array( 'normalize' ), '4.2.0', 'all' );
	wp_enqueue_style( 'fontawesome' );

	// Our styles for setting up the grid.
	// If you prefer to use a different grid system, simply replace this and perform a find/replace in the php for the relevant styles. I'm nice like that!
	wp_register_style( 'gridsystem', trailingslashit( get_template_directory_uri() ) . 'css/grid.css' , array( 'fontawesome' ), '1.0.0', 'all' );
	wp_enqueue_style( 'gridsystem' );

	/*
	 * Load our Google Fonts.
	 *
	 * To disable in a child theme, use wp_dequeue_style()
	 * function mytheme_dequeue_fonts() {
	 *     wp_dequeue_style( 'Thespis-fonts' );
	 * }
	 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
	 */
	$fonts_url = Thespis_fonts_url();
	if ( !empty( $fonts_url ) ) {
		wp_enqueue_style( 'Thespis-fonts', esc_url_raw( $fonts_url ), array(), null );
	}

	// If using a child theme, auto-load the parent theme style.
	// Props to Justin Tadlock for this recommendation - http://justintadlock.com/archives/2014/11/03/loading-parent-styles-for-child-themes
	if ( is_child_theme() ) {
		wp_enqueue_style( 'parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );
	}

	// Enqueue the default WordPress stylesheet
	wp_enqueue_style( 'style', get_stylesheet_uri() );


	/**
	 * Register and enqueue our scripts
	 */

	// Load Modernizr at the top of the document, which enables HTML5 elements and feature detects
	wp_register_script( 'modernizr', trailingslashit( get_template_directory_uri() ) . 'js/modernizr-2.8.3-min.js', array(), '2.8.3', false );
	wp_enqueue_script( 'modernizr' );

	// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use)
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Load jQuery Validation as well as the initialiser to provide client side comment form validation
	// You can change the validation error messages below
	if ( is_singular() && comments_open() ) {
		wp_register_script( 'validate', trailingslashit( get_template_directory_uri() ) . 'js/jquery.validate.min.1.13.0.js', array( 'jquery' ), '1.13.0', true );
		wp_register_script( 'commentvalidate', trailingslashit( get_template_directory_uri() ) . 'js/comment-form-validation.js', array( 'jquery', 'validate' ), '1.13.0', true );

		wp_enqueue_script( 'commentvalidate' );
		wp_localize_script( 'commentvalidate', 'comments_object', array(
			'req' => get_option( 'require_name_email' ),
			'author'  => esc_html__( 'Please enter your name', 'Thespis' ),
			'email'  => esc_html__( 'Please enter a valid email address', 'Thespis' ),
			'comment' => esc_html__( 'Please add a comment', 'Thespis' ) )
		);
	}

	// Include this script to envoke a button toggle for the main navigation menu on small screens
	//wp_register_script( 'small-menu', trailingslashit( get_template_directory_uri() ) . 'js/small-menu.js', array( 'jquery' ), '20130130', true );
	//wp_enqueue_script( 'small-menu' );

}
add_action( 'wp_enqueue_scripts', 'Thespis_scripts_styles' );


/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Thespis 0.0.1
 *
 * @param string html ID
 * @return void
 */
if ( ! function_exists( 'Thespis_content_nav' ) ) {
	function Thespis_content_nav( $nav_id ) {
		global $wp_query;
		$big = 999999999; // need an unlikely integer

		$nav_class = 'site-navigation paging-navigation';
		if ( is_single() ) {
			$nav_class = 'site-navigation post-navigation nav-single';
		}
		?>
		<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
			<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'Thespis' ); ?></h3>

			<?php if ( is_single() ) { // navigation links for single posts ?>

				<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '<i class="fa fa-angle-left"></i>', 'Previous post link', 'Thespis' ) . '</span> %title' ); ?>
				<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '<i class="fa fa-angle-right"></i>', 'Next post link', 'Thespis' ) . '</span>' ); ?>

			<?php } 
			elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) { // navigation links for home, archive, and search pages ?>

				<?php echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var( 'paged' ) ),
					'total' => $wp_query->max_num_pages,
					'type' => 'list',
					'prev_text' => wp_kses( __( '<i class="fa fa-angle-left"></i> Previous', 'Thespis' ), array( 'i' => array( 
						'class' => array() ) ) ),
					'next_text' => wp_kses( __( 'Next <i class="fa fa-angle-right"></i>', 'Thespis' ), array( 'i' => array( 
						'class' => array() ) ) )
				) ); ?>

			<?php } ?>

		</nav><!-- #<?php echo $nav_id; ?> -->
		<?php
	}
}


/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own Thespis_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 * (Note the lack of a trailing </li>. WordPress will add it itself once it's done listing any children and whatnot)
 *
 * @since Thespis 0.0.1
 *
 * @param array Comment
 * @param array Arguments
 * @param integer Comment depth
 * @return void
 */
if ( ! function_exists( 'Thespis_comment' ) ) {
	function Thespis_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) {
		case 'pingback' :
		case 'trackback' :
			// Display trackbacks differently than normal comments ?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="pingback">
					<p><?php esc_html_e( 'Pingback:', 'Thespis' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'Thespis' ), '<span class="edit-link">', '</span>' ); ?></p>
				</article> <!-- #comment-##.pingback -->
			<?php
			break;
		default :
			// Proceed with normal comments.
			global $post; ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
					<header class="comment-meta comment-author vcard">
						<?php
						echo get_avatar( $comment, 44 );
						printf( '<cite class="fn">%1$s %2$s</cite>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span> ' . esc_html__( 'Post author', 'Thespis' ) . '</span>' : '' );
						printf( '<a href="%1$s" title="Posted %2$s"><time itemprop="datePublished" datetime="%3$s">%4$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							sprintf( esc_html__( '%1$s @ %2$s', 'Thespis' ), esc_html( get_comment_date() ), esc_attr( get_comment_time() ) ),
							get_comment_time( 'c' ),
							/* Translators: 1: date, 2: time */
							sprintf( esc_html__( '%1$s at %2$s', 'Thespis' ), get_comment_date(), get_comment_time() )
						);
						?>
					</header> <!-- .comment-meta -->

					<?php if ( '0' == $comment->comment_approved ) { ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'Thespis' ); ?></p>
					<?php } ?>

					<section class="comment-content comment">
						<?php comment_text(); ?>
						<?php edit_comment_link( esc_html__( 'Edit', 'Thespis' ), '<p class="edit-link">', '</p>' ); ?>
					</section> <!-- .comment-content -->

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => wp_kses( __( 'Reply <span>&darr;</span>', 'Thespis' ), array( 'span' => array() ) ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div> <!-- .reply -->
				</article> <!-- #comment-## -->
			<?php
			break;
		} // end comment_type check
	}
}


/**
 * Update the Comments form so that the 'required' span is contained within the form label.
 *
 * @since Thespis 0.0.1
 *
 * @param string Comment form fields html
 * @return string The updated comment form fields html
 */
function Thespis_comment_form_default_fields( $fields ) {

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? ' aria-required="true"' : "" );

	$fields[ 'author' ] = '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'Thespis' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';

	$fields[ 'email' ] =  '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'Thespis' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';

	$fields[ 'url' ] =  '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'Thespis' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

	return $fields;

}
add_action( 'comment_form_default_fields', 'Thespis_comment_form_default_fields' );


/**
 * Update the Comments form to add a 'required' span to the Comment textarea within the form label, because it's pointless 
 * submitting a comment that doesn't actually have any text in the comment field!
 *
 * @since Thespis 0.0.1
 *
 * @param string Comment form textarea html
 * @return string The updated comment form textarea html
 */
function Thespis_comment_form_field_comment( $field ) {

	$field = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'Thespis' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

	return $field;

}
add_action( 'comment_form_field_comment', 'Thespis_comment_form_field_comment' );


/**
 * Prints HTML with meta information for current post: author and date
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'Thespis_posted_on' ) ) {
	function Thespis_posted_on() {
		$post_icon = '';
		switch ( get_post_format() ) {
			case 'aside':
				$post_icon = 'fa-file-o';
				break;
			case 'audio':
				$post_icon = 'fa-volume-up';
				break;
			case 'chat':
				$post_icon = 'fa-comment';
				break;
			case 'gallery':
				$post_icon = 'fa-camera';
				break;
			case 'image':
				$post_icon = 'fa-picture-o';
				break;
			case 'link':
				$post_icon = 'fa-link';
				break;
			case 'quote':
				$post_icon = 'fa-quote-left';
				break;
			case 'status':
				$post_icon = 'fa-user';
				break;
			case 'video':
				$post_icon = 'fa-video-camera';
				break;
			default:
				$post_icon = 'fa-calendar';
				break;
		}

		// Translators: 1: Icon 2: Permalink 3: Post date and time 4: Publish date in ISO format 5: Post date
		$date = sprintf( '<i class="fa %1$s"></i> <a href="%2$s" title="Posted %3$s" rel="bookmark"><time class="entry-date" datetime="%4$s" itemprop="datePublished">%5$s</time></a>',
			$post_icon,
			esc_url( get_permalink() ),
			sprintf( esc_html__( '%1$s @ %2$s', 'Thespis' ), esc_html( get_the_date() ), esc_attr( get_the_time() ) ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		// Translators: 1: Date link 2: Author link 3: Categories 4: No. of Comments
		$author = sprintf( '<i class="fa fa-pencil"></i> <address class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></address>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'Thespis' ), get_the_author() ) ),
			get_the_author()
		);

		// Return the Categories as a list
		$categories_list = get_the_category_list( esc_html__( ' ', 'Thespis' ) );

		// Translators: 1: Permalink 2: Title 3: No. of Comments
		$comments = sprintf( '<span class="comments-link"><i class="fa fa-comment"></i> <a href="%1$s" title="%2$s">%3$s</a></span>',
			esc_url( get_comments_link() ),
			esc_attr( esc_html__( 'Comment on ' , 'Thespis' ) . the_title_attribute( 'echo=0' ) ),
			( get_comments_number() > 0 ? sprintf( _n( '%1$s Comment', '%1$s Comments', get_comments_number(), 'Thespis' ), get_comments_number() ) : esc_html__( 'No Comments', 'Thespis' ) )
		);

		// Translators: 1: Date 2: Author 3: Categories 4: Comments
		printf( wp_kses( __( '<div class="header-meta">%1$s%2$s<span class="post-categories">%3$s</span>%4$s</div>', 'Thespis' ), array( 
			'div' => array ( 
				'class' => array() ), 
			'span' => array( 
				'class' => array() ) ) ),
			$date,
			$author,
			$categories_list,
			( is_search() ? '' : $comments )
		);
	}
}


/**
 * Prints HTML with meta information for current post: categories, tags, permalink
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'Thespis_entry_meta' ) ) {
	function Thespis_entry_meta() {
		// Return the Tags as a list
		$tag_list = "";
		if ( get_the_tag_list() ) {
			$tag_list = get_the_tag_list( '<span class="post-tags">', esc_html__( ' ', 'Thespis' ), '</span>' );
		}

		// Translators: 1 is tag
		if ( $tag_list ) {
			printf( wp_kses( __( '<i class="fa fa-tag"></i> %1$s', 'Thespis' ), array( 'i' => array( 'class' => array() ) ) ), $tag_list );
		}
	}
}


/**
 * Adjusts content_width value for full-width templates and attachments
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */
function Thespis_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() ) {
		global $content_width;
		$content_width = 1200;
	}
}
add_action( 'template_redirect', 'Thespis_content_width' );


/**
 * Change the "read more..." link so it links to the top of the page rather than part way down
 *
 * @since Thespis 0.0.1
 *
 * @param string The 'Read more' link
 * @return string The link to the post url without the more tag appended on the end
 */
function Thespis_remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );
	if ( $offset ) {
		$end = strpos( $link, '"', $offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}
add_filter( 'the_content_more_link', 'Thespis_remove_more_jump_link' );


/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Thespis 0.0.1
 *
 * @return string The 'Continue reading' link
 */
function Thespis_continue_reading_link() {
	return '&hellip;<p><a class="more-link" href="'. esc_url( get_permalink() ) . '" title="' . esc_html__( 'Continue reading', 'Thespis' ) . ' &lsquo;' . get_the_title() . '&rsquo;">' . wp_kses( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'Thespis' ), array( 'span' => array( 
			'class' => array() ) ) ) . '</a></p>';
}


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with the Thespis_continue_reading_link().
 *
 * @since Thespis 0.0.1
 *
 * @param string Auto generated excerpt
 * @return string The filtered excerpt
 */
function Thespis_auto_excerpt_more( $more ) {
	return Thespis_continue_reading_link();
}
add_filter( 'excerpt_more', 'Thespis_auto_excerpt_more' );


/**
 * Extend the user contact methods to include Twitter, Facebook and Google+
 *
 * @since Thespis 0.0.1
 *
 * @param array List of user contact methods
 * @return array The filtered list of updated user contact methods
 */
function Thespis_new_contactmethods( $contactmethods ) {
	// Add Twitter
	$contactmethods['twitter'] = 'Twitter';

	//add Facebook
	$contactmethods['facebook'] = 'Facebook';

	//add Google Plus
	$contactmethods['googleplus'] = 'Google+';

	return $contactmethods;
}
add_filter( 'user_contactmethods', 'Thespis_new_contactmethods', 10, 1 );


/**
 * Add a filter for wp_nav_menu to add an extra class for menu items that have children (ie. sub menus)
 * This allows us to perform some nicer styling on our menu items that have multiple levels (eg. dropdown menu arrows)
 *
 * @since Thespis 0.0.1
 *
 * @param Menu items
 * @return array An extra css class is on menu items with children
 */
function Thespis_add_menu_parent_class( $items ) {

	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}

	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item';
		}
	}

	return $items;
}
add_filter( 'wp_nav_menu_objects', 'Thespis_add_menu_parent_class' );


/**
 * Add Filter to allow Shortcodes to work in the Sidebar
 *
 * @since Thespis 0.0.1
 */
add_filter( 'widget_text', 'do_shortcode' );


/**
 * Return an unordered list of linked social media icons, based on the urls provided in the Theme Options
 *
 * @since Thespis 0.0.1
 *
 * @return string Unordered list of linked social media icons
 */
if ( ! function_exists( 'Thespis_get_social_media' ) ) {
	function Thespis_get_social_media() {
		$output = '';
		$icons = array(
			array( 'url' => of_get_option( 'social_twitter', '' ), 'icon' => 'fa-twitter', 'title' => esc_html__( 'Follow me on Twitter', 'Thespis' ) ),
			array( 'url' => of_get_option( 'social_facebook', '' ), 'icon' => 'fa-facebook', 'title' => esc_html__( 'Like us on Facebook', 'Thespis' ) ),
			array( 'url' => of_get_option( 'social_googleplus', '' ), 'icon' => 'fa-google-plus', 'title' => esc_html__( 'Connect with me on Google+', 'Thespis' ) ),
			array( 'url' => of_get_option( 'social_linkedin', '' ), 'icon' => 'fa-linkedin', 'title' => esc_html__( 'Connect with me on LinkedIn', 'Thespis' ) ),
			array( 'url' => of_get_option( 'social_slideshare', '' ), 'icon' => 'fa-slideshare', 'title' => esc_html__( 'Follow me on SlideShare', 'Thespis' ) ),
			array( 'url' => of_get_option( 'social_dribbble', '' ), 'icon' => 'fa-dribbble', 'title' => esc_html__( 'Follow me on Dribbble', 'Thespis' ) ),
			array( 'url' => of_get_option( 'social_tumblr', '' ), 'icon' => 'fa-tumblr', 'title' => esc_html__( 'Follow me on Tumblr', 'Thespis' ) ),
			array( 'url' => of_get_option( 'social_github', '' ), 'icon' => 'fa-github', 'title' => esc_html__( 'Fork me on GitHub', 'Thespis' ) ),
			array( 'url' => of_get_option( 'social_bitbucket', '' ), 'icon' => 'fa-bitbucket', 'title' => esc_html__( 'Fork me on Bitbucket', 'Thespis' ) ),
			array( 'url' => of_get_option( 'social_foursquare', '' ), 'icon' => 'fa-foursquare', 'title' => esc_html__( 'Follow me on Foursquare', 'Thespis' ) ),
			array( 'url' => of_get_option( 'social_youtube', '' ), 'icon' => 'fa-youtube', 'title' => esc_html__( 'Subscribe to me on YouTube', 'Thespis' ) ),
			array( 'url' => of_get_option( 'social_instagram', '' ), 'icon' => 'fa-instagram', 'title' => esc_html__( 'Follow me on Instagram', 'Thespis' ) ),
			array( 'url' => of_get_option( 'social_flickr', '' ), 'icon' => 'fa-flickr', 'title' => esc_html__( 'Connect with me on Flickr', 'Thespis' ) ),
			array( 'url' => of_get_option( 'social_pinterest', '' ), 'icon' => 'fa-pinterest', 'title' => esc_html__( 'Follow me on Pinterest', 'Thespis' ) ),
			array( 'url' => of_get_option( 'social_rss', '' ), 'icon' => 'fa-rss', 'title' => esc_html__( 'Subscribe to my RSS Feed', 'Thespis' ) )
		);

		foreach ( $icons as $key ) {
			$value = $key['url'];
			if ( !empty( $value ) ) {
				$output .= sprintf( '<li><a href="%1$s" title="%2$s"%3$s><span class="fa-stack fa-lg"><i class="fa fa-square fa-stack-2x"></i><i class="fa %4$s fa-stack-1x fa-inverse"></i></span></a></li>',
					esc_url( $value ),
					$key['title'],
					( !of_get_option( 'social_newtab', '0' ) ? '' : ' target="_blank"' ),
					$key['icon']
				);
			}
		}

		if ( !empty( $output ) ) {
			$output = '<ul>' . $output . '</ul>';
		}

		return $output;
	}
}


/**
 * Return a string containing the footer credits & link
 *
 * @since Thespis 0.0.1
 *
 * @return string Footer credits & link
 */
if ( ! function_exists( 'Thespis_get_credits' ) ) {
	function Thespis_get_credits() {
		$output = '';
		/*
                $output = sprintf( '%1$s <a href="%2$s" title="%3$s">%4$s</a>',
			esc_html__( 'Proudly powered by', 'Thespis' ),
			esc_url( esc_html__( 'http://wordpress.org/', 'Thespis' ) ),
			esc_attr( esc_html__( 'Semantic Personal Publishing Platform', 'Thespis' ) ),
			esc_html__( 'WordPress', 'Thespis' )
		);
                 * The code belw needs amending for translation purposes
                 */
                $output = 'This website is powered by <a href="http://wordpress.org">Wordpress</a>, using the <strong>Thespis</strong> theme from <a href="http://oldcastleweb.com">Old Castle Web Solutions</a>.';

		return $output;
	}
}


/**
 * Outputs the selected Theme Options inline into the <head>
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */
function Thespis_theme_options_styles() {
	$output = '';
	$imagepath =  trailingslashit( get_template_directory_uri() ) . 'images/';
	$background_defaults = array(
		'color' => '#222222',
		'image' => $imagepath . 'dark-noise-2.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' );

	$background = of_get_option( 'banner_background', $background_defaults );
	if ( $background ) {
		$bkgrnd_color = apply_filters( 'of_sanitize_color', $background['color'] );
		$output .= "#bannercontainer { ";
		$output .= "background: " . $bkgrnd_color . " url('" . esc_url( $background['image'] ) . "') " . $background['repeat'] . " " . $background['attachment'] . " " . $background['position'] . ";";
		$output .= " }";
	}

	$footerColour = apply_filters( 'of_sanitize_color', of_get_option( 'footer_color', '#222222' ) );
	if ( !empty( $footerColour ) ) {
		$output .= "\n#footercontainer { ";
		$output .= "background-color: " . $footerColour . ";";
		$output .= " }";
	}

	if ( of_get_option( 'footer_position', 'center' ) ) {
		$output .= "\n.smallprint { ";
		$output .= "text-align: " . sanitize_text_field( of_get_option( 'footer_position', 'center' ) ) . ";";
		$output .= " }";
	}

	if ( $output != '' ) {
		$output = "\n<style>\n" . $output . "\n</style>\n";
		echo $output;
	}
}
add_action( 'wp_head', 'Thespis_theme_options_styles' );


/**
 * Recreate the default filters on the_content
 * This will make it much easier to output the Theme Options Editor content with proper/expected formatting.
 * We don't include an add_filter for 'prepend_attachment' as it causes an image to appear in the content, on attachment pages.
 * Also, since the Theme Options editor doesn't allow you to add images anyway, no big deal.
 *
 * @since Thespis 0.0.1
 */
add_filter( 'meta_content', 'wptexturize' );
add_filter( 'meta_content', 'convert_smilies' );
add_filter( 'meta_content', 'convert_chars'  );
add_filter( 'meta_content', 'wpautop' );
add_filter( 'meta_content', 'shortcode_unautop' );
add_filter( 'meta_content', 'do_shortcode' );

/**
 * Unhook the WooCommerce Wrappers
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


/**
 * Outputs the opening container div for WooCommerce
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'Thespis_before_woocommerce_wrapper' ) ) {
	function Thespis_before_woocommerce_wrapper() {
		echo '<div id="primary" class="site-content row" role="main">';
	}
}


/**
 * Outputs the closing container div for WooCommerce
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'Thespis_after_woocommerce_wrapper' ) ) {
	function Thespis_after_woocommerce_wrapper() {
		echo '</div> <!-- /#primary.site-content.row -->';
	}
}


/**
 * Check if WooCommerce is active
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */
function Thespis_is_woocommerce_active() {
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		return true;
	}
	else {
		return false;
	}
}


/**
 * Check if WooCommerce is active and a WooCommerce template is in use and output the containing div
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'Thespis_setup_woocommerce_wrappers' ) ) {
	function Thespis_setup_woocommerce_wrappers() {
		if ( Thespis_is_woocommerce_active() && is_woocommerce() ) {
				add_action( 'Thespis_before_woocommerce', 'Thespis_before_woocommerce_wrapper', 10, 0 );
				add_action( 'Thespis_after_woocommerce', 'Thespis_after_woocommerce_wrapper', 10, 0 );		
		}
	}
	add_action( 'template_redirect', 'Thespis_setup_woocommerce_wrappers', 9 );
}


/**
 * Outputs the opening wrapper for the WooCommerce content
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'Thespis_woocommerce_before_main_content' ) ) {
	function Thespis_woocommerce_before_main_content() {
		if( ( is_shop() && !of_get_option( 'woocommerce_shopsidebar', '1' ) ) || ( is_product() && !of_get_option( 'woocommerce_productsidebar', '1' ) ) ) {
			echo '<div class="col grid_12_of_12">';
		}
		else {
			echo '<div class="col grid_8_of_12">';
		}
	}
	add_action( 'woocommerce_before_main_content', 'Thespis_woocommerce_before_main_content', 10 );
}


/**
 * Outputs the closing wrapper for the WooCommerce content
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'Thespis_woocommerce_after_main_content' ) ) {
	function Thespis_woocommerce_after_main_content() {
		echo '</div>';
	}
	add_action( 'woocommerce_after_main_content', 'Thespis_woocommerce_after_main_content', 10 );
}


/**
 * Remove the sidebar from the WooCommerce templates
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'Thespis_remove_woocommerce_sidebar' ) ) {
	function Thespis_remove_woocommerce_sidebar() {
		if( ( is_shop() && !of_get_option( 'woocommerce_shopsidebar', '1' ) ) || ( is_product() && !of_get_option( 'woocommerce_productsidebar', '1' ) ) ) {
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		}
	}
	add_action( 'woocommerce_before_main_content', 'Thespis_remove_woocommerce_sidebar' );
}


/**
 * Remove the breadcrumbs from the WooCommerce pages
 *
 * @since Thespis 0.0.1
 *
 * @return void
 */
if ( ! function_exists( 'Thespis_remove_woocommerce_breadcrumbs' ) ) {
	function Thespis_remove_woocommerce_breadcrumbs() {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}
}


/**
 * Set the number of products to display on the WooCommerce shop page
 *
 * @since Thespis 0.0.1.1
 *
 * @return void
 */
if ( ! function_exists( 'Thespis_set_number_woocommerce_products' ) ) {
	function Thespis_set_number_woocommerce_products() {
		if ( of_get_option( 'shop_products', '12' ) ) {
			$numprods = "return " . sanitize_text_field( of_get_option( 'shop_products', '12' ) ) . ";";
			add_filter( 'loop_shop_per_page', create_function( '$cols', $numprods ), 20 );
		}
	}
	add_action( 'init', 'Thespis_set_number_woocommerce_products' );
}

/* Section to save options */
/*
	Backup/Restore Theme Options
	@ https://digwp.com/2014/04/backup-restore-theme-options/
	Go to "Appearance > Backup Options" to export/import theme settings
	(based on "Gantry Export and Import Options" by Hassan Derakhshandeh)
	
	I (OCWS) have edited the code slightly, so that it works with Child Themes

	Usage:
	1. Add entire backup/restore snippet to functions.php
	
*/
class backup_restore_theme_options {

	function backup_restore_theme_options() {
		add_action('admin_menu', array(&$this, 'admin_menu'));
	}
	function admin_menu() {
		// add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
		// $page = add_submenu_page('themes.php', 'Backup Options', 'Backup Options', 'manage_options', 'backup-options', array(&$this, 'options_page'));

		// add_theme_page($page_title, $menu_title, $capability, $menu_slug, $function);
		$page = add_theme_page('Backup Options', 'Backup Options', 'manage_options', 'backup-options', array(&$this, 'options_page'));

		add_action("load-{$page}", array(&$this, 'import_export'));
	}
	function import_export() {
                $ocwsqt_option_name = get_option( 'stylesheet' );
		if (isset($_GET['action']) && ($_GET['action'] == 'download')) {
			header("Cache-Control: public, must-revalidate");
			header("Pragma: hack");
			header("Content-Type: text/plain");
			header('Content-Disposition: attachment; filename="'.$ocwsqt_option_name.'-options-'.date("dMy").'.dat"');
			echo serialize($this->_get_options());
			die();
		}
		if (isset($_POST['upload']) && check_admin_referer('shapeSpace_restoreOptions', 'shapeSpace_restoreOptions')) {
			if ($_FILES["file"]["error"] > 0) {
				// error
			} else {
				$options = unserialize(file_get_contents($_FILES["file"]["tmp_name"]));
				if ($options) {
					foreach ($options as $option) {
						update_option($option->option_name, unserialize($option->option_value));
					}
				}
			}
			wp_redirect(admin_url('themes.php?page=backup-options'));
			exit;
		}
	}
	function options_page() { ?>

		<div class="wrap">
			<?php screen_icon(); ?>
			<h2>Backup/Restore Theme Options</h2>
			<form action="" method="POST" enctype="multipart/form-data">
				<style>#backup-options td { display: block; margin-bottom: 20px; }</style>
				<table id="backup-options">
					<tr>
						<td>
							<h3>Backup/Export</h3>
							<p>Here are the stored settings for the current theme:</p>
							<p><textarea class="widefat code" rows="20" cols="100" onclick="this.select()"><?php echo serialize($this->_get_options()); ?></textarea></p>
							<p><a href="?page=backup-options&action=download" class="button-secondary">Download as file</a></p>
						</td>
						<td>
							<h3>Restore/Import</h3>
							<p><label class="description" for="upload">Restore a previous backup</label></p>
							<p><input type="file" name="file" /> <input type="submit" name="upload" id="upload" class="button-primary" value="Upload file" /></p>
							<?php if (function_exists('wp_nonce_field')) wp_nonce_field('shapeSpace_restoreOptions', 'shapeSpace_restoreOptions'); ?>
						</td>
					</tr>
				</table>
			</form>
		</div>

	<?php }
	function _display_options() {
		$options = unserialize($this->_get_options());
	}
	function _get_options() {
		global $wpdb;
                
                $ocwsqt_option_name = get_option( 'stylesheet' );
                
		return $wpdb->get_results("SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name = '".$ocwsqt_option_name."'"); 
	}
}
new backup_restore_theme_options();
/* End of options saving section */


?>