<?php
/**
 * Icon Grid Block Template.
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
$class_name = 'icon-grid';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

?>
<section <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?><?php if(get_field('gray_background')): echo ' bg-alt'; endif; ?>">

    <div class="container">

        <h2 class="icon-grid--heading">
            <?php the_field('heading'); ?> <em><?php the_field('heading_ital'); ?></em>
        </h2>

        <div class="icon-grid--text">
            <?php the_field('text'); ?>
        </div>

        <?php if( have_rows('icons') ): ?>
        <div class="icon-grid--grid">

            <?php while( have_rows('icons') ) : the_row(); ?>
            <div class="icon-grid--icon">
                
                <?php $icon = get_sub_field('icon');
                echo wp_get_attachment_image($icon, 'medium'); ?>

                <h3 class="icon-grid--label"><?php the_sub_field('label'); ?></h3>
            
            </div>
            <?php endwhile; ?>

        </div>
        <?php endif; ?>

        <div class="icon-grid--disclaimer">
            <?php the_field('disclaimer'); ?>
        </div>
    </div>

</section>