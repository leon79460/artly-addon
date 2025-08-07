<?php
namespace Artly_Core_Help\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Artly_Team extends Widget_Base {

	public function get_name() {
		return 'artly-team';
	}

	public function get_title() {
		return __( 'Artly Team ', 'artly-core' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'arlty-category' ];
	}

	public function get_script_depends() {
		return [ 'artly-core' ];
	}

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
				'default' => esc_html__( 'Dedicated team member behind your story', 'artly-core' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'team_section',
			[
				'label' => esc_html__( 'Team', 'artly-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'team_name',
			[
				'label' => esc_html__( 'Name', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Cynthia A. Keely' , 'artly-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'team_bio',
			[
				'label' => esc_html__( 'Team Bio', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'CEO of lollipop' , 'artly-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'team_url',
			[
				'label' => esc_html__( 'Team URL', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '#'
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'social_fb',
			[
				'label' => esc_html__( 'Facebook', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '#'
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'social_li',
			[
				'label' => esc_html__( 'Linkedin', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '#'
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'social_tw',
			[
				'label' => esc_html__( 'Twtter', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '#'
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'team_list',
			[
				'label' => esc_html__( 'Social List', 'artly-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'team_name' => esc_html__( 'Cynthia A. Keely', 'artly-core' ),
					],
					[
						'team_name' => esc_html__( 'Jhon Doe', 'artly-core' ),
					],
				],
			]
		);

		$this->end_controls_section();

		
	// Team Selection section 
		$this->start_controls_section(
			'team_selection_section',
			[
				'label' => esc_html__( 'Team Design Style', 'artly-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Layout Style', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-2',
				'options' => [
					'style-1' => esc_html__( 'Slider Team', 'textdomain' ),
					'style-2'  => esc_html__( 'Grid Team', 'textdomain' ),
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

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

	<?php if($settings['layout'] == 'style-2' ) : ?>
				<section class="tp-team-area pt-130 pb-90 plr-100">
				<div class="container-fluid">
						<div class="row">
								<?php foreach($settings['team_list'] as $item) : ?>
								<div class="col-xl-3 col-lg-4 col-md-6">
									<div class="tpteam mb-60">
											<div class="tpteam__thumb br-15 wow img-custom-anim-top" data-wow-duration="1s" data-wow-delay="0.2s">
													<a href="team-details.html"><img src="<?php echo esc_url($item['image']['url']); ?>" alt=""></a>
											</div>
											<div class="tpteam__info mt-30 ml-80">
													<h3 class="tpteam__title"><a href="team-details.html"><?php echo esc_html($item['team_name']); ?></a></h3>
													<span class="ml-45"><i></i> <?php echo esc_html($item['team_bio']); ?></span>

													<div class="tpteam__social mt-20">
													<?php if(!empty($item['social_fb']['url'])) : ?>
														<a href="<?php echo esc_url($item['social_fb']['url']); ?>"><i class="fab fa-facebook-f"></i></a>
													<?php endif; ?>
													<?php if(!empty($item['social_tw']['url'])) : ?>
														<a href="<?php echo esc_url($item['social_tw']['url']); ?>"><i class="fab fa-twitter"></i></a>
													<?php endif; ?>
													<?php if(!empty($item['social_li']['url'])) : ?>
														<a href="<?php echo esc_url($item['social_li']['url']); ?>"><i class="fab fa-linkedin-in"></i></a>
													<?php endif; ?>
													</div>

											</div>
									</div>
								</div>
								<?php endforeach; ?>
						</div>
				</div>
		</section>
	<?php else : ?>

		<div class="tp-team-area pl-100 pr-100 pt-130 pb-130">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-8">
						<div class="tp-section-title-wrapper mb-50">
							<h2 class="tp-section-title mb-20"><?php echo artly_core_kses($settings['artly_title']); ?></h2>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tp-team-nav text-end d-flex justify-content-start justify-content-md-end align-items-center">
							<div class="tp-swiper-team-button-prev tp-swiper-team-button tp-rot-180"><i class="flaticon-right-arrow"></i></div>
							<span></span>
							<div class="tp-swiper-team-button-next tp-swiper-team-button"><i class="flaticon-right-arrow"></i></div>
						</div>
					</div>
				</div>
			</div>

			<div class="container-fluid">
				<div class="swiper tp-team-active">
					<div class="swiper-wrapper">
						<?php foreach($settings['team_list'] as $item) : ?>
							<div class="swiper-slide">
								<div class="tpteam">
									<div class="tpteam__thumb br-15">
										<a href="<?php echo esc_url($item['team_url']['url']); ?>"><img src="<?php echo esc_url($item['image']['url']); ?>" alt=""></a>
									</div>
									<div class="tpteam__info mt-30 ml-80">
										<h3 class="tpteam__title"><a href="<?php echo esc_url($item['team_url']['url']); ?>"><?php echo esc_html($item['team_name']); ?> </a></h3>
										<span class="ml-45"><i></i><?php echo esc_html($item['team_bio']); ?></span>
										<div class="tpteam__social mt-20">
											<?php if(!empty($item['social_fb']['url'])) : ?>
												<a href="<?php echo esc_url($item['social_fb']['url']); ?>"><i class="fab fa-facebook-f"></i></a>
											<?php endif; ?>
											<?php if(!empty($item['social_tw']['url'])) : ?>
												<a href="<?php echo esc_url($item['social_tw']['url']); ?>"><i class="fab fa-twitter"></i></a>
											<?php endif; ?>
											<?php if(!empty($item['social_li']['url'])) : ?>
												<a href="<?php echo esc_url($item['social_li']['url']); ?>"><i class="fab fa-linkedin-in"></i></a>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

		<?php 
	}
}
$widgets_manager->register( new Artly_Team() );
