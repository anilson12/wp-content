<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Murpheys
 * @since 2017 0.1
 */

get_header();
get_sidebar(); ?>


<div class='col-9'>

	
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<h1>Archive</h1>
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<h2><?php the_title(); ?></h2>
				<?php the_post_thumbnail(); ?>
				<?php the_content(); ?>
				<?php the_time(); ?>
    
			<?php endwhile; else: ?>
				<?php _e( 'Sorry, no posts matched your criteria.', 'textdomain' ); ?>
			<?php endif; ?>

		</main>
	</section>
</div>
<?php get_footer(); ?>