<?php
/**
 * Accordion Template.
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
$class_name = 'accordion';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">

    <div class="container">

    <h2 class="accordion--heading"><?php the_field('heading'); ?></h2>

        <?php if( have_rows('accordion') ): ?>
        <div class="ac-container accordion--wrapper">

            <?php while( have_rows('accordion') ) : the_row(); ?>
            <div class="accordion--row ac">
                
            <button class="ac-q accordion--title ac-trigger">
           <?php the_sub_field('heading'); ?>
            </button>
            <div class="ac-a ac-panel">
                <?php the_sub_field('text'); ?>
            </div>
                

            </div>
            <?php endwhile; ?>

        </div>
        <?php endif; ?>

    </div>

</section>
