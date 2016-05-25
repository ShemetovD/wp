<?php 

/**
 * @package WordPress
 * @subpackage Shemetov
 * @since 1.0
 */
global $post;
?>



<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php
	the_title( );
    the_content();
?>
        <div class="row">
        	<div class="col-4">
        		<span>Author: </span><?php the_author();?>
        	</div>
            <div class="col-4 categories_list">
            	<?php echo get_the_category_list( ',', $post->ID ); ?>
             </div>
             <div class="col-4">
             	<?php the_tags();?>
             </div>
        </div>


</article>