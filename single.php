<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

<main>
	<section id="blog-single" class="margin">
		<div class="container">
			<div class="row">
				<div class="col-12">
				<?php if (have_posts()) :
					while (have_posts()) : the_post(); ?>

					<article id="blog-post" itemscope="" itemtype="http://schema.org/BlogPosting">
						<h1 itemprop="name headline"><?php the_title(); ?></h1>
						<time datetime="<?php the_time('F jS, Y') ?>" itemprop="datePublished"><small><?php the_time('F jS, Y') ?></small></time>
						<div class="content" itemprop="articleBody"><?php the_content(); ?></div>
					</article>

					<div class="navigation">
						<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
						<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
					</div>

					<?php endwhile; ?>
				<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
