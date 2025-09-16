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
		'post_per_page',
			[
				'label' => esc_html__( 'Post Number', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
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
			'post_include',
			[
				'label' => esc_html__( 'Post Include', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => get_all_post(),
			]
		); 

		$this->add_control(
			'post_exclude',
			[
				'label' => esc_html__( 'Post Exclude', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => get_all_post(),
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'asc',
				'options' => [
					'asc' => esc_html__( 'ASC', 'textdomain' ),
					'desc' => esc_html__( 'DESC', 'textdomain' ),
				]
			]
		);

		$this->add_control(
			'order_by',
			[
				'label' => esc_html__( 'Order By', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'title',
				'options' => [
			        'ID' => 'Post ID',
			        'author' => 'Post Author',
			        'title' => 'Title',
			        'date' => 'Date',
			        'modified' => 'Last Modified Date',
			        'parent' => 'Parent Id',
			        'rand' => 'Random',
			        'comment_count' => 'Comment Count',
			        'menu_order' => 'Menu Order',
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

    $args = array(
			'post_type' => 'post',
			'posts_per_page' => $settings['post_per_page'],
			'orderby' => $settings['order_by'],
			'order' => $settings['order'],
			'post__not_in'=> $settings['post_exclude'],
			'post__in'=> $settings['post_include'],
    );

				if(!empty($settings['cat_include'] && !empty($settings['cat_exclude']) )){
			$args['tax_query'] = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $settings['cat_include'],
					'operator' => 'IN',
				),
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $settings['cat_exclude'],
					'operator' => 'NOT IN',
				),
			);
		}
		elseif ( ! empty( $settings['cat_include'] ) || ! empty( $settings['cat_exclude'] ) ) {
				$args['tax_query'] = array(
						array(
								'taxonomy' => 'category',
								'field'    => 'slug',
								'terms'    => ! empty( $settings['cat_exclude'] ) ? $settings['cat_exclude'] : $settings['cat_include'],
								'operator' => ! empty( $settings['cat_exclude'] ) ? 'NOT IN' : 'IN',
						),
				);
		}

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

    <section class="tp-blog-post-area ">
        <div class="container">
            <div class="row">
                <?php if ( $query->have_posts() ) : ?>
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <?php $category = get_the_category(get_the_ID()); ?>

                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="tpblog mb-40">
                                <div class="tpblog__thumb br-20 mb-35 wow img-custom-anim-top" data-wow-duration="1.5s" data-wow-delay="0.1s">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail(); ?>
                                    </a>
                                </div>
                                <div class="tpblog__content pl-30">
                                    <div class="tpblog__meta mb-15">
                                        <span><a href="#"><i class="fal fa-calendar-alt"></i> <?php echo get_the_date(); ?></a></span>
                                        <cite></cite>

                                        <span><a href="#"><i class="fal fa-certificate"></i> <?php echo esc_html($category['0']->name); ?> </a></span>

                                    </div>
                                    <h3 class="tpblog__title mb-25">
                                        <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
                                    </h3>
                                    <div class="tpblog__btn">
                                        <a class="tp-text-btn" href="<?php the_permalink(); ?>"> Read More <i class="far fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php 
}


}


$widgets_manager->register( new Artly_Blog() );