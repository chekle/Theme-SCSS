<?php if( have_rows('content_components') ): while ( have_rows('content_components') ) : the_row(); ?>

  <?php if( get_row_layout() == 'content_editor' ): ?>
  <?php get_template_part('components/content_editor');?>

  <?php elseif( get_row_layout() == '' ): ?>
  <?php get_template_part('components/');?>

<?php endif; ?>

<?php endwhile; endif;?>