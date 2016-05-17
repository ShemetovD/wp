<?php 

/**
 * @package WordPress
 * @subpackage Shemetov
 * @since 1.0
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php
	               the_title( );
                   the_content();
                   the_author();

                   wp_list_categories();
                   the_tags();
?>

</article>