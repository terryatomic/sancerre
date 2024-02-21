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
$class_name = 'bg-pattern-container';
$icon = get_field('icon');

if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
$image = get_field('background_image');
$image_array = get_field('background_image');
$image_url = '';
if ($image_array) {
    $image_url = $image_array['url']; // Get the URL of the image
    $class_name .= ' has-bg '; 
}

$alignment = get_field('alignment');
if ($alignment) {
    $class_name .= $alignment.' '; 
}
$bg_color = get_field('background_color');
$color='';
if ($bg_color) {
    $color = $bg_color; // Get the URL of the image
}

// need uniqueID for multiple blocks/page
$ui = uniqid('block-');
$uid = '.'.$ui;
$block_id='';
if(isset($block['anchor'])){
    $block_id = $block['anchor'];
}
?>
<style>
    <?php echo $uid;?>.has-bg, 
    <?php echo $uid;?>.has-bg .bg-pattern-container,
    <?php echo $uid;?>.bg-align-left .bg-color,
    <?php echo $uid;?>.bg-align-right .bg-color{
        background-color:<?php echo $color; ?>
    }
    <?php echo $uid;?>.has-bg.bg-align-both{
        /* background-color:#ECE6DA; */
    }
    <?php echo $uid;?>.bg-align-both .bg-pattern-container{
        background-color:unset;
    }
    <?php echo $uid;?>.bg-align-both .bg-pattern-container{
        /* background-color:#fff; */
    }

    <?php echo $uid;?>.has-bg .bg-pattern{
        background-image: url('<?php echo esc_url($image_url); ?>');
        background-repeat: repeat-y;
        /* background-size: cover; */
        background-position: center;
        opacity: .3;
    }
    .bg-pattern{
        width:100vw;
        height:100%;
        position: absolute;
        left:0px;
        top:0px;
    }
</style>

<div class="alignfull <?php echo $class_name; ?> <?php echo $ui;?> " id="<?php echo $block_id?>">
    <div class="container">
        <div class="bg-pattern-container">
            <InnerBlocks />
        </div>
        
    </div>
    <div class="bg-color"></div>
    <div class="bg-pattern"></div>
</div>

