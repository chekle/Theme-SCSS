<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();?>

<?php if (have_posts()) : ?>

	<section id="blog-header" class="margin">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1>
						<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
						<?php /* If this is a category archive */ if (is_category()) { ?>
							Archive for the &#8216;<?php single_cat_title(); ?>&#8217; is_category>
						<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
							Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;
						<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
							Archive for <?php the_time('F jS, Y'); ?>
						<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
							Archive for <?php the_time('F, Y'); ?>
						<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
							Archive for <?php the_time('Y'); ?>
						<?php /* If this is an author archive */ } elseif (is_author()) { ?>
							Author Archive
						<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
							Blog Archives
						<?php } ?>
					</h1>
				</div>
			</div>
		</div>
	</section>

	<section id="blog-archive" class="margin">
		<div class="container">
			<div class="row">
				<?php while (have_posts()) : the_post(); ?>
					<div class="col-12">
						<a href="<?php the_permalink() ?>" class="blog-item">
							<h3><?php the_title(); ?></h3>
							<small><?php the_time('l, F jS, Y') ?></small>
							<div class="entry">
								<?php the_content(); ?>
							</div>
							<p class="meta"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?></p>
						</a>
					</div>
				<?php endwhile; ?>
				<div class="col-12">
					<div class="navigation">
						<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
						<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php endif?>

<?php get_footer(); ?>