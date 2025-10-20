<?php
namespace Exdos_Core_Help\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Exdos Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Artly_Award extends Widget_Base {

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
		return 'artly-award';
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
		return __( 'Artly Award', 'artly-core' );
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
		return [ 'artly-category' ];
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

		$this->start_controls_section(
			'award_section',
			[
				'label' => esc_html__( 'Portfolio Info List', 'artly-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'award_title',
			[
				'label' => esc_html__( 'Title', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Exdos received many global awards that inspired our member' , 'artly-core' ),
				'label_block' => true,
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'award_name',
			[
				'label' => esc_html__( 'Title', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Best design award' , 'artly-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'award_date',
			[
				'label' => esc_html__( 'Date', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '2015 - 2016' , 'artly-core' ),
				'label_block' => true,
			]
		);


		$this->add_control(
			'award_list',
			[
				'label' => esc_html__( 'Award List', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'award_name' => esc_html__( 'Best design award', 'artly-core' ),
					],
					[
						'award_name' => esc_html__( 'Dribbble winner', 'artly-core' ),
					],
				],
				'title_field' => '{{{ award_name }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'award_image_section',
			[
				'label' => esc_html__( 'Image Shape', 'artly-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'artly_image',
			[
				'label' => esc_html__( 'Choose Image', 'artly-core' ),
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
					'{{WRAPPER}} .tp-section-title' => 'text-transform: {{VALUE}};',
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


		<div class="award-area tp-cream-bg pt-130 pb-90">
				<div class="container">
						<div class="row">
								<div class="col-xl-6">
										<div class="tp-section-title-wrapper mb-40">
												<h2 class="tp-section-title mb-20"><?php echo esc_html($settings['award_title']); ?></h2>
										</div>
										<div class="shape-arrow mb-40 d-none d-xl-block">
												<?php if ( isset( $settings['artly_image']['url'] ) ) : ?>
													<img src="<?php echo esc_url($settings['artly_image']['url']); ?>" alt="">
												<?php endif; ?>
										</div>
								</div>
								<div class="col-xl-6">
										<div class="tpaward-wrapper mb-40">
												<div class="row gx-0">
													<?php foreach($settings['award_list'] as $item ) : ?>
														<div class="col-md-6">
																<div class="tpaward">
																		<span><?php echo esc_html($item['award_date']); ?></span>
																		<h3 class="tpaward__title"><?php echo esc_html($item['award_name']); ?></h3>
																</div>
														</div>
													<?php endforeach; ?>		
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>

		<?php 

	}

}
$widgets_manager->register( new Artly_Award() );
