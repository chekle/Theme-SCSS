<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-12">
			<?php if (have_posts()) : ?>

				<?php while (have_posts()) : the_post(); ?>

					<div itemscope="" itemtype="http://schema.org/BlogPosting">
						<article class="entry">
		          <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>" itemprop="url"><span itemprop="name headline"><?php the_title(); ?></span></a></h1>
							<time datetime="<?php the_time('F jS, Y') ?>" itemprop="datePublished"><small><?php the_time('F jS, Y') ?></small></time>
							<span itemprop="description"><?php the_content('Read the rest of this entry &raquo;'); ?></span>
							<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>" itemprop="url">Read More</a>
						</article>
					</div>

				<?php endwhile; ?>

				<div class="navigation">
					<div class="alignleft-page"><?php next_posts_link('&laquo; Older Entries') ?></div>
					<div class="alignright-page"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
				</div>

			<?php endif; ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
