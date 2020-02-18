<?php

/* Template Name: Testimonial Page */

get_header(); ?>
<?php if ( have_posts() ) :  while ( have_posts() ) :  the_post(); ?>
    <div class="body-bg">   
        <article id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/WebPage">
            <div class="header-row">
                <div class="header-row-outer">
                    <div class="header-row-inner">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <header class="article-header">
                                        <h1 class="page-title" itemprop="headline">
                                          <?php
                                            if(get_field('custom_page_headline_(h1)')) {
                                                  the_field('custom_page_headline_(h1)');
                                            } else {
                                                  the_title();
                                            }
                                          ?>
                                        </h1>
                                        <?php
                                          if(get_field('page_sub-headline_(h2)')) {
                                            $sub_headline = str_replace('[City Name]',contact_detail('address_city', '' , '', false),get_field('page_sub-headline_(h2)'));
                                            echo '<h2>'.$sub_headline.'</h2>';
                                          }
                                        ?>
                                        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
                                    </header>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="page-banner-interior">
                    <?php the_post_thumbnail('Full',array('class'=>'img-responsive')); ?>
                </div>
            <?php endif; ?>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="content-block">
                            <section itemprop="articleBody">
                                <?php the_content(); ?>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
              <div class="row">
                  <?php 
                    $args = array( 'post_type' => 'testimonials', 'order' => 'ASC' );
                    $loop = new WP_Query( $args );
                  ?>
                  <?php $y = 0; ?>
                  <?php $x = 0; ?>
                  <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2">
                        <section>
                            <div class="speech-bubble speech-bubble-nth<?php echo $x; ?>">
                            <?php if ( has_post_thumbnail() ) { ?>
                                 <?php the_post_thumbnail(array(150,150),array('class'=>'img-responsive img-thumbnail pull-left margin-right')); ?>
                            <?php } else { ?>
                                  <div class="bubble-quote">
                                    <i class="fa fa-quote-left"></i>
                                  </div>
                            <?php } ?>
                            
                            <?php the_content(); ?>
                            <h3 class="text-right bubble-attribution">- <?php the_title(); ?></h3>
                            <div class="speech-bubble-triangle"></div>
                            </div>
                        </section>
                      </div>
                      <?php $y++; ?>
                      <?php $x++; ?>
                      <?php if ($x >= 4) { $x = 0; } ?>
                      <?php if ($y % 2 == 0) { echo '</div><div class="row">'; } ?>
                  <?php endwhile; ?>
                  <?php wp_reset_query(); ?>
            </div>
        </article>
    </div>
  <?php wp_reset_query(); ?>
  <?php endwhile; ?>
<?php else: ?>
  <div class="body-bg">              
        <div class="container">
            <div class="col-xs-12">
                Sorry, there may have been a problem.
            </div>
        </div>
    </div>
<?php endif; ?> 
<?php get_footer(); ?>