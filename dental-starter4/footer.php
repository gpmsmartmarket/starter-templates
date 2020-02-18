<?php 
  $args = array( 'post_type' => 'callouts', 'posts_per_page' => 4, 'order' => 'ASC', 'orderby' => 'menu_order' );
  $loop = new WP_Query( $args ); 
  $i = 1;
  if ($loop->post_count <= 2) {
      $numPerRow = 2;
  } elseif ($loop->post_count <= 3) {
      $numPerRow = 3;
  } elseif ($loop->post_count <= 4) {
      $numPerRow = 4;
  } else {
      $numPerRow = 3;
  }
?>
<?php if (of_get_option('disable_footer_callouts') != 1 && $loop->post_count >= 1) : ?>
<div class="callout-bar">
    <div class="callout-outer">
        <div class="container">
          <div class="row">
              <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                  <?php echo '<div class="col-xs-12 col-sm-12 col-md-'.(12/$numPerRow).' col-lg-'.(12/$numPerRow).'">'; ?>
                  	<?php 
    					$callout_link = get_field('callout_link_url'); 
    					$callout_text = get_field('callout_link_text');
    				?>
                	<div class="callout-box">
                		<?php if(!empty($callout_link)) { echo '<a href="'.$callout_link.'">'; } ?>
							<?php echo get_the_post_thumbnail($post->ID,'full', array('class'=>'img-responsive img-circle callout-img')); ?>
                        <?php if(!empty($callout_link)) { echo '</a>'; } ?>
                        <div class="callout-head">
                            <?php if(!empty($callout_link)) { echo '<a href="'.$callout_link.'">'; } ?>
                                <?php the_title(); ?>
                            <?php if(!empty($callout_link)) { echo '</a>'; } ?>
                        </div>
                        <div class="callout-body">
                            <?php the_content(); ?>
                        </div>
                        <div class="callout-label">
                        	<?php if(!empty($callout_link)) { echo '<a href="'.$callout_link.'">'; } ?>
                        		<?php if(!empty($callout_text)) { echo $callout_text; } else { echo 'Learn More'; } ?>
                            <?php if(!empty($callout_link)) { echo '</a>'; } ?>
                        </div>
                    </div>
                  <?php echo '</div>'; ?> 
                  <?php if($i % $numPerRow == 0) {echo '</div><div class="row callout-row">';} ?>
                    <?php $i++; ?> 
               <?php endwhile; wp_reset_query();?>
          </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php
    $contact_name = contact_detail('practice_name', '' , '', false);
    $contact_tagline = contact_detail('practice_tagline', '' , '', false);
    $contact_fax = contact_detail('fax', '' , '', false);
    $contact_line1 = contact_detail('address_line_1', '' , '', false);
    $contact_line2 = contact_detail('address_line_2', '' , '', false);
    $contact_city = contact_detail('address_city', '' , '', false);
    $contact_state = contact_detail('address_state', '' , '', false);
    $contact_zipcode = contact_detail('address_zipcode', '' , '', false);
    $phone_new = contact_detail('phone_new', '' , '', false);
    $phone_current = contact_detail('phone_current', '' , '', false);
    $google_maps = contact_detail('google_maps', '' , '', false);
?>
<footer>
    <div class="footer-bar">
        <div class="container-fluid">   
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-6 f-contact-right">
                    <div class="f-outer">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="contact-box">
                                    <address>
                                        <div class="f-name">
                                            <span>
                                                <?php
                                                    if (!empty($contact_name)) {
                                                        echo $contact_name;    
                                                    }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="f-subname">
                                            <span>
                                                <?php
                                                    if (!empty($contact_tagline)) {
                                                        echo $contact_tagline;    
                                                    }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="f-address">
                                            <span>
                                                <?php echo $contact_line1; ?>
                                                <?php
                                                    if (!empty($contact_line2)) {
                                                        echo '<br/>'.$contact_line2;    
                                                    }
                                                ?>
                                            </span><br/>
                                            <span><?php echo $contact_city; ?></span>,
                                            <span><?php echo $contact_state; ?></span>
                                            <span><?php echo $contact_zipcode; ?></span>
                                        </div>
                                    </address>
                                    <address>
                                        <?php if (!empty($phone_new)) : ?>
                                            <div class="f-phone">
                                                New Patients<br/><a href="tel:<?php echo $phone_new; ?>"><span><?php echo $phone_new; ?></span></a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($phone_new)) : ?>
                                            <div class="f-phone">
                                                Current Patients<br/><a href="tel:<?php echo $phone_current; ?>"><span><?php echo $phone_current; ?></span></a>
                                            </div>
                                        <?php else: ?>
                                            <div class="f-phone">
                                                Phone<br/><a href="tel:<?php echo $phone_current; ?>"><span><?php echo $phone_current; ?></span></a>
                                            </div>
                                        <?php endif; ?>
                                            
                                    </address>
                                    <?php if (!empty($contact_fax)) : ?>
                                        <address class="f-fax">
                                            <span>Fax: <?php echo $contact_fax; ?></span>
                                        </address>
                                    <?php endif; ?>
                                </div> 
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="footer-links">
                                    <?php 
                                        wp_nav_menu( array(
                                        'theme_location' => 'Footer Menu',
                                        'depth'      => 1,
                                        'container'  => false,
                                        'menu_class' => 'footer-menu nav nav-stacked',
                                        'fallback_cb'    => '__return_false')
                                        );
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6">
                    <div class="f-map-outer">
                    <?php
                        if (!empty($google_maps)) {
                            echo '<iframe src="'.$google_maps.'" class="f-map" frameborder="0" allowfullscreen></iframe>';    
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        $phone_new = contact_detail('phone_new', '' , '', false);
    ?>
    <?php if (!empty($phone_new)) : ?>
        <div class="f-social-links">
            <?php get_template_part( 'partials/svg','declaration'); ?>
        </div>
    <?php endif; ?>
    <div class="footer-copyright">
        <div class="container"> 
        	<div class="row">
            	<div class="col-xs-12">
                	<?php 
                        wp_nav_menu( array(
                        'theme_location' => 'Courtesy Menu',
                        'depth'      => 1,
                        'container'  => false,
                        'menu_class' => 'courtesy-menu',
                        'fallback_cb'    => '__return_false')
                        );
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <p class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> - Designed &amp; Developed by <a href="http://www.goldenproportions.com" target="_blank">Golden Proportions Marketing</a> - <?php wp_loginout(); ?></p>
                </div>
            </div>
        </div>
    </div>
</footer>       
<?php wp_footer(); ?>
</body>
</html>
