<?php

/* Template Name: Contact Page */

get_header(); ?>
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
<div class="maps-box">
    <?php
        if (!empty($google_maps)) {
            echo '<iframe src="'.$google_maps.'" width="100%" height="550" frameborder="0" style="border:0" allowfullscreen></iframe>';    
        }
    ?>
</div>
<div class="body-bg contact-body-bg">
    <div class="container" id="b-container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-md-push-7" id="contact-sidebar">
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
                            <div class="content-block">
                                <?php if ( has_post_thumbnail() ) { ?>
                                        <div class="page-thumbnail">
                                            <?php the_post_thumbnail(array(400,400)); ?>
                                        </div>   
                                <?php } ?>
                                <?php the_content(); ?>
                                <div>
                                <address>
                                	<div class="contact-name">
										<?php
                                            if (!empty($contact_name)) {
                                                echo $contact_name;    
                                            }
                                        ?>
                                    </div>
                                    <div class="contact-subname">
										<?php
                                            if (!empty($contact_tagline)) {
                                                echo $contact_tagline;    
                                            }
                                        ?>
                                    </div>
                                    <div class="contact-address">
                                        <span><?php echo $contact_line1; ?>
                                        <?php
                                            if (!empty($contact_line2)) {
                                                echo '<br/>'.$contact_line2;	
                                            }
                                        ?></span><br/>
                                        <span><?php echo $contact_city; ?></span>,
                                        <span><?php echo $contact_state; ?></span>
                                        <span><?php echo $contact_zipcode; ?></span>
                                    </div>
                                </address>
                                <address>
                                    <?php if (!empty($phone_new)) : ?>
                                        <div class="c-phone">
                                        	New Patients<br/>
                                            <a href="tel:<?php echo $phone_new; ?>"><span><?php echo $phone_new; ?></span></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($phone_new)) : ?>
                                    	<div class="c-phone">
                                        	Current Patients<br/>
                                            <a href="tel:<?php echo $phone_current; ?>"><span><?php echo $phone_current; ?></span></a>
                                        </div>
                                    <?php else: ?>
                                    	<div class="c-phone">
                                        	Phone<br/>
                                        	<a href="tel:<?php echo $phone_current; ?>"><span><?php echo $phone_current; ?></span></a>
                                      	</div>
                                    <?php endif; ?>
                                </address>
                                <?php if (!empty($contact_fax)) : ?>
                                    <address>
                                        <span>Fax: <?php echo $contact_fax; ?></span>
                                    </address>
                                <?php endif; ?>
                                <div class="c-hours">
									<?php echo do_shortcode('[widget widget_name="practice_hours"]'); ?>
                                </div>
                                </div>
                            </div>
                        <?php endwhile; endif; ?>
                        <?php wp_reset_query(); ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-md-pull-5">
                    <div class="contact-form-outer">
                        <?php echo do_shortcode('[gravityform id="1" name="Contact Us" title="false" description="true"]'); ?><br/><br/>
                    </div>
                </div>
          </div>
    </div>
</div>
<?php get_footer(); ?>