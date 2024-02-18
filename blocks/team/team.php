<?php
/**
 * Team Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'team';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

?>
<section <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?><?php if(get_field('gray_background')): echo ' bg-alt'; endif; ?> position-<?php the_field('photo_position'); ?>">

    <div class="container">

        <h2 class="team--heading">
            <?php the_field('heading'); ?>
        </h2>

        <div class="team--text">
            <?php the_field('text'); ?>
        </div>

        <?php
        $featured_team = get_field('team');
        if( $featured_team ): ?>
            <div class="team--grid">
            <?php foreach( $featured_team as $post ): 
               // Setup this post for WP functions (variable must be named $post).
                setup_postdata($post); ?>
                <div class="team--member">
                    <div class="team--photo">
                        <?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
                        <?php if(get_field('bio', $post->ID)): ?>
                        <div class="team--bio">
                            <div class="team--alignment">
                            <?php the_field('bio', $post->ID); ?>
                            </div>
                        </div>
                        <?php endif; ?> 
                    </div>

                    <div class="team--copy">
                        <div class="team--name">
                            <?php echo get_the_title($post->ID); ?>
                        </div>
                        <div class="team--title">
                            <?php the_field('title', $post->ID); ?><?php if(get_field('department', $post->ID)): ?>, <?php the_field('department', $post->ID); endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php 
            // Reset the global post object so that the rest of the page works correctly.
            wp_reset_postdata(); ?>
        <?php endif; ?>


    </div>

</section>