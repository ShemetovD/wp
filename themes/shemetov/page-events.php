<?php
/**
 * Template Name: Events page
 **/

global $post;

get_header();

 $query = new WP_Query( array('post_type' => 'events', 'posts_per_page' => 5 ) );
 while ( $query->have_posts() ) : $query->the_post(); 

echo get_the_post_thumbnail( $post->ID, array( 100, 100) );

?>

<a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>

<?php
//the_content();
the_excerpt();

echo get_post_meta($post->ID, "event_location", true);
echo get_post_meta($post->ID, "event_date", true);
echo get_post_meta($post->ID, "event_sponsor", true);



$terms = get_the_terms( $post->ID, 'period' ); 


if ( ! empty( $terms ) ) {

	foreach($terms as $term) {
      echo $term->name;
    }

}


wp_reset_postdata();
endwhile;

get_footer();

?>