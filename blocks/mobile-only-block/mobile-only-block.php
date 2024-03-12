<?php
/**
 * Mobile Only Image.
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
$class_name = 'photo-bleed';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

$desktop_image = get_field('desktop_image');
$mobile_image = get_field('mobile_image');

// Define the image size you want to retrieve (e.g., '1536x1536' for both desktop and mobile)
$desktop_size = '1536x1536';
$mobile_size = "large";
?>

<div class="image-container desktop-image <?php echo $class_name; ?>">
    <?php if ($desktop_image) : ?>
        <?php echo wp_get_attachment_image($desktop_image['id'], $desktop_size); ?>
    <?php endif; ?>
</div>

<div class="image-container mobile-image <?php echo $class_name; ?>">
    <?php if ($mobile_image) : ?>
        <?php echo wp_get_attachment_image($mobile_image['id'], $mobile_size); ?>
    <?php endif; ?>
</div>