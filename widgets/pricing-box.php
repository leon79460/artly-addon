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
class Artly_Pricing_Box extends Widget_Base {

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
		return 'artly-pricing_box';
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
		return __( 'Artly Pricing Box', 'artly-core' );
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
		
		// Icon
		$this->start_controls_section(
			'pricing_icon_section',
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
				'label' => esc_html__( 'Icon', 'textdomain' ),
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
			'pricing_image',
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

		// Title and des
		$this->start_controls_section(
			'pricing_section_content',
			[
				'label' => __( 'Pricing Content', 'artly-core' ),
			]
		);

		$this->add_control(
			'main_title',
			[
				'label' => __( 'Main Title', 'artly-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Brand research ', 'artly-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'price',
			[
				'label' => __( 'Price', 'artly-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( '$590', 'artly-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'price_sign',
			[
				'label' => __( 'Price Sign', 'artly-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( '$', 'artly-core' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();


		
		// Item reapeter
		$this->start_controls_section(
			'pricing_list_section',
			[
				'label' => esc_html__( 'Pricing Feature', 'artly-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'pricing_list_name',
			[
				'label' => esc_html__( 'Feature Item', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Customizable registration ' , 'artly-core' ),
				'label_block' => true,
			]
		);


		$this->add_control(
			'pricing_list',
			[
				'label' => esc_html__( 'Pricing List', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'pricing_list_name' => esc_html__( 'Customizable registration', 'artly-core' ),

					],
					[
						'pricing_list_name' => esc_html__( 'Full design support ', 'artly-core' ),
					],
				],
				'title_field' => '{{{ pricing_list_name }}}',
			]
		);

		$this->end_controls_section();
		

		// Box button 
		$this->start_controls_section(
			'pricing_button_content',
			[
				'label' => __( 'Button', 'artly-core' ),
			]
		);

		$this->add_control(
			'pricing_button',
			[
				'label' => __( 'Button Text', 'artly-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Read More', 'artly-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'pricing_button_url',
			[
				'label' => esc_html__( 'Link', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
					// 'custom_attributes' => '',
				],
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

		if(!empty($settings['pricing_button'])) :  
			$this->add_link_attributes('button_arg', $settings['pricing_button_url']);
			$this->add_render_attribute('button_arg','class', 'tp-btn-orange');
		endif 

		?>


				<div class="tpprice mb-30 pt-60 pb-60 pl-50 pr-50 wow tpFadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-bg-color="#FDF6F2" data-background="assets/img/price/price-bg.png">
						<div class="tpprice__icon">

						<?php if($settings['select_icon_type'] == 'image') : ?> 
							<span><img src="<?php echo esc_url($settings['pricing_image']['url']); ?>" alt=""> </span>
						<?php elseif($settings['select_icon_type'] == 'icon') : ?>
							<span> <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
						<?php endif; ?>

								<div class="tpprice__icon-shape">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/price/shape-1.png" alt="">
								</div>
						</div>
						<div class="tpprice__price">

							<h4>
							<span><?php echo artly_core_kses($settings['price_sign']);?></span>
								<?php echo artly_core_kses($settings['price']);?>
							</h4>

						</div>
						
						<h3 class="tpprice__title"><?php echo artly_core_kses($settings['main_title']);?></h3>
						<div class="tpprice__sep"></div>
						<ul class="tpprice__features">
							<?php foreach($settings['pricing_list'] as $item) : ?>
								<li><i class="fal fa-check"></i> <span> <?php echo esc_html($item['pricing_list_name']); ?> </span></li>
							<?php endforeach; ?>
						</ul>
						<div class="tp-price-btn mt-50">
								<a <?php echo $this->get_render_attribute_string('button_arg'); ?> class="tp-btn-orange">
										<span class="tp-btn-wrap">
												<span class="tp-btn-y-1"><?php echo esc_html($settings['pricing_button']); ?></span>
												<span class="tp-btn-y-2"><?php echo esc_html($settings['pricing_button']); ?></span>
										</span>  
										<i></i> 
								</a>
						</div>
				</div>

		<?php 
	}

}
$widgets_manager->register( new Artly_Pricing_Box() );