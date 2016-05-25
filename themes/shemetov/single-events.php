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

              echo "<div class='event_item'>";
        echo "<div class='row'>";
        echo "<div class='col-5' >";
        echo get_the_post_thumbnail( $post->ID, array( 300, 300) );
        echo "</div>";

        ?>
        <div class="col-7">
        <?php echo get_the_title(); ?>

        <?php
        the_content();
        //the_excerpt();
        ?>

        </div>
    </div>

    <div class="row">
        <?php
        $meta = new stdClass;
        foreach( get_post_meta( $post->ID ) as $k => $v )
            $meta->$k = $v[0];
        ?>

        <div class="col-4"><?php if ( ! empty( $meta->event_location ) ){
            echo 'Location: ' . $meta->event_location;
        } ?>
        </div>
        <div class="col-4"><?php if ( ! empty( $meta->event_date ) ){
            echo 'Date: ' . $meta->event_date;
        } ?>
        </div>
        <div class="col-4"><?php if ( ! empty( $meta->event_sponsor ) ){
            echo 'Sponsor: ' . $meta->event_sponsor;
        } ?>
        </div>


    </div>

    <div class="row">
        <?php
    $terms = get_the_terms( $post->ID, 'period' ); 


    if ( ! empty( $terms ) ) {

        foreach($terms as $term) {
          echo "<div class='col-3'>";
          echo  'Period:'.$term->name ;
          echo "</div>";
        }

    }
    ?>
    </div>
<?php
wp_reset_postdata();
?>
</div>
<?php

            endwhile;
        ?>
            </div>
            <div class="col-2">
                <?php get_sidebar(); ?> 
            </div>
        </div><!-- .site-main -->
    </div>
 
 
 <?php get_footer(); ?>