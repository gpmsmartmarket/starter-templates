<?php if (is_front_page()) : ?>
		<?php dynamic_sidebar('home-sidebar'); ?>
<?php elseif (is_page()) : ?>
		<?php dynamic_sidebar('page-sidebar'); ?>
<?php else : ?>
  <ul id="bsidebar">
  	<li><?php require('searchform.php'); ?></li>
  <?php if ( !dynamic_sidebar('blog-sidebar') ) : ?>
      <h2>Recently Added</h2>
      <ul id="blog-menu">
          <li>
              <?php
              $args = array( 'numberposts' => 3 );
              $lastposts = get_posts( $args ); ?>
              
              <ul class="blog-list">
                  <?php foreach($lastposts as $post) : setup_postdata($post); ?>
                      <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br/>
                          <span class="the-date">added on: <em><?php echo get_the_date(); ?></em></span><br/><br/>
                      </li>
                  <?php endforeach; ?>
              </ul>
          </li>
      </ul>
  <?php endif; ?>
  </ul>
<?php endif; ?>

