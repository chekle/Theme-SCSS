<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>
</div><!-- #wrap -->

<footer id="footer">
  <section id="footer-body">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="left">
            <img src="<?php bloginfo('template_directory'); ?>/images/logo.svg"/>
          </div>
          <div class="right">
            <div class="social">
              <?php if ( get_field('facebook', 'option') ) : ?>
                <a href="<?php echo get_field('facebook', 'option'); ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a>
              <?php endif; ?>
              <?php if ( get_field('instagram', 'option') ) : ?>
                <a href="<?php echo get_field('instagram', 'option'); ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>
              <?php endif; ?>
              <?php if ( get_field('twitter', 'option') ) : ?>
                <a href="<?php echo get_field('twitter', 'option'); ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-twitter"></i></a>
              <?php endif; ?>
              <?php if ( get_field('linkedin', 'option') ) : ?>
                <a href="<?php echo get_field('linkedin', 'option'); ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-linkedin"></i></a>
              <?php endif; ?>
            </div>
            <div class="contact-info">
              <?php if ( get_field('phone_number', 'option') ) : ?>
                <?php $string = get_field('phone_number', 'option'); $string = str_replace(' ', '', $string); ?>
                <a href="tel:<?php echo $string; ?>"><i class="fa-light fa-phone"></i>
                  <?php echo get_field('phone_number', 'option'); ?>
                </a>
              <?php endif; ?>
              <?php if ( get_field('email_address', 'option') ) : ?>
                <a href="mailto:<?php echo get_field('email_address', 'option'); ?>"><i class="fa-light fa-envelope"></i>
                  <?php echo get_field('email_address', 'option'); ?>
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="footer-terms">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="left">
            <span>&copy; Copyright <?php echo date("Y"); ?> Website Name </span>
            <?php wp_nav_menu( array('theme_location' => 'footer-menu', 'container' => 'nav', 'container_class' => 'footer-menu')); ?>
          </div>
          <div class="right">
            <a href="http://www.metadigital.co.nz" target="_blank" class="site-by">Website Design By: Meta Digital</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</footer>

<?php wp_footer(); ?>

  </body>
</html>