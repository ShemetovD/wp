<?php

/**
 * The template for displaying Category pages 
 * @package WordPress
 * @subpackage Shemetov
 * @since 1.0
 */

get_header(); ?>

	<div  class="content-area">
		<main  class="site-main">

		<?php if ( have_posts() ) : ?>

		<h1 class="archive-title"><?php  single_cat_title( '', true ); ?></h1>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>
				
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				
				
				<?php
					the_title();	
                	//the_content();
                	the_excerpt();
                ?>

                <small><?php the_time('F jS, Y') ?> by <?php the_author() ?></small>

			<?php endwhile;

			// Previous/next page navigation.
			next_posts_link();
			previous_posts_link();

		else :?>
			<p><?php _e( 'Sorry, no posts matched your criteria' ); ?></p>
		<?endif;
		?>

		</main>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
