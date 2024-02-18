<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<div class="col-sm-12 col-lg-6 d-flex align-items-stretch">
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" class="">

 <div class="article-container add-border align-items-stretch d-flex flex-column">


	<div class="post-image">
		<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
	</div>
	<div class="post-date"><?php $post_date = get_the_date('F j, Y'); echo $post_date;?></div>
	<header class="entry-header">

	<h2 class="entry-title">
		<?php the_title(); ?>
	</h2>

		<?php if ( 'post' === get_post_type() ) : ?>

			<!-- <div class="entry-meta">
				<?php understrap_posted_on(); ?>
			</div> -->

		<?php endif; ?>

	</header><!-- .entry-header -->

	

	<div class="entry-content">
	<?php echo custom_excerpt(); ?>

		
		<?php understrap_link_pages();?>

	</div>
	<div class="button-container">
			<a href="<?php the_permalink(); ?>" class="button-custom right" target="">Read More</a>
		</div>
	<!-- <footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer> -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
</div>
