<?php get_header(); ?>
<div class="body-bg">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
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
        <?php if ( has_post_thumbnail() ) { ?>
            <div class="page-banner-interior">
              <?php the_post_thumbnail('Full', array('class'=>'img-responsive')); ?>
            </div>
        <?php } ?>
        <div class="container page-container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="content-block">
                        <section itemprop="articleBody">
                            <?php the_content(); ?>
                        </section>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="content-block">
                        <aside>
                        	<?php
                              if(get_field('sidebar_shortcode')) {
								echo do_shortcode(get_field('sidebar_shortcode'));
                              }
                            ?>
							<?php get_sidebar('sidebar')?>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; else: ?>    
        Sorry, there may have been a problem.
        <?php get_search_form(); ?>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
    </article>
    <?php 
        $page_query = new WP_Query('post_type=page&post_parent='.$post->ID.'&order=ASC&orderby=menu_order');
        $child_count = $page_query->post_count;
    ?>
    <?php if ($child_count >= 1) : ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="child-bar">
                        <div class="child-head">Learn More:</div>
                        <?php while ($page_query->have_posts()) : $page_query->the_post(); ?>
                            <a href="<?php the_permalink();?>" class="btn btn-default"><?php the_title(); ?></a>
                        <?php endwhile; ?>
                        <?php wp_reset_query(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php get_footer(); ?>