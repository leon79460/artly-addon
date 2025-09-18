<?php
namespace Artly_Core_Help\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Artly Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Artly_Video_Popup extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'artly-video_popup';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Artly Video Popup', 'artly-core' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'arlty-category' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'artly-core' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->register_controls_section();
		$this->style_tab_content();
	}

	// register_controls_section
	protected function register_controls_section() {

		// video Selection section 
		$this->start_controls_section(
			'slider_selection_section',
			[
				'label' => esc_html__( 'Design Style', 'artly-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Layout Style', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1' => esc_html__( 'Layout 1', 'textdomain' ),
					'style-2'  => esc_html__( 'Layout 2', 'textdomain' ),
					],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'video_popup_section',
			[
				'label' => __( 'Video Details', 'artly-core' ),
			]
		);

		$this->add_control(
			'video_popup_title',
			[
				'label' => __( 'Title', 'artly-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Intro video', 'artly-core' ),
				'label_block' => true,
				'condition' => [
					'layout' => 'style-1',
				],
			]
		);

		$this->add_control(
			'video_popup_url',
			[
				'label' => esc_html__( 'Video URL', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'artly-core' ),
			]
		);

		$this->end_controls_section();


	//Image for background style 2
		$this->start_controls_section(
			'image_section',
			[
				'label' => esc_html__( 'Image', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'layout' => 'style-2',
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

	}


	// style_tab_content 
	protected function style_tab_content() {
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'artly-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'artly-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'artly-core' ),
					'uppercase' => __( 'UPPERCASE', 'artly-core' ),
					'lowercase' => __( 'lowercase', 'artly-core' ),
					'capitalize' => __( 'Capitalize', 'artly-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<?php if ( $settings['layout'] === 'style-2' ) : ?>
			<div class="tp-video-area jarallax" style="background-image: url(<?php echo esc_url($settings['image']['url']); ?>);">
				<div class="tp-play-btn text-center">
					<?php if ( ! empty($settings['video_popup_url']) ) : ?>
						<a class="popup-video" href="<?php echo esc_url($settings['video_popup_url']); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/play.png" alt="Play Video">
						</a>
					<?php endif; ?>
				</div>
			</div>

		<?php else : ?>

			<?php if ( ! empty($settings['video_popup_url']) ) : ?>
				<div class="tp-about-video-info d-flex align-items-center mb-27">
					<div class="tp-about-video-icon mr-15">
						<a class="popup-video" href="<?php echo esc_url($settings['video_popup_url']); ?>" data-type="iframe">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/play.svg" alt="Play Video">
						</a>
					</div>

					<?php if ( ! empty($settings['video_popup_title']) ) : ?>
						<h4 class="m-0"><?php echo esc_html($settings['video_popup_title']); ?></h4>
					<?php endif; ?>
				</div>
			<?php endif; ?>

		<?php endif; ?>

		<?php
	}

}

$widgets_manager->register( new Artly_Video_Popup() );