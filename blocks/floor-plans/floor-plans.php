<?php
/**
 * Copy Block Block Template.
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
$class_name = '';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

?>
<?php
$featured_plans = get_field('floor_plans');

if( $featured_plans ): ?>
    <div class="floor-plans--grid <?php echo esc_attr( $class_name ); ?>" >
    <?php foreach( $featured_plans as $plan ): 
        $permalink = get_permalink( $plan->ID );
        $title = get_the_title( $plan->ID ); 
        $display_name = get_field('display_name', $plan->ID);
        $planthumb = get_field('floor_plan_image', $plan->ID); 
        $starting_price = get_field('starting_price', $plan->ID); 
        $bed_bath = get_field('bed_bath', $plan->ID); 
        $square_feet = get_field('square_feet', $plan->ID); 
        $planurl = get_field('downloadable_floor_plan', $plan->ID); 

        
        ?>
        <div class="floor-plans--plan">
            <h3 class="floor-plans--subheading">
                <?php if(get_field('display_name', $plan->ID)){
                    echo esc_html( $display_name );
                }else{
                    echo esc_html( $title );
                }?>
                    
                <?php the_field('display_name'); ?>
                <br>
                <span><?php echo esc_html( $bed_bath );?></span>
            </h3>
            <?php ?>
            <div class="floor-plans--thumbnail">
                <?php echo wp_get_attachment_image($planthumb, 'large'); ?>
            </div>
            <?php if($starting_price): ?>
            <div class="floor-plans--price">
                <div class="floor-plans--price-label">
                    Starting at
                </div>
                <div class="floor-plans--price-number">
                    <?php echo esc_html( $starting_price );?>
                </div>
            </div>
            <?php endif; ?>
            <!-- <div class="floor-plans--beds">
            
            </div> -->
            <div class="floor-plans--feet">
                <?php echo esc_html( $square_feet );?> SQ FT
            </div>
            <div class="floor-plans--cta">
                <a href="<?php echo $planurl; ?>" class="button" target="_blank">View Floor Plan</a>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <?php 
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); ?>
<?php endif; ?> 