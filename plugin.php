<?php
namespace Artly_Core_Help;

use Artly_Core_Help\PageSettings\Page_Settings;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'artly-core', plugins_url( '/assets/js/hello-world.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'editor_scripts_as_a_module' ], 10, 2 );

		wp_enqueue_script(
			'artly-core-editor',
			plugins_url( '/assets/js/editor/editor.js', __FILE__ ),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}

	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'artly-core-editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		// Its is now safe to include Widgets files
		require_once( __DIR__ . '/widgets/fact.php' );
		require_once( __DIR__ . '/widgets/award.php' );
		require_once( __DIR__ . '/widgets/portoflio-filter-post.php');
		require_once( __DIR__ . '/widgets/skill.php' );
		require_once( __DIR__ . '/widgets/faq.php' );
		require_once( __DIR__ . '/widgets/contact-form.php' );
		require_once( __DIR__ . '/widgets/blog-post.php' );
		require_once( __DIR__ . '/widgets/team.php' );
		require_once( __DIR__ . '/widgets/brand-slider.php' );
		require_once( __DIR__ . '/widgets/portfolio-info.php' );
		require_once( __DIR__ . '/widgets/project-tab.php' );
		require_once( __DIR__ . '/widgets/newsletter.php' );
		require_once( __DIR__ . '/widgets/testimonial-slider.php' );
		require_once( __DIR__ . '/widgets/services-box.php' );
		require_once( __DIR__ . '/widgets/video-pupup.php' );
		require_once( __DIR__ . '/widgets/artly-image.php' );
		require_once( __DIR__ . '/widgets/heading.php' );
		require_once( __DIR__ . '/widgets/button.php' );
		require_once( __DIR__ . '/widgets/hero.php' );
		require_once( __DIR__ . '/widgets/demo.php' );
		require_once( __DIR__ . '/widgets/hello-world.php' );
		require_once( __DIR__ . '/widgets/inline-editing.php' );

		// Register Widgets
		
		$widgets_manager->register( new Widgets\Artly_Demo() );
		$widgets_manager->register( new Widgets\Hello_World() );
		$widgets_manager->register( new Widgets\Inline_Editing() );
	}

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/manager.php' );
		new Page_Settings();
	}


	// widget category create 
	public function arlty_add_widget_categories( $harry_add_cat_manager ) {
		$harry_add_cat_manager->add_category(
			'arlty-category',
			[
				'title' => esc_html__( 'Artly Core', 'artly-core' ),
				'icon' => 'fa fa-plug',
			]
		);
	}


// Custom icon code
public function artly_add_custom_icons_tab($tabs = array()){

	// Append new icons
	$feather_icons = array(
			'feather-activity',
			'feather-airplay',
			'feather-alert-circle',
			'feather-alert-octagon',
			'feather-alert-triangle',
			'feather-align-center',
			'feather-align-justify',
			'feather-align-left',
			'feather-align-right',
	);

	$tabs['tp-feather-icons'] = array(
			'name' => 'tp-feather-icons',
			'label' => esc_html__('AL - Feather Icons', 'tpcore'),
			'labelIcon' => 'tp-icon',
			'prefix' => '',
			'displayPrefix' => 'tp',
			'url' => plugins_url('/', __FILE__) . 'assets/css/feather.css',
			'icons' => $feather_icons,
			'ver' => '1.0.0',
	);


		// Append flaticon fonts icons
		$flat_icons = array(
	'flaticon-concentration',
	'flaticon-sharing',
	'flaticon-diagonal',
	'flaticon-search',
	'flaticon-phone-book',
	'flaticon-menu',
	'flaticon-cooperation',
	'flaticon-right-arrow',
	'flaticon-connections',
	'flaticon-merging',
	'flaticon-quotes',
	'flaticon-quotes',
	'flaticon-next-button',
	'flaticon-geometric',
	'flaticon-geometric-1',
	'flaticon-geometric-2',
	'flaticon-geometric-3 ',
	'flaticon-geometric-4 ',
	'flaticon-triangle ',
	'flaticon-geometric-5',
	'flaticon-3d-shapes ',
	'flaticon-geometric-6 ',
	'flaticon-geometric-7 ',
	'flaticon-geometric-8 ',
	'flaticon-megaphone ',
	'flaticon-idea ',
	'flaticon-contract ',
	'flaticon-idea-1 ',
	'flaticon-customer-feedback',
	'flaticon-solution',
	'flaticon-flag',
	'flaticon-telemarketer',
	'flaticon-networking',
	'flaticon-computer',
	'flaticon-vulnerability',
	'flaticon-half',
	'flaticon-map-location',
	'flaticon-chat',
	'flaticon-call',
	'flaticon-quotation-marks',
	);

	$tabs['tp-flaticon-icons'] = array(
		'name' => 'tp-flaticon-icons',
		'label' => esc_html__('Artly - Flaticons', 'tpcore'),
		'labelIcon' => 'tp-icon',
		'prefix' => '',
		'displayPrefix' => 'tp',
		'url' => plugins_url('/', __FILE__) . 'assets/css/flaticon-exdos.css',
		'icons' => $flat_icons,
		'ver' => '1.0.0',
	);

# fontawesome icon
	$fontawesome_icons = array(
		'angle-up',
		'check',
		'times',
		'calendar',
		'language',
		'shopping-cart',
		'bars',
		'search',
		'map-marker',
		'arrow-right',
		'arrow-left',
		'arrow-up',
		'arrow-down',
		'angle-right',
		'angle-left',
		'angle-up',
		'angle-down',
		'phone',
		'users',
		'user',
		'map-marked-alt',
		'trophy-alt',
		'envelope',
		'marker',
		'globe',
		'broom',
		'home',
		'bed',
		'chair',
		'bath',
		'tree',
		'laptop-code',
		'cube',
		'cog',
		'play',
		'trophy-alt',
		'heart',
		'truck',
		'user-circle',
		'map-marker-alt',
		'comments',
			'award',
		'bell',
		'book-alt',
		'book-open',
		'book-reader',
		'graduation-cap',
		'laptop-code',
		'music',
		'ruler-triangle',
		'user-graduate',
		'microscope',
		'glasses-alt',
		'theater-masks',
		'atom'
	);

	$tabs['tp-fontawesome-icons'] = array(
		'name' => 'tp-fontawesome-icons',
		'label' => esc_html__('AL - Fontawesome Pro Light', 'tpcore'),
		'labelIcon' => 'tp-icon',
		'prefix' => 'fa-',
		'displayPrefix' => 'fal',
		'url' => plugins_url('/', __FILE__) . 'assets/css/fontawesome-all.min.css',
		'icons' => $fontawesome_icons,
		'ver' => '1.0.0',
	);

	return $tabs;
}
	


	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Widget Category
		add_action( 'elementor/elements/categories_registered', [$this, 'arlty_add_widget_categories'] );

		// Custom icon hook
		add_filter('elementor/icons_manager/additional_tabs', [$this, 'artly_add_custom_icons_tab']);

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );
		
		$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
Plugin::instance();
