<!DOCTYPE html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php wp_title(''); ?></title>
    
    <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />

    <?php wp_head(); ?>
    <?php get_wpbs_theme_options(); ?>
    
    <!-- css3-mediaqueries.js for IE less than 9 -->
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    
    <!-- html5.js for IE less than 9 -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->

    <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans" rel="stylesheet">

    
</head>

<body <?php body_class();?>>
<div class="header">
    <div data-spy="affix" data-offset-top="200" data-offset-bottom="200">
        <?php if (!is_front_page()) : ?>
            <div class="top-bar">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                            $phone_new = contact_detail('phone_new', '' , '', false);
                            $phone_current = contact_detail('phone_current', '' , '', false);
                            $address_short = contact_detail('address_short', '' , '', false);
                        ?>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="text-left">
                                <?php if (!empty($phone_new)) : ?>
                                    New Patients: <a href="tel:<?php echo $phone_new; ?>"><?php echo $phone_new; ?></a>&nbsp;|&nbsp;
                                    Current Patients: <a href="tel:<?php echo $phone_current; ?>"><?php echo $phone_current; ?></a>
                                <?php else: ?>
                                    Phone: <a href="tel:<?php echo $phone_current; ?>"><?php echo $phone_current; ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="text-right">
                                <?php echo $address_short; ?>&nbsp;-&nbsp;<a href="<?php echo esc_url( get_permalink(get_page_by_title('Contact Us'))); ?>">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="navbar navbar-default">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                        <?php $logo_header = of_get_option('logo_header');
                          if ($logo_header) { ?>
                           <a class="main-logo" href="<?php echo get_option('home'); ?>" title="<?php bloginfo('name'); ?>">
                                <img src="<?php echo $logo_header; ?>" alt="<?php bloginfo('name'); ?>" class="img-responsive"/>
                           </a>
                        <?php } else { ?>
                            <a class="main-logo" href="<?php echo get_option('home'); ?>" title="<?php bloginfo('name'); ?>">
                                <img src="<?php bloginfo('template_url'); ?>/i/logo.png" alt="<?php bloginfo('name'); ?>" class="img-responsive"/>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                        <nav role="navigation">
                          <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span>Menu</span>
                              </button>
                          </div>
                    
                          <!-- Collect the nav links, forms, and other content for toggling -->
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <?php 
                                    wp_nav_menu( array(
                                    'theme_location'       => 'Main Menu',
                                    'depth'      => 3,
                                    'container'  => false,
                                    'menu_class' => 'nav navbar-nav',
                                    'walker' => new twitter_bootstrap_nav_walker(),
                                    'fallback_cb'    => '__return_false')
                                    );
                                ?>
                           </div>
                        </nav>
                    </div>
                </div>
          </div>
        </div>
    </div>
</div>

