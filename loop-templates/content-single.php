<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<div class="col-lg-8 col-12 mx-auto">

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" >

	<header class="entry-header-post">

		<?php the_title( '<h1 class="entry-title-post">', '</h1>' ); ?>
		<p class="post-date">
		<?php $post_date = get_the_date('F j, Y'); echo $post_date;?>
	</p>
	</header><!-- .entry-header -->
	
	<?php echo get_the_post_thumbnail( $post->ID ); ?>

	<div class="entry-content">

		<?php
		the_content();
		understrap_link_pages();
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
</div>


<div class="related-posts">
    <h2>Discover More</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">

    <?php
    $args = array(
        'post__not_in' => array(get_the_ID()), // Exclude the current post
        'posts_per_page' => 3, // Number of recent posts to display
        'orderby' => 'date', // Order by date to get the most recent posts
    );

    $related_posts_query = new WP_Query($args);

    if ($related_posts_query->have_posts()) {
        while ($related_posts_query->have_posts()) {
            $related_posts_query->the_post();
            ?>

            <div class="col-md-4 mx-auto"> 
                <div class="card h-100">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-image">
                            <?php the_post_thumbnail('large', array('class' => 'card-img-top', 'alt' => get_the_title())); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h4 class="card-title"><?php the_title(); ?></h4>
                        <p class="card-text">
                            <?php
                            $excerpt = get_the_excerpt(); // Get the raw excerpt
                            $stripped_excerpt = strip_tags($excerpt); // Strip HTML tags and formatting
                            echo $stripped_excerpt; // Output the stripped excerpt
                            ?>
                        </p>   
                    </div>
					<div class="button-container mt-auto">
                            <a href="<?php the_permalink(); ?>" class="button-custom right" target="">Read More</a>
                        </div>
                </div>
            </div>

            <?php
        }
        wp_reset_postdata();
    }
    ?>

    </div>
</div>




