<?php get_header() ?>
<?php get_sidebar() ?>
<div class="col-9">
	<div class="row">
		<div class="col-10">
			<div class="row">
				<div class="hero-slider col-12" >
				<!-- This is the home slider (slickjs) -->
				
					<?php
				
					$args1 = array(
						'category_name' => 'home_slider',
						'posts_per_page' => 5
					);
					// The Query
					
					
					$the_query = new WP_Query( $args1 ); ?>
				
					<?php if ( $the_query->have_posts() ) : ?>
					
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<div><?php the_post_thumbnail('large'); ?></div>
						<?php endwhile; ?>
					
						<?php wp_reset_postdata(); ?>
					
					<?php else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>
				</div> <!-- end hero slider -->
			</div>
			
			<div class="row">
				<div class="col-6 recent_posts">
				<!-- Recent Posts -->
					<h2>Recent Posts</h2>
					<?php
				
					$args2 = array(
						'post_type' => 'post',
						'category_name' => 'blog',
						"orderby" => array('date' => 'DESC'),
						'posts_per_page' => 3
					);
					
					$the_query = new WP_Query( $args2 ); ?>
				
					<?php if ( $the_query->have_posts() ) : ?>
					
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<div class="row">
								<div class="col-5"><?php the_post_thumbnail("thumbnail") ?></div>
								<div class="col-7">
									<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<small><?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?></small>
									<div class="entry"><?php the_excerpt(); ?></div>
								</div>
							</div>
						<?php endwhile; ?>
					
						<?php wp_reset_postdata(); ?>
					
					<?php else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>
				</div> <!-- end recent posts -->
				
				<div class="col-6">
				<!-- Recent Posts -->
					<h2>Upcoming Events</h2>
					<?php
				
					$args3 = array(
						'post_type' => 'post',
						'category_name' => 'event',
						"orderby" => array('date' => 'DESC'),
						'posts_per_page' => 3
					);
					
					$the_query = new WP_Query( $args3 ); ?>
				
					<?php if ( $the_query->have_posts() ) : ?>
					
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<div class="row">
								<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
								<div class="entry"><?php the_excerpt(); ?></div>
							</div>
						<?php endwhile; ?>
					
						<?php wp_reset_postdata(); ?>
					
					<?php else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>
				</div> <!-- end Upcoming Events -->
			</div>
		</div>
	</div>
</div> <!-- end col-9 -->

<?php get_footer() ?>