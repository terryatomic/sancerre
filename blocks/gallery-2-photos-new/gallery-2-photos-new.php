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

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'gallery-2-photos';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

$left_id = get_field('left_image');
$right_id = get_field('right_image');

$left_image = wp_get_attachment_image_src( $left_id['id'], 'full' );
$right_image = wp_get_attachment_image_src($right_id['id'], 'full');

$alt_text_left = get_post_meta($left_id, '_wp_attachment_image_alt', true);
$alt_text_right = get_post_meta($right_id, '_wp_attachment_image_alt', true);

$left_caption = get_field('add_left_caption');
$right_caption = get_field('add_right_caption');

$hide_l = get_field('hide_on_mobile_left');
$hide_r = get_field('hide_on_mobile_right');

$hide_l_class='';
$hide_r_class='';

if($hide_l){
    $hide_l_class .= ' d-none d-lg-block d-xl-block ';
}
if($hide_r){
    $hide_r_class .= ' d-none d-lg-block d-xl-block ';
}

?>


<section <?php echo $anchor; ?>class="alignfull <?php echo esc_attr( $class_name ); ?><?php if(get_field('gray_background')): echo ' bg-alt'; endif; ?>">

<div class="column gallery-2-photos--photos <?php the_field('alignment'); ?>">
        <?php 
        if( $left_image ): ?>
            <div class="gallery-2-photos-column <?php echo $hide_l_class;?>">
                <div class="gallery-2-photos--photo">
                    <?php 
                    echo '<img src="' . esc_url($left_image[0]) . '" alt="' . esc_attr($alt_text_left) . '"style="object-position: '.$left_id['left'].'% '.$left_id['top'].'%;" />'; 
                    ?>
                   
                </div>
                <?php if($left_caption):?>
                    <div class="gallery-2-photos--caption">
                        <?php echo $left_caption;?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; 
        if( $right_image ): ?>
            <div class="gallery-2-photos-column  <?php echo $hide_r_class;?>">
                <div class="gallery-2-photos--photo">
                <?php 
                    echo '<img src="' . esc_url($right_image[0]) . '" alt="' . esc_attr($alt_text_right) . '"style="object-position: '.$right_id['left'].'% '.$right_id['top'].'%;" />'; 
                    ?>
                   
                    </div>
                <?php if($right_caption):?>
                    <div class="gallery-2-photos--caption">
                        <?php echo $right_caption;?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
</div>

</section>