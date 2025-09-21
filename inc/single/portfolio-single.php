<?php get_header(); ?>

<section class="tp-portfolio-details-area pt-130 pb-90">
    <div class="container">
        <?php
        // Check if Elementor is used
        if ( \Elementor\Plugin::instance()->db->is_built_with_elementor( get_the_ID() ) ) {
            the_content(); // Elementor-built content
        } else {
            // Default manual layout
            the_post_thumbnail();
            echo '<h1>' . get_the_title() . '</h1>';
            the_content();
        }
        ?>
    </div>
</section>

<?php
// Get current portfolio post ID
$current_post_id = get_the_ID();

// Get categories
$categories = wp_get_post_terms($current_post_id, 'portofolio-cat', array('fields' => 'ids'));

if ($categories) {
    $args = array(
        'post_type'      => 'portfolio',
        'posts_per_page' => 3,
        'post__not_in'   => array($current_post_id),
        'tax_query'      => array(
            array(
                'taxonomy' => 'portofolio-cat',
                'field'    => 'id',
                'terms'    => $categories,
            ),
        ),
    );

    $related_query = new WP_Query($args);
}
?>

<?php if ( isset($related_query) && $related_query->have_posts() ) : ?>
<div class="tp-portfolio-related-area pb-90">
    <div class="container">
        <div class="tp-section-title-wrapper mb-40">
            <h2 class="tp-section-title mb-20">Similar projects</h2>
        </div>
        <div class="row">
            <?php while ( $related_query->have_posts() ) : $related_query->the_post(); 
                $post_cats = get_the_terms(get_the_ID(), 'portofolio-cat');
            ?>
            <div class="col-xl-4 col-lg-4 col-md-6 grid-item cat1 cat4">
                <div class="tp-portfolio-item mb-40">
                    <div class="tp-portfolio-thumb br-15 position-relative mb-20">
                        <?php the_post_thumbnail(); ?>
                        <div class="tp-portfolio-arrow">
                            <a href="<?php the_permalink(); ?>"><i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                    <div class="tp-portfolio-text text-center">
                        <h3 class="tp-portfolio-title tp-fs-30"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p class="m-0 pl-60"><?php echo esc_html( $post_cats[0]->name ?? '' ); ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php get_footer(); ?>
