<?php
/**
 * Hero Block Template.
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
// Create class attribute allowing for custom "className" and "align" values.
$class_name = '';
$icon = get_field('icon');

if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
$image = get_field('background_image');
$bg_color = get_field('background_color');
$color='';
if ($bg_color) {
    $color = $bg_color; // Get the URL of the image
}

// need uniqueID for multiple blocks/page
$ui = uniqid('block-');
$uid = '.'.$ui;

if($bg_color):
?>
<style>
.community-header-container .wp-block-columns{
    background-color: <?php echo $color; ?>;
}
</style>
<?php endif ?>
<div class="<?php echo $class_name;?> community-header-container">
    <InnerBlocks />
</div><!-- #page -->



