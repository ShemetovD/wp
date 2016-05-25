<?php 

/**
 * @package WordPress
 * @subpackage Shemetov
 * @since 1.0
 */

get_header(); ?>
 
 
 
<div class="container">
        <div class="row">
            <div class="col-10">
        <?php         
            // Start the Loop.
            while ( have_posts() ) : the_post();

                /*
                 * Include the post format-specific template for the content. If you want to
                 * use this in a child theme, then include a file called called content-___.php
                 * (where ___ is the post format) and that will be used instead.
                 */


                get_template_part( 'content', get_post_format() );

                // Previous/next post navigation.
               // twentyfourteen_post_nav();

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
            endwhile;
        ?>
            </div>
            <div class="col-2">
                <?php get_sidebar(); ?> 
            </div>
        </div><!-- .site-main -->
    </div>
 
 
 <?php get_footer(); ?>