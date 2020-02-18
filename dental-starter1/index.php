<?php get_header(); ?>
<div class="body-bg blog-body-bg">
    <div class="container page-container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-push-4">
            	<div class="content-block">
                  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
                      <div class="row">
                          <div class="col-xs-12">
                              <?php if (is_single()) { ?>
                                  <?php if ( has_post_thumbnail() ) { ?>
                                      <div class="blog-banner">
                                          <?php the_post_thumbnail('Large', array('class'=>'img-responsive')); ?>
                                      </div><!-- /page-thumbnail -->
                                  <?php } ?>
                                  <h1 class="single-title"><?php the_title(); ?></h1>
                              <?php } else { ?>
                                  <div class="blog-title"><a href="<?php the_permalink(); ?>" rel="Bookmark" title="Permalink this article"><?php the_title(); ?></a></div>
                              <?php } ?>
                          
                              <div class="upper-meta">added on: <em><?php echo get_the_date(); ?></em></div>
                              
                              <?php if ( is_home() ) : ?> 
                                  <?php if ( has_post_thumbnail() ) { ?>
                                      <div class="pull-left margin-right">
                                          <?php the_post_thumbnail(array(120,120), array('class'=>'img-thumbnail')); ?>
                                      </div>
                                  <?php } ?>
                                  <div><?php the_excerpt(); ?></div>
                                  
                              <?php elseif ( is_category() ) : ?>
                          
                                  <?php if ( has_post_thumbnail() ) { ?>
                                      <div class="pull-left margin-right">
                                          <?php the_post_thumbnail(array(120,120), array('class'=>'img-thumbnail')); ?>
                                      </div>
                                  <?php } ?>
                          
                                  <div><?php the_excerpt(); ?></div>
                          
                              <?php elseif ( is_single() ) : ?>
                                  <div class="blog-content"><?php the_content(); ?></div>
                              <?php endif; ?>
                              <div class="clearfix"></div>
                              <div class="lower-meta">Posted In: <?php the_category(', '); ?></div>
                          </div>
                      </div>
                      <div class="row">
                      		<div class="col-lg-12">
                            	<hr/>
                            </div>
                      </div>
                  <?php endwhile; else: ?>
                  <div class="row">
                      <div class="col-xs-12">
                          <h2>Sorry, that page doesn't seem to exist.</h2>
                          <h3>Try searching</h3>
            
                          <?php get_search_form(); ?>
                          <br />
                          <h3>Or navigate to another page.</h3>
                          <ul>
                              <?php wp_list_pages('title_li=&depth=1'); ?>
                          </ul>
                      </div>
                  </div>
                  <?php endif; ?>
                  <?php wp_reset_query(); ?>
                  <?php if(is_single()) { // single-view navigation ?>
                      <?php $posts = query_posts($query_string); if (have_posts()) : while (have_posts()) : the_post(); ?>
                          <div class="next-prev-nav">
                              <div class="prev-s"><?php previous_post_link('%link', '&larr; Previous Post'); ?></div>
                              <div class="next-s"><?php next_post_link('%link', 'Next Post &rarr;'); ?></div>
                          </div><!-- /next-prev-nav -->
                      <?php endwhile; endif; ?>
                  <?php } else { // archive view navigation ?>
                          <?php posts_nav_link(); ?>
                  <?php } ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-pull-8">
                <?php get_sidebar('sidebar')?>
            </div>
        </div>
    </div>
</div>	
<?php get_footer(); ?>