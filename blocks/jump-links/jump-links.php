<?php
/**
 * Jump Link Template.
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
$class_name = 'jump-links';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

?>
 <?php if( have_rows('nav_items') ): ?>
<div class="jump-links-container <?php echo esc_attr( $class_name ); ?>">
    <nav class="community-nav ">
        <?php while( have_rows('nav_items') ) : the_row(); ?>
            <a href="<?php the_sub_field('link'); ?>"><?php the_sub_field('topic_text'); ?></a>
        <?php endwhile; ?>
    </nav>
    <div class="sectional-nav-container">
        <ul id="sectional_nav" class="list-unstyled hidden-md-up">
            <li><a href="#" id="select-topic-link" data-value="0">Select Topic</a></li>
            <div class="community-drop-menu">
                <?php while (have_rows('nav_items')) : the_row(); ?>
                
                <li><a href="<?php the_sub_field('link'); ?>"><?php the_sub_field('topic_text'); ?></a></li>
                
                <?php endwhile; ?>
            </div>
    </ul>
    </div>
<?php endif; ?>
</div>
<script>
    jQuery(document).ready(function($) {
  // When "Select Topic" link is clicked
  $('#select-topic-link').on('click', function(e) {
    e.preventDefault(); // Prevent the link from navigating
    
    // Toggle the 'sub-menu-active' class on '.community-drop-menu'
    $('.community-drop-menu').toggleClass('sub-menu-active');
    $('#select-topic-link').toggleClass('item-active')
    e.stopPropagation();
  });

  $('.community-drop-menu a').each(function() {
    $(this).on('click', function(e) {
        $('.community-drop-menu').toggleClass('sub-menu-active');
    });
});
//   $('.community-drop-menu a').on('click', function(e) {    
//     $('.community-drop-menu').toggleClass('sub-menu-active');
//   });

$(document).on('click', function(e) {
    // Check if the click target is not within '.community-drop-menu'
    if (!$(e.target).closest('.community-drop-menu').length) {
      // If clicked outside, remove the 'sub-menu-active' class
      $('.community-drop-menu').removeClass('sub-menu-active');
      $('#select-topic-link').removeClass('item-active');
    }
  });

});

    document.addEventListener('DOMContentLoaded', function() {
    var selectElement = document.getElementById('sectional_nav');

    selectElement.addEventListener('change', function() {
        console.log(this.value)
        if (this.value !== "0") {
            window.location.href = this.value; 
        }
    });
    function fixNavbar(isResizing = false){
       
        var fixedElement = document.getElementById('main-nav');
        var jumpLinksContainer = document.querySelector('.jump-links-container');

        var fixedElementBottom = fixedElement.getBoundingClientRect().bottom;
        var jumpLinksTop = jumpLinksContainer.getBoundingClientRect().top;

        var fixedElement = document.getElementById('main-nav');
        var mainNavHeight = fixedElement.offsetHeight; 

        var jumpLinksHeight = jumpLinksContainer.offsetHeight; 

        var nextSibling = jumpLinksContainer.nextElementSibling;
        while (nextSibling && nextSibling.tagName !== 'DIV') {
            nextSibling = nextSibling.nextElementSibling;
        }

        var previousSibling = jumpLinksContainer.previousElementSibling;
        while (previousSibling && previousSibling.tagName !== 'DIV') {
            previousSibling = previousSibling.previousElementSibling;
        }


        
        
        var previousSibling = jumpLinksContainer.previousElementSibling;
        while (previousSibling && previousSibling.tagName !== 'DIV') {
            previousSibling = previousSibling.previousElementSibling;
        }
        
        if (fixedElementBottom >= jumpLinksTop) {

            jumpLinksContainer.style.position = 'fixed';
            jumpLinksContainer.style.top = mainNavHeight + 'px';
            if (nextSibling) {
                nextSibling.style.marginTop = jumpLinksHeight + 'px';
            }

        }
        
        if(isResizing){
            jumpLinksContainer.style.position = 'fixed';
            jumpLinksContainer.style.top = mainNavHeight + 'px';
            if (nextSibling) {
                nextSibling.style.marginTop = jumpLinksHeight + 'px';
            }
        }
        
        var jumpLinksTop = jumpLinksContainer.getBoundingClientRect().top;
        var prevSiblingBottom = previousSibling.getBoundingClientRect().bottom;

        if (jumpLinksTop <= prevSiblingBottom) {

            // The top of jumpLinksContainer has touched or passed the bottom of previousSibling
            jumpLinksContainer.style.position = 'relative';
            jumpLinksContainer.style.top = '0px';
            if (nextSibling) {
                nextSibling.style.marginTop = '0px';
            }

        }

    }
    
    var resized = true;
window.addEventListener('scroll', function() {
    fixNavbar(); // Call without parameter for scroll events
});

window.addEventListener('resize', function() {
    fixNavbar(true); // Call with parameter for resize events
});

});
</script>
 