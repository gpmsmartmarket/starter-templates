<?php

/* Template Name: Home (Static Banner) */

get_header(); 

?>
<?php if ( has_post_thumbnail() ) { ?>
	<div class="page-banner home-flex">
    <div class="container-fluid">
      <div class="row flexbox">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
          <?php the_post_thumbnail('Full', array('class'=>'img-responsive')); ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 banner-text">
          <div class="banner-text-outer">
            <div class="banner-text-inner">
              <div class="banner-text-headline">
                Three Word Headline
              </div>
              <div class="banner-text-subheadline">
                Six Word Sub Headline Goes Here.
              </div>
            </div>
            <div class="banner-img">
            	<img src="<?php bloginfo('stylesheet_directory'); ?>/i/bg-header-square.jpg" class="" />
           	</div>
           	<div class="banner-img-over">
            	<img src="<?php bloginfo('stylesheet_directory'); ?>/i/bg-header-square.jpg" class="" />
           	</div>
          </div>
        </div>
      </div>
    </div>
	</div>
<?php } ?>
<div class="body-bg">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
        <article id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/WebPage">
            <div class="container">
            	<div class="row">
                	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    	<div class="content-block">
                            <header class="article-header">
                                <h1 class="home-h1 page-title" itemprop="headline">
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
                            </header>
                            <section itemprop="articleBody">
                                <?php the_content(); ?>
                            </section>
                        </div>
            		</div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    	<?php get_sidebar('sidebar')?>
                    </div>
            	</div>
            </div>
        </article>
    <?php endwhile; else: ?>    
        Sorry, there may have been a problem.
        <?php get_search_form(); ?>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
          
	<?php $home_blog_feed = of_get_option('home_blog_feed'); ?>
    <?php if ($home_blog_feed == 1) : ?>
    <div class="container">
        <div class="row">
            <?php 
                $args = array( 'post_type' => 'post', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 2 );
                $loop = new WP_Query( $args ); 
            ?>
            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <article>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                      <div class="panel panel-default blog-feed-panel">
                          <div class="panel-heading">
                              <header class="article-header">
                                  <h3 class="panel-title" itemprop="headline"><a href="<?php the_permalink(); ?>" class="blog-roll-title"><?php the_title(); ?></a></h3>
                              </header>
                          </div>
                          <div class="panel-body">
                              <section>
                                  <?php the_excerpt(); ?>
                              </section>
                          </div>
                          <div class="panel-footing">
                          		<div class="panel-date"><?php the_date(); ?></div>
                          </div>
                      </div>
                </div>
            </article>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php get_footer(); ?>