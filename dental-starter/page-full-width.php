<?php

/* Template Name: Full-Width Page */

get_header(); 

?>
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
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1">
                    <div class="content-block">
                        <section itemprop="articleBody">
                            <?php the_content(); ?>
                        </section>
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
</div>
<?php get_footer(); ?>