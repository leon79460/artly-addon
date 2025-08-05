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
class Artly_Team extends Widget_Base {

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
		return 'artly-team';
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
		return __( 'Artly Team ', 'artly-core' );
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


		$this->start_controls_section(
			'team_section',
			[
				'label' => esc_html__( 'Team', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'team_name',
			[
				'label' => esc_html__( 'Name', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Cynthia A. Keely' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'team_bio',
			[
				'label' => esc_html__( 'Testimonial Bio', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'CEO of lollipop' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'team_list',
			[
				'label' => esc_html__( 'Social List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'team_name' => esc_html__( 'Cynthia A. Keely', 'textdomain' ),

					],
					[
						'team_name' => esc_html__( 'Jhon Doe', 'textdomain' ),
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'testimonial_image_section',
			[
				'label' => esc_html__( 'Image', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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

		$this->add_control(
			'image_2',
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

		<section class="tp-testimonial-area pt-130 pb-130">
				<div class="container">
						<div class="tp-testimonial-wrapper text-center p-relative">
								<div class="tp-testimonial-shape">
										<img src="<?php echo get_template_directory_uri();?>/assets/img/shape/quote-testimonial.png" alt="">
								</div>
								<div class="tp-testimonial-shape-thumb-1 p-absolute d-none d-xl-block">
										<img src="<?php echo esc_url($settings['image'] ['url']); ?>" alt="">
								</div>
								<div class="tp-testimonial-shape-thumb-2 p-absolute d-none d-xl-block">
										<img src="<?php echo esc_url($settings['image_2'] ['url']); ?>" alt="">
								</div>

								<div class="swiper tp-testimonial-active">
										<div class="swiper-wrapper">

										<?php foreach($settings['testimonial_list'] as $item) : ?>
											<div class="swiper-slide">
												<div class="tp-testimonial-item">
														<h3 class="tp-testimonial-desc"> <?php echo esc_html($item['testimonial_text']); ?> </h3>
														<div class="tp-testimonial-author mt-60">
																<h4 class="tp-testimonial-name"><?php echo esc_html($item['testimonial_name']); ?></h4>
																<span class="tp-testimonial-desig"> <span></span> <?php echo esc_html($item['testimonial_bio']); ?> </span>
														</div>    
												</div>
											</div>
											<?php endforeach; ?>

										</div>
								</div>

								<div class="tp-test-slider-arrow">
										<div class="tp-swiper-test-button-prev tp-swiper-test-button tp-rot-180"><i class="flaticon-right-arrow"></i></div>
										<div class="tp-swiper-test-button-next tp-swiper-test-button"><i class="flaticon-right-arrow"></i></div>
								</div>
						</div>
				</div>
			</section>


		<?php 



	}

}
$widgets_manager->register( new Artly_Team() );