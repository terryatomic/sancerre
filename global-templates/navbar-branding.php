<?php
/**
 * Navbar branding
 *
 * @package Understrap
 * @since 1.2.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! has_custom_logo() ) { ?>


		<h1 class="navbar-brand mb-0">
			<a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url">
				<img src="<?php echo get_stylesheet_directory_uri()?>/img/reserve-logo.svg">
			</a>
		</h1>


	<?php
} else {
	the_custom_logo();
}
