<?php

namespace Artly_Core_Help\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Artly Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Artly_Heading extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'artly-heading';
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
	public function get_title()
	{
		return __('Artly Heading', 'artly-core');
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
	public function get_icon()
	{
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
	public function get_categories()
	{
		return ['arlty-category'];
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
	public function get_script_depends()
	{
		return ['artly-core'];
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
	protected function register_controls()
	{
		$this->register_controls_section();
		$this->style_tab_content();
	}

	// register_controls_section
	protected function register_controls_section()
	{
		$this->start_controls_section(
			'heading_section',
			[
				'label' => __('Title and Content', 'artly-core'),
			]
		);

		$this->add_control(
			'artly_title',
			[
				'label' => __('Main Title', 'artly-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Popular services', 'artly-core'),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'artly_content',
			[
				'label' => esc_html__('Description', 'artly-core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 7,
				'default' => esc_html__('Per ipsum ultrices sollicitudin iaculis platea facilisi semper aliquam up
         senectus cursus vivamus volutpat penatibus', 'artly-core'),
				'placeholder' => esc_html__('Type your description here', 'artly-core'),
			]
		);

		$this->end_controls_section();
	}

	// style_tab_content 
	protected function style_tab_content()
	{
		$this->start_controls_section(
			'section_style',
			[
				'label' => __('Artly Heading Style', 'artly-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => esc_html__('Alignment', 'textdomain'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'textdomain'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'textdomain'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'textdomain'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justified', 'textdomain'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .al-alignment-el' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Title Color', 'textdomain'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .al-title-el' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Description Color', 'textdomain'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .al-description-el' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __('Text Transform', 'artly-core'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __('None', 'artly-core'),
					'uppercase' => __('UPPERCASE', 'artly-core'),
					'lowercase' => __('lowercase', 'artly-core'),
					'capitalize' => __('Capitalize', 'artly-core'),
				],
				'selectors' => [
					'{{WRAPPER}} .al-title-el' => 'text-transform: {{VALUE}};',
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
	protected function render()
	{
		$settings = $this->get_settings_for_display();

?>

		<div class="tp-section-title-wrapper al-alignment-el">
			<?php if (!empty($settings['artly_title'])) : ?>
				<h2 class="tp-section-title al-title-el mb-20 "><?php echo artly_core_kses($settings['artly_title']); ?></h2>
			<?php endif; ?>
			<?php if (!empty($settings['artly_content'])) : ?>
				<p class="al-description-el"><?php echo artly_core_kses($settings['artly_content']); ?></p>
			<?php endif; ?>
		</div>

<?php
	}
}


$widgets_manager->register(new Artly_Heading());
