<?php 

/**
 * @package WordPress
 * @subpackage Shemetov
 * @since 1.0
 */

?>

<!DOCTYPE html>
<html >
<head>
    <?php wp_head(); ?>	
    <meta charset="UTF-8" />	
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body <?php body_class(); ?>>
	<header>
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</header>