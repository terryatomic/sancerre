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
$class_name = 'button-container';
$link_class_name = '';
$icon = get_field('icon');
$icon_align = get_field('icon_alignment');
$light_button = get_field('light_button');
$svg_class_name = 'svg-icon';
$button_style = get_field('button_style');
$bg_url='';
if ($button_style == 'Default' || !$button_style) {
    $link_class_name = 'button-custom';
}
if ($icon) {
    $link_class_name .= ' icon-link';
}
if ($icon_align) {
    $link_class_name .= ' '.$icon_align;
}
if ($button_style == 'Outline') {
    $class_name .= ' outline-button';
}
if ($button_style == 'Share') {
    $link_class_name .= ' share-this arrow-button';
    $icon = get_stylesheet_directory_uri().'/img/arrow.svg';
}
if ($button_style == 'Arrow') {
    $link_class_name .= ' arrow-button';
    $icon = get_stylesheet_directory_uri().'/img/arrow.svg';
}
if ($button_style == 'Phone') {
    $link_class_name .= ' phone-button';
    $icon = get_stylesheet_directory_uri().'/img/phone.svg';
}
if ($button_style == 'Email') {
    $link_class_name .= ' email-button';
    $icon = get_stylesheet_directory_uri().'/img/email.svg';
}
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
$link = get_field('link');

?>
<div class="<?php echo $class_name;?>">
    <a href="<?php echo $link['url']?>" class="<?php echo $link_class_name;?>" target="<?php echo $link['target']?>">
        <?php if($icon || $button_style == 'Arrow' || $button_style == 'Email' || $button_style == 'Phone'): ?>
            <span class="<?php echo $svg_class_name; ?>" style="background-image: url('<?php echo esc_url($icon); ?>');"></span>
        <?php endif; ?>
        <?php echo $link['title']?>
    </a>
</div>
