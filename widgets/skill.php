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
class Artly_Skill extends Widget_Base {

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
		return 'artly-skill';
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
		return __( 'Artly Skill ', 'artly-core' );
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
				'label' => esc_html__( 'Progress List', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'skill_title',
			[
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title here' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'skill_number',
			[
				'label' => esc_html__( 'Number', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '87' , 'textdomain' ),
				'label_block' => true,
			]
		);


		//Skill list reapeter 
		$this->add_control(
			'skill_list',
			[
				'label' => esc_html__( 'Social List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'skill_title' => esc_html__( 'Web Design', 'textdomain' ),

					],
					[
						'skill_title' => esc_html__( 'UI/XI', 'textdomain' ),
					],
				],
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'skill_image_section',
			[
				'label' => esc_html__( 'Image & Content', 'textdomain' ),
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
			'experience_number',
			[
				'label' => __( 'Experience Number', 'artly-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '25', 'artly-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'experience_title',
			[
				'label' => __( 'Experience Title', 'artly-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Years of experience', 'artly-core' ),
				'label_block' => true,
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

	<section class="tp-about-skill-area pt-40 pb-135 ">
			<div class="container">
				<div class="row">
						<div class="col-lg-6">
								<div class="tp-about-exp br-20 p-relative mb-30">
										<img class="wow img-custom-anim-top" data-wow-duration="1s" data-wow-delay="0.3s" src="<?php echo esc_url($settings['image'] ['url']); ?>" alt="">
										<div class="tp-exp-wrapper">
												<div class="tp-exp-bg"></div>
												<div class="tp-exp d-flex align-items-center">
													<?php if(!empty($settings['experience_number'])) : ?>
														<h2 class="mb-0 mr-20"><?php echo artly_core_kses($settings['experience_number']); ?></h2>
													<?php endif; ?>	

													<?php if(!empty($settings['experience_title'])) : ?>
														<h5 class="tp-fs-30 m-0"><?php echo artly_core_kses($settings['experience_title']); ?> </h5>
													<?php endif; ?>	
												</div>
										</div>
								</div>
						</div>
						<div class="col-lg-6">
								<div class="tp-about-skill-box pl-80">
										<div class="tp-section-title-wrapper mb-33 ">
												<h2 class="tp-section-title mb-20"><?php echo artly_core_kses($settings['artly_title']); ?> </h2>
												<p><?php echo artly_core_kses($settings['artly_content']); ?> </p>
										</div>
										<div class="tp-skill-bar">
											<?php foreach($settings['skill_list'] as $key=> $item) : ?>
												<div class="tp-skill-item mb-25">
													<label><?php echo esc_html($item['skill_title']); ?></label>
													<div class="progress-outer">
														<span class="progress-num" style="left:calc(<?php echo esc_html($item['skill_number']); ?>% - 31px)">
															<?php echo esc_html($item['skill_number']); ?>%
														</span>
														<div class="fix">
															<div class="progress wow tpSkillInLeft" data-wow-duration="1s" data-wow-delay="0.2s" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
																<div class="progress-bar" style="width: <?php echo esc_html($item['skill_number']); ?>%"></div>
															</div>
														</div>
													</div>
												</div>
											<?php endforeach; ?>
										</div>
								</div>
						</div>
				</div>
		</div>
	</section>


		<?php 
	}
}
$widgets_manager->register( new Artly_Skill() );