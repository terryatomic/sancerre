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

$bg_color = get_field('background_color');
$custom_footer = get_field('custom_footer');
$color='';
if ($bg_color) {
    $color = $bg_color; // Get the URL of the image
}

// need uniqueID for multiple blocks/page
$ui = uniqid('block-');
$uid = '.'.$ui;

?>

<?php if ($custom_footer): ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var footerContainer = document.querySelector('.footer-container');
    var wrapperFooter = document.querySelector('#wrapper-footer');

    if (footerContainer && wrapperFooter) {
        wrapperFooter.style.display = 'none';
    }
});
</script>
<?php endif; ?>

<div class="<?php echo $class_name;?> footer-container alignfull">
    <div class="container">
        <InnerBlocks />
    </div>
</div><!-- #page -->



