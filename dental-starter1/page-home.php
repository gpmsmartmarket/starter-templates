<?php

/* Template Name: Home Carousel */

get_header(); 

?>
<?php 
  $args = array( 'post_type' => 'homepage-slider', 'order' => 'ASC' );
  $loop = new WP_Query( $args );
  $count = $loop->post_count;
?>
<div class="home-flex">
  <div id="owl-home" class="owl-carousel owl-carousel-narrow owl-theme">
    <?php $cnt2 = 0; ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
      <div>
        <div class="container-fluid">
          <div class="banner-text">
            <?php if ( has_post_thumbnail() ) { ?>
              <?php the_post_thumbnail('Full',array('class'=>'img-responsive')); ?>
            <?php } ?>
            <div class="banner-text-outer">
              <div class="banner-text-inner">
                <div class="banner-text-headline">
                  <?php
                    if(get_field('banner_headline')) {
                          the_field('banner_headline');
                    }
                  ?>
                </div>
                <div class="banner-text-subheadline">
                  <?php
                    if(get_field('banner_sub_headline')) {
                          the_field('banner_sub_headline');
                    }
                  ?>
                </div>
                <div class="banner-text-content">
                  <?php the_content(); ?>
                  <?php
                    if (get_field('banner_link')) {
                      echo '<a href="'.get_field('banner_link').'" class="btn btn-primary btn-lg">'.get_field('banner_link_text').'</a>';
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php $cnt2++; ?>
     <?php endwhile; ?>
     <?php wp_reset_query(); ?>     
  </div>
</div>


<?php 
    if ($count == 1) {
        $loop = 'false';
    } else {
        $loop = 'true';
    }
?>
<script type="text/javascript">
    $(document).ready(function() {  
        $("#owl-home").owlCarousel({
            loop:<?php echo $loop; ?>,
            margin:10,
            nav:true,
            autoHeight:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            },
            navText: [
                "<i class='fa fa-arrow-circle-left'></i>",
                "<i class='fa fa-arrow-circle-right'></i>"
            ]
        });   
    });
</script>

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