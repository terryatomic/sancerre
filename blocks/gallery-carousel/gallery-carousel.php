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
$class_name = 'gallery-carousel';
 
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

?>
    <section id="gallery" class="center-mode-gallery <?php echo esc_attr( $class_name ); ?> slick-slider-selector">
    
    <div class="counter-info"></div>
    <div class="slick-arrows-container"></div>
        <div class="center-mode-carousel">
        <?php while( have_rows('carousel') ): the_row(); 
                    $image = get_sub_field('photo');
                    ?>
            <div class="center-mode-carousel--image">
                     <?php 
                            $attributes = array(
                                'style' => 'object-position:'.$image['left'].'% '.$image['top'].'%;' 
                            );
                             
                            echo wp_get_attachment_image( $image['id'], 'full', false, $attributes ); ?>
            </div>
        <?php endwhile; ?>
        </div>
        <div class="slick-dots"></div>
    </section>
<script>
jQuery(document).ready(function($) {
    var $status = $('.counter-info');
var $slickElement = $('.slick-slider-selector');

$slickElement.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
    //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
    var i = (currentSlide ? currentSlide : 0) + 1;
    $status.html( '<span class="current_slide">' + i + '</span> / <span class="total_slides"> ' + slick.slideCount + '</span>');
});
});
</script>
<style>
    .slick-arrows-container span {
        background-image: url('<?php echo get_stylesheet_directory_uri().'/img/arrows.svg'; ?>');
    }

</style>