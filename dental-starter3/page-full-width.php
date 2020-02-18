<?php

/* Template Name: Full-Width Page */

get_header(); 

?>
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
        <div class="body-bg">
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
            <?php else : ?>
                <?php if (is_page() && $post->post_parent) : ?>
                <?php
                    $sibs = array();
                    array_push($sibs,$post->post_parent);
                    $siblings = get_pages(array('child_of' => $post->post_parent,'exclude' => $post->ID));
                    foreach ($siblings as $x=>$x_value) {
                        array_push($sibs,$x_value->ID);
                    }
                    $args = array( 'post_type' => 'page', 'order' => 'ASC', 'orderby' => 'menu_order', 'post__in' => $sibs);
                    $loop = new WP_Query( $args );
                ?>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="child-bar">
                                <div class="child-head">Learn More:</div>
                                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                    <a href="<?php the_permalink();?>" class="btn btn-default"><?php the_title(); ?></a>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </article>
<?php endwhile; else: ?>
    <div class="body-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-2">  
                    Sorry, there may have been a problem.
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>