<?php
/**
 * Icon Grid Block Template.
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
$class_name = 'amenity-list';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

    $allowed_blocks = array( 'core/list' );
    $itemsOnMobile = get_field('items_on_mobile');
    $button = get_field('see_more_button_text');

?>
<section id="amenity-list-id" <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?><?php if(get_field('gray_background')): echo ' bg-alt'; endif; ?>">

    <div class="container">
        <InnerBlocks allowedBlocks="<?php echo esc_attr(wp_json_encode($allowed_blocks)); ?>" />

        <button id="show-amenities"><?php echo $button ?></button>
    </div>

</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initial calculations
    var itemsOnMobile = parseInt(<?php echo json_encode(get_field('items_on_mobile')); ?>, 10) || 0;
    var amenityList = document.querySelector('.amenity-list'); 
    var liElements = amenityList.querySelectorAll('li');
    var liCount = liElements.length;
    var innerBlocksContainer = amenityList.querySelector('.acf-innerblocks-container');
    var totalHeight = 0;
    var amenityListId = document.querySelector('#amenity-list-id');

    for (let i = 0; i < itemsOnMobile; i++) { 
        totalHeight += liElements[i].clientHeight;
        innerBlocksContainer.style.height = totalHeight + 'px'; 
    }

    var button = amenityList.querySelector('#show-amenities'); // Replace with the actual button selector or ID

    button.addEventListener('click', function () {
        // Your onclick event code here
        amenityList.classList.toggle('show-more');
        if (amenityList.classList.contains('show-more')) {
            innerBlocksContainer.style.height = 'auto'; 
            button.textContent = 'See Less'; // Change button text to "See Less"
           

        } else {
            innerBlocksContainer.style.height = totalHeight + 'px'; 
            button.textContent = 'See More'; // Change button text back to "See More"
            window.scrollTo({
                    top: amenityListId.offsetTop - 100,
                    behavior: 'smooth'
                });
        }
    });

    // Recalculate heights on window resize
    window.addEventListener('resize', function () {
        totalHeight = 0;
        for (let i = 0; i < itemsOnMobile; i++) {  
            totalHeight += liElements[i].clientHeight;
        }

        // Update the height property of innerBlocksContainer
        if (!amenityList.classList.contains('show-more')) {
            innerBlocksContainer.style.height = totalHeight + 'px';
        }
    });
});

</script>