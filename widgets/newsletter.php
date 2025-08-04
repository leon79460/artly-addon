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
class Artly_Newsletter extends Widget_Base {

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
		return 'artly-newsletter';
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
		return __( 'Artly Newsletter', 'artly-core' );
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
			'newsletter_section',
			[
				'label' => __( 'Newsletter Content', 'artly-core' ),
			]
		);

		$this->add_control(
			'newslette_title',
			[
				'label' => __( 'Newsletter Title', 'artly-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Here', 'artly-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'newsletter_shorcode',
			[
				'label' => esc_html__( 'Form Shortcode', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'rows' => 7,
				'placeholder' => esc_html__( 'Shortcode here', 'artly-core' ),
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

		        <section class="tp-newsletter-area p-relative z-index-11 wow tpFadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
            <div class="container">
                <div class="tp-newsletter-bg tp-blue-bg">
                    <div class="row">
											<?php if(!empty($settings['newslette_title'])) : ?>
                        <div class="col-xl-4">
                            <div class="tp-section-title-wrapper">
                                <h2 class="tp-section-title tp-section-title-white m-0"><?php echo artly_core_kses($settings['newslette_title']); ?>.</h2>
                            </div>
                        </div>
												<?php endif; ?>	
                        <div class="col-xl-8">
                            <div class="tp-newsletter-box p-relative">
															<?php if(!empty($settings['newslette_title'])) : ?>
                                <h2 class="tp-newsletter-back d-none d-md-block"><?php echo artly_core_kses($settings['newslette_title']); ?></h2>
																<?php endif; ?>	

																<?php if(!empty($settings['newsletter_shorcode'])) : ?>
																<?php echo do_shortcode($settings['newsletter_shorcode']); ?>
																<?php endif; ?>	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<?php 
	}

}


$widgets_manager->register( new Artly_Newsletter() );