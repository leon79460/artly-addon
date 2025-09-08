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
class Artly_Blog extends Widget_Base {

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
		return 'artly-blog';
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
		return __( 'Artly Blog Post', 'artly-core' );
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
			'blog_post_section',
			[
				'label' => __( 'Blog Post', 'artly-core' ),
			]
		);

		$this->add_control(
			'cat_include',
			[
				'label' => esc_html__( 'Category Include', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => post_cat(),
			]
		); 

		$this->add_control(
			'cat_exclude',
			[
				'label' => esc_html__( 'Category Exclude', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => post_cat(),
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

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 3,
			'orderby' => 'ASC',
			'order' => 'date',
			// 'offset' => $offset,
			// 'post__not_in'=> $settings['post_exclude'],
			// 'post__in'=> $settings['post_inlude'],
			// 'ignore_sticky_posts' => $ignore_sticky_posts
		);

		$query = new \WP_Query( $args );

		// $args = [
    //         'post_type' => 'post',
    //         'post_status' => 'publish',
    //         'posts_per_page' => 1,
    //         'tax_query' => [
    //             'relation' => 'OR',
    //             [
    //                 'taxonomy' => 'team',
    //                 'field' => 'slug',
    //                 'terms' => $team_slug,
    //             ],
	  //           [
		//             'taxonomy' => 'team',
		//             'field' => 'id',
		//             'operator' => 'NOT EXISTS',
	  //           ],
    //         ],

    //         'ignore_sticky_posts' => 1,
    //     ];

		?>

    <?php if ( $query->have_posts() ) : ?>
    <?php while ( $query->have_posts() ) : $query->the_post(); 
		$category = get_the_category(get_the_ID()); 
		?>


		<div class="tp-blog-post-area pt-130 pb-90">
				<div class="container">
						<div class="row">
								<div class="col-xl-4 col-lg-4 col-md-6">
										<div class="tpblog mb-40">
												<div class="tpblog__thumb br-20 mb-35 wow img-custom-anim-top" data-wow-duration="1.5s" data-wow-delay="0.1s">
														<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
												</div>
												<div class="tpblog__content pl-30">
														<div class="tpblog__meta mb-15">
																<span><a href="#"><i class="fal fa-calendar-alt"></i> <?php echo get_the_date(); ?> </a></span>
																<cite></cite>
																<span><a href="#"><i class="fal fa-certificate"></i> <?php echo esc_html($category['0']->name); ?> </a></span>
														</div>
														<h3 class="tpblog__title mb-25">
																<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
														</h3>
														<div class="tpblog__btn">
																<a class="tp-text-btn" href="<?php the_permalink(); ?>">Read More <i class="far fa-arrow-right"></i></a>
														</div>
												</div>
										</div>
								</div>
						</div>
				</div>
    </div>

		<?php endwhile; wp_reset_postdata(); ?>
		<?php endif; ?>

		<?php 
	}

}


$widgets_manager->register( new Artly_Blog() );