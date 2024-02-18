<?php
/**
 * Gallery - 2 Photos Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */



// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'responsive-image-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

$image = get_field('image');
$mobile = get_field('mobile');
$tablet = get_field('tablet');
$desktop = get_field('desktop'); 
$caption = get_field('caption');
$hide = get_field('hide_on_mobile');

if($hide){
    $class_name .= ' d-none d-lg-block d-xl-block ';
}


$ui = uniqid('block-');
$uid = '#'.$ui;
?>

<div class="<?php echo esc_attr( $class_name ); ?> <?php echo esc_html ( get_field('image_border') ); ?>" id="<?php echo $ui;?>">
<?php 
$attributes = array(
    'style' => 'object-position:'.$image['left'].'% '.$image['top'].'%;' 
);
    
echo wp_get_attachment_image( $image['id'], 'full', false, $attributes ); ?>
<?php if($caption):?>
<div class="responsive-caption">
    <?php echo $caption; ?>
</div>
<?php endif; ?>
</div>
<style>
    <?php if($mobile): ?>
        <?php echo $uid;?> {
            height: <?php echo $mobile; ?>;
        }
    <?php endif; ?> 

    <?php if($tablet): ?>
        @media only screen and (min-width: 768px) {
            <?php echo $uid;?>  {
                height: <?php echo $tablet; ?>;
            }
        }
    <?php endif; ?> 

    <?php if($desktop): ?>
        @media only screen and (min-width: 1024px) {
            <?php echo $uid;?>  {
                height: <?php echo $desktop; ?>;
            }
        }
    <?php endif; ?> 

</style>