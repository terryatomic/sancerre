<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bootstrap_version = get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' );
$navbar_type       = get_theme_mod( 'understrap_navbar_type', 'collapse' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
<!-- <script src="https://tools.roobrik.com/widget/widgetjsv2?id=62952a60-ae29-4536-9773-76e782729395&oid=rbWidget_light_left_seniorliving"></script>
<script src="https://tools.roobrik.com/widget/widgetjsv2?id=402e8a2f-71bc-4be1-94ea-91593c396a55&oid=rbWidget_dark_left_seniorliving"></script>
<script src="https://tools.roobrik.com/widget/widgetjsv2?id=5cb0f6ee-15b4-432e-8aac-ae4e1caa1794&oid=rbWidget_light_center_seniorliving"></script> -->
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>

<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<header id="wrapper-navbar">

		<a class="skip-link <?php echo understrap_get_screen_reader_class( true ); ?>" href="#content">
			<?php esc_html_e( 'Skip to content', 'understrap' ); ?>
		</a>

		<?php get_template_part( 'global-templates/navbar', $navbar_type . '-' . $bootstrap_version ); ?>

	</header><!-- #wrapper-navbar -->
<div class="fixed-header-spacer"></div>