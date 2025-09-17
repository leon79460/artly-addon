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
class Artly_FAQ extends Widget_Base {

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
		return 'artly-faq';
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
		return __( 'Artly FAQ ', 'artly-core' );
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
			'heading_section',
			[
				'label' => __( 'Title and Content', 'artly-core' ),
			]
		);

		$this->add_control(
			'artly_sub_title',
			[
				'label' => __( 'Sub Title', 'artly-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Popular services', 'artly-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'artly_title',
			[
				'label' => __( 'Main Title', 'artly-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Popular services', 'artly-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'artly_content',
			[
				'label' => esc_html__( 'Description', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 7,
				'default' => esc_html__( 'Per ipsum ultrices sollicitudin iaculis platea facilisi semper aliquam up
         senectus cursus vivamus volutpat penatibus', 'artly-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'artly-core' ),
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'faq_section',
			[
				'label' => esc_html__( 'Faq List', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'faq_title',
			[
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title here' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'faq_content',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Content here' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'faq_list',
			[
				'label' => esc_html__( 'Social List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'faq_title' => esc_html__( 'How do you collaborate with developers?', 'textdomain' ),

					],
					[
						'faq_title' => esc_html__( 'How do we start working together?', 'textdomain' ),
					],
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'faq_image_section',
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

		<div class="tp-faq-area mt-130 mb-130 p-relative">
				<div class="tpfaq-bg tpfaq-bg-right wow img-custom-anim-right" data-wow-duration="1.5s" data-wow-delay="0.2s" style="background-image: url(<?php echo esc_url($settings['image'] ['url']); ?>);" alt="">">
				</div>
				<div class="container">
						<div class="row">
								<div class="col-lg-6">
										<div class="tpfaq-wrapper">
												<div class="tp-section-title-wrapper mb-40">
														<span class="tp-section-subtitle mb-10"><i></i> <?php echo artly_core_kses($settings['artly_sub_title']); ?> </span>
														<h2 class="tp-section-title tp-upper mb-20"><?php echo artly_core_kses($settings['artly_title']); ?></h2>
														<p><?php echo artly_core_kses($settings['artly_content']); ?></p>
												</div>

												<div class="accordion" id="accordionExample">
													<?php foreach($settings['faq_list'] as $key=> $item) : 
														$button_class = ($key == 0) ? '' : 'collapsed';
														$show = ($key == 0) ? 'show' : '' ;
														?>
														<div class="tp-accordion-item mb-20">
															<h2 class="accordion-header">
																<button class="tp-accordion-button <?php echo esc_attr($button_class); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($key); ?>" aria-expanded="true" aria-controls="collapseOne-<?php echo esc_attr($key); ?>">
																		<?php echo esc_html($item['faq_title']); ?>
																		<span><i class="far fa-arrow-down"></i></span>
																</button>
															</h2>
															<div id="collapseOne-<?php echo esc_attr($key); ?>" class="tp-accordion-collapse collapse <?php echo esc_attr($show); ?>" data-bs-parent="#accordionExample">
																<div class="tp-accordion-body">
																	<p><?php echo esc_html($item['faq_content']); ?></p>
																</div>
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
$widgets_manager->register( new Artly_FAQ() );