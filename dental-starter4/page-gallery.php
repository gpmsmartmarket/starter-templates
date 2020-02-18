<?php
	/* Template Name: Smile Gallery */
	get_header(); 
?>
<?php if ( have_posts() ) :  while ( have_posts() ) :  the_post(); ?>	
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
            <div class="body-bg">   
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
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1">
            				<?php 
            					$args = array( 'post_type' => 'gallery', 'order' => 'ASC' );
            					$loop = new WP_Query( $args );
                                $count = $loop->post_count;
            				?>
            				<section>
            					<div id="owl-smile" class="owl-carousel owl-carousel-narrow owl-theme">
            						<?php $cnt2 = 0; ?>
            						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
            							<div>
            							  <?php
            								  $children = get_children( 'post_type=attachment&post_mime_type=image&output=ARRAY_N&orderby=menu_order&order=DESC&posts_per_page=-1&post_parent='.$post->ID);
            								  $num_children = count($children);
            								  if ($num_children == 1) {
            									  $num_children = 1;
            								  } else if ($num_children % 3 == 0) {
            									  $num_children = 3;
            								  } elseif ($num_children % 2 == 0) {
            									  $num_children = 2;
            								  } else {
            									  $num_children = 2;
            								  }	
            							  ?>
            							  <?php echo do_shortcode('[gpm-gallery numperrow="'.$num_children.'" imgthumb="full"]'); ?>
            							  <h3><?php the_title(); ?></h3> 
            							  <?php the_content(); ?>
            							</div>
            							<?php $cnt2++; ?>
            						 <?php endwhile; ?>
            						 <?php wp_reset_query(); ?>     
            					</div>
            				</section>
                            <?php 
                                if ($count == 1) {
                                    $loop = 'false';
                                } else {
                                    $loop = 'true';
                                }
                            ?>
                            <script type="text/javascript">
                                $(document).ready(function() {  
                                    $("#owl-smile").owlCarousel({
                                        loop:<?php echo $loop; ?>,
                                        margin:10,
                                        nav:true,
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
                                            "<i class='fa fa-chevron-left'></i>",
                                            "<i class='fa fa-chevron-right'></i>"
                                        ]
                                    });   
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </article>
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