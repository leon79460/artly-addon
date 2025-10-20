<?php
namespace Exdos_Core_Help\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Exdos Core
 *
 * Elementor widget for Artly Fact.
 *
 * @since 1.0.0
 */
class Artly_Fact extends Widget_Base {

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
		return 'artly-fact';
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
		return __( 'Artly Fact', 'artly-core' );
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
	 * Retrieve the list of scripts the widget depends on.
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
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->register_controls_section();
		$this->style_tab_content();
	}

	// Register the controls for the widget
	protected function register_controls_section() {

		$this->start_controls_section(
			'fact_section',
			[
				'label' => esc_html__( 'Fact List', 'artly-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'select_icon_type',
			[
				'label' => __( 'Choose your icon type', 'artly-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'image' => __( 'Image', 'artly-core' ),
					'icon' => __( 'Icon', 'artly-core' ),
				],
			]
		);

		$repeater->add_control(
			'fact_icon',
			[
				'label' => esc_html__( 'Icon', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'select_icon_type' => 'icon',
				],
			]
		);

		$repeater->add_control(
			'fact_image',
			[
				'label' => esc_html__( 'Choose Image', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'select_icon_type' => 'image',
				],
			]
		);

		$repeater->add_control(
			'fact_name',
			[
				'label' => esc_html__( 'Fact Title', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Best design award' , 'artly-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'fact_number',
			[
				'label' => esc_html__( 'Fact Number', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '752' , 'artly-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'fact_list',
			[
				'label' => esc_html__( 'Fact Item', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'fact_name' => esc_html__( 'Satisfied clients', 'artly-core' ),
					],
				],
				'title_field' => '{{{ fact_name }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'fact_background_image',
			[
				'label' => esc_html__( 'Background Image', 'artly-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
				'artly_image',
				[
						'label' => esc_html__( 'Choose Your Background Image', 'artly-core' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
								'url' => get_template_directory_uri() . '/assets/img/bg/fact-bg.png', // Update with the correct path
						],
				]
		);
		$this->end_controls_section();
	}

	// Style the widget
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
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();	

		?>

		<div class="tp-fact-area tp-nblue-bg pt-100 pb-70" style="background-image: url('<?php echo esc_url($settings['artly_image']['url']); ?>');">

			<div class="container">
				<div class="custom-row">
					<?php foreach($settings['fact_list'] as $item ) : ?>
						<div class="cols">
							<div class="tpfact text-center text-lg-start mb-40">
								<div class="tpfact__icon">
									<?php if($item['select_icon_type'] == 'image') : ?> 
										<span><img src="<?php echo esc_url($item['fact_image']['url']); ?>" alt=""></span>
									<?php elseif($item['select_icon_type'] == 'icon') : ?>
										<span><?php \Elementor\Icons_Manager::render_icon( $item['fact_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
									<?php endif; ?>
								</div>
								<div class="tpfact__text">
									<h4 class="tpfact__title mb-30"><?php echo esc_html($item['fact_name']); ?></h4>
									<span><?php echo esc_html($item['fact_number']); ?></span>
								</div>
							</div>
						</div> 
					<?php endforeach; ?>		
				</div>
			</div>
		</div>

		<?php 
	}

}

$widgets_manager->register( new Artly_Fact() );
