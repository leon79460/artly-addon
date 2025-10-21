<?php
namespace Artly_Core_Help\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Artly Core
 *
 * Elementor widget for icon box with a clickable sub-heading link.
 *
 * @since 1.0.0
 */
class Artly_Icon_Box extends Widget_Base {

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
		return 'artly-icon_box';
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
		return __( 'Artly Icon Box', 'artly-core' );
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

	// Register controls section
	protected function register_controls_section() {

		// Icon section
		$this->start_controls_section(
			'artly_icon_section',
			[
				'label' => esc_html__( 'Icon', 'artly-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
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
		
		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Choose Icon', 'artly-core' ),
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

		$this->add_control(
			'icon_image',
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

		$this->end_controls_section();

		// Title section
		$this->start_controls_section(
			'artrly_title_section',
			[
				'label' => __( 'Title', 'artly-core' ),
			]
		);

		$this->add_control(
			'main_title',
			[
				'label' => __( 'Main Title', 'artly-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Our Location', 'artly-core' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		// Content section (Repeater)
		$this->start_controls_section(
			'services_section_content',
			[
				'label' => __( 'Content', 'artly-core' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		// Subheading content
		$repeater->add_control(
			'sub_heading',
			[
				'label' => __( 'Sub Heading', 'artly-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( '1905 Oakridge Farm Lane Waukesha, WI 53188', 'artly-core' ),
				'label_block' => true,
			]
		);

		// Link for the subheading
		$repeater->add_control(
			'artly_heading_url',
			[
				'label' => esc_html__( 'Link', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
				'label_block' => true,
			]
		);

		// Add repeater field for the list
		$this->add_control(
			'icon_title_list',
			[
				'label' => esc_html__( 'Content List', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'sub_heading' => esc_html__( 'example@exdosstudio.com', 'artly-core' ),
					],
					[
						'sub_heading' => esc_html__( 'info@exdosstudio.com', 'artly-core' ),
					],
				],
				'title_field' => '{{{ sub_heading }}}',
			]
		);

		$this->end_controls_section();
	}

	// Style controls section
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
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		// Loop through each repeater item (subheading)
		?>
		<div class="tp-contact-info mb-30 text-center wow tpFadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
			<div class="tp-contact-info-icon mb-10">

				<?php if($settings['select_icon_type'] == 'image') : ?>
					<span><img src="<?php echo esc_url($settings['icon_image']['url']); ?>" alt=""></span>
					<?php elseif($settings['select_icon_type'] == 'icon') : ?>
				<span><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
				<?php endif; ?>

			</div>
			<div class="tp-contact-info-text">
				<span class="mb-10 d-block"><?php echo artly_core_kses($settings['main_title']); ?></span>
				
				<?php foreach( $settings['icon_title_list'] as $item ) : ?>
					<p>
						<!-- Check if URL is provided, otherwise display as normal text -->
						<?php if( ! empty( $item['artly_heading_url']['url'] ) ) : ?>
							<a href="<?php echo esc_url($item['artly_heading_url']['url']); ?>"
							   <?php echo !empty($item['artly_heading_url']['is_external']) ? 'target="_blank"' : ''; ?>
							   <?php echo !empty($item['artly_heading_url']['nofollow']) ? 'rel="nofollow"' : ''; ?>>
								<?php echo artly_core_kses($item['sub_heading']); ?>
							</a>
						<?php else : ?>
							<?php echo artly_core_kses($item['sub_heading']); ?>
						<?php endif; ?>
					</p>
				<?php endforeach; ?>
			</div>
		</div>
		<?php 
	}

}

// Register the widget
$widgets_manager->register( new Artly_Icon_Box() );
