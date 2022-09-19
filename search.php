<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

	<div class="container">
		<div class="row justify-content-center">
			<div class="search-header col-12">
				<h1 class="underline">Search Results</h1>
				<h5>You searched for " <?php echo esc_html( get_search_query( false ) ); ?> ". Here are the results:</h5>
			</div>
			
				<?php if (have_posts()) : $i = 1;?>
					<?php while (have_posts()) : the_post(); ?>
						<div class="col-12">
							<article class="blog-article">
								<a href="<?php the_permalink() ?>" class="blog-content">
									<span class="result-num"><?php echo $i;?></span>
									<h4 class="large"><?php the_title(); ?></h4>
									<p>View more <i class="fa-light fa-arrow-right-long"></i></p>
								</a>
							</article>
						</div>
					<?php $i++;
					endwhile; ?>
					<div class="col-12">
						<div class="navigation">
							<?php previous_posts_link('<i class="fa-light fa-arrow-left-long"></i>') ?>
							<?php next_posts_link('<i class="fa-light fa-arrow-right-long"></i>') ?>
						</div>
					</div>
				<?php else : ?>
				<div class="col-12">
					<h3 class="center">No posts found. Try a different search?</h3>
					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

<?php get_footer(); ?>
