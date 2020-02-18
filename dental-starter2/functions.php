<?php

require_once('partials/options-panel.php');

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_post_type_support('page', 'excerpt');

function custom_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_action( 'widgets_init', 'unregister_search' );

function unregister_search() {
	unregister_widget( 'WP_Widget_Search' );
}

if (!function_exists('gpm_enque')) {
	function gpm_enque(){
		if (!is_admin()) {
			wp_deregister_script( 'jquery' );
			 
			wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array(), null, false );
			wp_enqueue_script('jquery');
			
			wp_register_script( 'custom-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), null, true  );
			wp_enqueue_script( 'custom-scripts' );
		   
			wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), null, true  );
			wp_enqueue_script( 'bootstrap' );
			
			wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css', array(), '20140807', 'all' );
			wp_enqueue_style( 'bootstrap-css' );
		}
	}
}

add_action( 'init', 'gpm_enque' );

function new_srcset_max($max_width) {
	return 2000;
}

add_filter('max_srcset_image_width', 'new_srcset_max');

// Puts link in excerpts more tag
function new_excerpt_more($more) {
       global $post;
	return '... <a class="moretag" href="'. get_permalink($post->ID) . '">Read More...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

add_action( 'init', 'create_post_type' );
function create_post_type() {
	
	register_post_type( 'doctors',
		array(
			'labels' => array(
				'name' => __( 'Doctors' ),
				'singular_name' => __( 'Doctors' )
			),
			'public' => true,
			'menu_icon' => 'dashicons-businessman',
			'has_archive' => true,
			'map_meta_cap' => true,
			'hierarchical' => true,
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'page-attributes',
				'custom-fields'
				),
			'rewrite' => array('slug' => 'doctors')
		)
	);

	register_post_type( 'gallery',
		array(
			'labels' => array(
				'name' => __( 'Smile Gallery' ),
				'singular_name' => __( 'Gallery' )
			),
			'public' => true,
			'menu_icon' => 'dashicons-format-gallery',
			'has_archive' => true,
			'map_meta_cap' => true,
			'hierarchical' => true,
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'page-attributes',
				'custom-fields'
				),
			'rewrite' => array('slug' => 'gallery')
		)
	);
	
	register_post_type( 'testimonials',
		array(
			'labels' => array(
				'name' => __( 'Testimonials' ),
				'singular_name' => __( 'Testimonial' )
			),
			'public' => true,
			'menu_icon' => 'dashicons-editor-quote',
			'has_archive' => true,
			'map_meta_cap' => true,
			'hierarchical' => true,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'custom-fields',
				'page-attributes'
				),
			'rewrite' => array('slug' => 'testimonial')
		)
	);
	
	register_post_type( 'homepage-slider',
		array(
			'labels' => array(
				'name' => __( 'Homepage Slider' ),
				'singular_name' => __( 'Homepage Slider' )
			),
			'menu_icon' => 'dashicons-slides',
			'public' => true,
			'has_archive' => true,
			'map_meta_cap' => true,
			'hierarchical' => true,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'custom-fields',
				'page-attributes'
				),
			'rewrite' => array('slug' => 'homepage-slider')
		)
	);
	
	register_post_type( 'team',
		array(
			'labels' => array(
				'name' => __( 'Team Members' ),
				'singular_name' => __( 'Team Member' )
			),
			'menu_icon' => 'dashicons-groups',
			'public' => true,
			'has_archive' => true,
			'map_meta_cap' => true,
			'hierarchical' => true,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'custom-fields',
				'page-attributes'
				),
			'rewrite' => array('slug' => 'team-members')
		)
	);
	
	register_post_type( 'callouts',
		array(
			'labels' => array(
				'name' => __( 'Callouts' ),
				'singular_name' => __( 'Callout' )
			),
			'public' => true,
			'menu_icon' => 'dashicons-shield-alt',
			'has_archive' => true,
			'map_meta_cap' => true,
			'hierarchical' => true,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'custom-fields',
				'page-attributes'
				),
			'rewrite' => array('slug' => 'callouts')
		)
	);
}

require_once('twitter_bootstrap_nav_walker.php');

if ( function_exists('register_sidebar') ) {

	register_sidebar(array(
	  'name' => 'Blog Sidebar',
	  'id' => 'blog-sidebar',
	  'description' => '',
	  'before_widget' => '<li><div class="panel panel-default">',
	  'before_title' => '<div class="panel-heading"><h3 class="panel-title">',
	  'after_title' => '</h3></div><div class="panel-body">',
	  'after_widget' => '</div></div></li>'
	));
	
	register_sidebar(array(
	  'name' => 'Page Sidebar',
	  'id' => 'page-sidebar',
	  'description' => '',
	  'before_widget' => '<li><div class="panel panel-default">',
	  'before_title' => '<div class="panel-heading"><h3 class="panel-title">',
	  'after_title' => '</h3></div><div class="panel-body">',
	  'after_widget' => '</div></div></li>'
	));
	
	register_sidebar(array(
	  'name' => 'Home Sidebar',
	  'id' => 'home-sidebar',
	  'description' => '',
	  'before_widget' => '<div class="sidebar-widget">',
	  'before_title' => '<h3>',
	  'after_title' => '</h3>',
	  'after_widget' => '</div>'
	));

}

function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/i/site-login-logo.png);
            padding-bottom: 30px;
			background-size: 240px 60px;
			width: 240px;
			height: 60px;
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'my_login_logo' );

function show_all_thumbs($atts) {
	global $post;
	$post = get_post($post);
	
	extract(shortcode_atts(array(
		'numperrow' => 2,
		'numrows' => -1,
		'disablelinks' => 0,
		'imgthumb' => array(150,150),
		'linksize' => 'large',
		'excludechild' => ''
	 ), $atts));
	
	/* image code */
	$images =& get_children('post_type=attachment&post_mime_type=image&output=ARRAY_N&orderby=menu_order&order=ASC&exclude='.$excludechild.'&post_parent='.$post->ID);
	
    $i = 1;
	$thumblist .=  '<div class="row gallery-row">';
	if($images){
		if ($numrows == -1) {
			foreach( $images as $imageID => $imagePost ){
		
				unset($the_b_img);
				unset($the_l_img);
				$the_b_img = wp_get_attachment_image($imageID, $imgthumb, true, array('class'=>'img-bordered img-responsive'));
				$the_l_img = wp_get_attachment_image($imageID, $linksize, false, array('class'=>'img-bordered img-responsive'));
				$thumblist .= '<div class="col-lg-'.(12/$numperrow).'"><div class="gallery-row-img">';
				if ($disablelinks == 0) {
					$src = wp_get_attachment_image_src( $imageID, $linksize);
					$thumblist .= '<a class="gallery-'.$imageID.'" href="'.$src[0].'" data-featherlight="image">';
				}
				else {
					$thumblist .= '<span class="footer-img">';
				}
				$thumblist .= $the_b_img;
				if ($disablelinks == 0) {
					$thumblist .= '</a>';
				} else {
					$thumblist .= '</span>';
				}
				$thumblist .= '</div></div>';
				if($i % $numperrow == 0) {
					$thumblist .= '</div><div class="row gallery-row">';
			
				}
            	$i++;
			}
			
		} else {
			$j = 1;
			foreach( $images as $imageID => $imagePost ){
				if ($j <= ($numperrow*$numrows)) {
				  unset($the_b_img);
				  unset($the_l_img);
				  $the_b_img = wp_get_attachment_image($imageID, $imgthumb, true, array('class'=>'img-bordered img-responsive'));
				  $the_l_img = wp_get_attachment_image($imageID, $linksize, false, array('class'=>'img-bordered img-responsive'));
				  $thumblist .= '<div class="col-lg-'.(12/$numperrow).'"><div class="gallery-row-img">';
				  if ($disablelinks == 0) {
					  	$src = wp_get_attachment_image_src( $imageID, $linksize);
						$thumblist .= '<a class="gallery-'.$imageID.'" href="'.$src[0].'" data-featherlight="image">';
				  }
				  else {
					  $thumblist .= '<span class="footer-img">';
				  }
				  $thumblist .= $the_b_img;
				  if ($disablelinks == 0) {
					  $thumblist .= '</a>';
				  } else {
					  $thumblist .= '</span>';
				  }
				  $thumblist .= '</div></div>';
				  if($j % $numperrow == 0) {
					  $thumblist .= '</div><div class="row gallery-row">';
				  }
				  $j++;
				} else {
					break;	
				}
			}
			
		}	
	}
	$thumblist .=  '</div>';
	return $thumblist;
}

add_shortcode( 'gpm-gallery', 'show_all_thumbs' );

function show_carousel($att) {
	global $post;
	$post = get_post($post);
	
	extract(shortcode_atts(array(
		'disablelinks' => 0,
		'imgthumb' => 'full',
		'linksize' => 'large',
		'excludechild' => ''
	 ), $att));
	
	/* image code */
	$images =& get_children('post_type=attachment&post_mime_type=image&output=ARRAY_N&orderby=menu_order&order=ASC&exclude='.$excludechild.'&post_parent='.$post->ID);
	$thumblist .=  '<div class="owl-carousel" id="owl-gpm">';
	if($images){
		foreach( $images as $imageID => $imagePost ){
	
			unset($the_b_img);
			unset($the_l_img);
			$the_b_img = wp_get_attachment_image($imageID, $imgthumb, true, array('class'=>'img-thumbnail img-responsive'));
			$the_l_img = wp_get_attachment_image($imageID, $linksize, false, array('class'=>'img-thumbnail img-responsive'));
			$thumblist .= '<div>';
			if ($disablelinks == 0) {
				$src = wp_get_attachment_image_src( $imageID, $linksize);
				$thumblist .= '<a class="gallery-'.$imageID.'" href="'.$src[0].'" data-featherlight="image">';
			}
			else {
				$thumblist .= '<span class="gpm-owl-img">Hey';
			}
			$thumblist .= $the_b_img;
			if ($disablelinks == 0) {
				$thumblist .= '</a>';
			} else {
				$thumblist .= '</span>';
			}
			$thumblist .= '</div>';
			$i++;
		}
	}
	$thumblist .=  '</div>';
	return $thumblist;
}

add_shortcode( 'gpm-carousel', 'show_carousel' );

class newest_post extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct(
			'newest_post', // Base ID
			__('Newest Post', 'newest_post'), // Name
			array( 'description' => __( 'Show newest blog post', 'newest_post' ), ) // Args
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
			$widget_args = array( 'post_type' => 'post', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 1 );
			$widget_loop = new WP_Query( $widget_args ); 
			
			while ( $widget_loop->have_posts() ) {
				$widget_loop->the_post();
				echo '<div class="custom-widget">';
					echo '<div class="panel panel-default">';
						echo '<div class="panel-heading">';
							echo '<a href="'.get_the_permalink().'" class="blog-roll-title">'.get_the_title().'</a>';
							echo '<div class="upper-meta-side-panel">'.get_the_date().'</div>';
						echo '</div>';
						echo '<div class="panel-body"><p>'.get_the_excerpt().'</p></div>';
					echo '</div>';
				echo '</div>';
			}
			wp_reset_query();
	}

	/**
	 * Ouputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		echo '<p></p>';
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}

add_action( 'widgets_init', function(){
     register_widget( 'newest_post' );
});

class bootstrap_menu extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct(
			'bootstrap_menu', // Base ID
			__('Bootstrap Menu', 'bootsrap_menu'), // Name
			array( 'description' => __( 'Add a Bootstrap Menu to sidebar. Name menu "Side Menu".', 'bootstrap_menu' ), ) // Args
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		echo '<div class="custom-widget">';
			wp_nav_menu( array(
				'menu'       => 'Side Menu',
				'depth'      => 1,
				'container'  => false,
				'menu_class' => 'nav nav-pills nav-stacked',
				'fallback_cb'    => '__return_false')
			);
		echo '</div>';
	}

	/**
	 * Ouputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		echo '<p></p>';
	}
}

add_action( 'widgets_init', function(){
     register_widget( 'bootstrap_menu' );
});

class related_pages extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'related_pages', // Base ID
			__('Related Pages', 'related Pages'), // Name
			array( 'description' => __( 'Add a sidebar widget featuring related pages.', 'related_pages' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		$postid = $post->ID;
		$page_query = new WP_Query('post_type=page&post_parent='.$postid.'&order=desc&orderby=menu_order');
		$p_count = $page_query->post_count;
		if ($p_count >= 1) :
				echo '<div class="side-learn">';
					echo '<ul>';
						while ($page_query->have_posts()) :
							$page_query->the_post();
							echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
						endwhile;
					echo '</ul>';
				echo '</div>';
		endif;
	}
	public function form( $instance ) {
		// outputs the options form on admin
		echo '<p></p>';
	}
}

add_action( 'widgets_init', function(){
     register_widget( 'related_pages' );
});

class practice_hours extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'practice_hours', // Base ID
			__('Practice Hours', 'practice_hours'), // Name
			array( 'description' => __( 'Add a sidebar widget featuring practice hours.', 'practice_hours' ), ) // Args
		);
	}
	public function widget( $args, $instance ) {
		
		$hours_sunday = contact_detail('sunday_hours', '' , '', false);
		$hours_monday = contact_detail('monday_hours', '' , '', false);
		$hours_tuesday = contact_detail('tuesday_hours', '' , '', false);
		$hours_wednesday = contact_detail('wednesday_hours', '' , '', false);
		$hours_thursday = contact_detail('thursday_hours', '' , '', false);
		$hours_friday = contact_detail('friday_hours', '' , '', false);
		$hours_saturday = contact_detail('saturday_hours', '' , '', false);
		
		$date = date('D',strtotime(''.get_option('gmt_offset').'hours'));
		
		echo '<div class="hours-widget">';
			echo '<div class="hours-title">';
				echo 'Practice Hours';
			echo '</div>';
			echo '<div class="hours-body">';
				echo '<ul class="list-unstyled hours-list">';
					if (!empty($hours_sunday)) {
						if ($date == 'Sun') {
							echo '<li class="active">';
						} else {
							echo '<li>';
						}
							echo 'Sun: ';
							echo '<strong>'.$hours_sunday.'</strong>';
						echo '</li>';
					}
					if (!empty($hours_monday)) {
						if ($date == 'Mon') {
							echo '<li class="active">';
						} else {
							echo '<li>';
						}
							echo 'Mon: ';
							echo '<strong>'.$hours_monday.'</strong>';
						echo '</li>';
					}
					if (!empty($hours_tuesday)) {
						if ($date == 'Tue') {
							echo '<li class="active">';
						} else {
							echo '<li>';
						}
							echo 'Tue: ';
							echo '<strong>'.$hours_tuesday.'</strong>';
						echo '</li>';
					}
					if (!empty($hours_wednesday)) {
						if ($date == 'Wed') {
							echo '<li class="active">';
						} else {
							echo '<li>';
						}
							echo 'Wed: ';
							echo '<strong>'.$hours_wednesday.'</strong>';
						echo '</li>';
					}
					if (!empty($hours_thursday)) {
						if ($date == 'Thu') {
							echo '<li class="active">';
						} else {
							echo '<li>';
						}
							echo 'Thu: ';
							echo '<strong>'.$hours_thursday.'</strong>';
						echo '</li>';
					}
					if (!empty($hours_friday)) {
						if ($date == 'Fri') {
							echo '<li class="active">';
						} else {
							echo '<li>';
						}
							echo 'Fri: ';
							echo '<strong>'.$hours_friday.'</strong>';
						echo '</li>';
					}
					if (!empty($hours_saturday)) {
						if ($date == 'Sat') {
							echo '<li class="active">';
						} else {
							echo '<li>';
						}
							echo 'Sat: ';
							echo '<strong>'.$hours_saturday.'</strong>';
						echo '</li>';
					}
				echo '</ul>';
				
			echo '</div>';
		echo '</div>';
	}
	public function form( $instance ) {
		// outputs the options form on admin
		echo '<p></p>';
	}
}

add_action( 'widgets_init', function(){
     register_widget( 'practice_hours' );
});

class feature_doctor extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct(
			'feature_doctor', // Base ID
			__('Feature Doctor', 'feature_doctor'), // Name
			array( 'description' => __( 'Featured Doctor', 'feature_doctor' ), ) // Args
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
			$widget_args = array( 'post_type' => 'doctors', 'orderby' => 'rand', 'posts_per_page' => -1 );
			$widget_loop = new WP_Query( $widget_args );
			$widget_count = $widget_loop->post_count;
			$widget_x = 0;
			
			while ( $widget_loop->have_posts() ) {
				$widget_loop->the_post();
				if ($widget_x == 0) {
					echo '<div class="feature-doctor-box">';
						echo '<div class="feature-doctor-outer">';
							echo '<div class="feature-doctor-inner">';
								if ( has_post_thumbnail() ) :
				        			if ($widget_count <= 1) {
						        		echo '<a href="'.esc_url(get_permalink(get_page_by_title('Meet The Doctor'))).'">';
						        	} else {
						        		echo '<a href="'.esc_url(get_permalink(get_page_by_title('Meet The Doctors'))).'">';
						        	}
				        			the_post_thumbnail('Large',array('class'=>'img-responsive feature-doctor-img'));
				        			if ($widget_count <= 1) {
						        		echo '</a>';
						        	} else {
						        		echo '</a>';
						        	}
				        		endif;
				        		if ($widget_count >= 2) {
					        		echo '<div class="feature-doctor-name">';
					        			the_title();
					        		echo '</div>';
				        		}
				        	echo '</div>';
				        	if ($widget_count <= 1) {
				        		echo '<a href="'.esc_url(get_permalink(get_page_by_title('Meet The Doctor'))).'" class="btn btn-block btn-lg btn-primary">'.get_the_title().'</a>';
				        	} else {
				        		echo '<a href="'.esc_url(get_permalink(get_page_by_title('Meet The Doctors'))).'" class="btn btn-block btn-lg btn-primary">Meet The Doctors</a>';
				        	}
			        	echo '</div>';
		        	echo '</div>';
				}
				
				$widget_x++;
			}
			wp_reset_query();
	}

	/**
	 * Ouputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		echo '<p></p>';
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}

add_action( 'widgets_init', function(){
     register_widget( 'feature_doctor' );
});

add_action( 'edit_form_after_title', 'gpm_edit_form_after_title' );
function gpm_edit_form_after_title() {

	if( isset($_GET['post_type']) ) { 
		$post_type = $_GET['post_type']; 
	} else {
		$post_type = get_post_type( $post_ID );
	}
	
	if( $post_type == 'gallery' ) :
    	echo '<br/><p>Hint: <strong><em>To add images to the smile gallery, click the "Add Media" button below and upload your photos. Once your files have finished uploading, close the upload dialog and click "Publish" or "Update" on the right hand side.</em></strong></p>';	
	endif;
	
}

//Darken Color of Navbar
function colourBrightness($hex, $percent) {
	// Work out if hash given
	$hash = '';
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
		$hash = '#';
	}
	/// HEX TO RGB
	$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
	//// CALCULATE 
	for ($i=0; $i<3; $i++) {
		// See if brighter or darker
		if ($percent > 0) {
			// Lighter
			$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
		} else {
			// Darker
			$positivePercent = $percent - ($percent*2);
			$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
		}
		// In case rounding up causes us to go to 256
		if ($rgb[$i] > 255) {
			$rgb[$i] = 255;
		}
	}
	//// RBG to Hex
	$hex = '';
	for($i=0; $i < 3; $i++) {
		// Convert the decimal digit to hex
		$hexDigit = dechex($rgb[$i]);
		// Add a leading zero if necessary
		if(strlen($hexDigit) == 1) {
		$hexDigit = "0" . $hexDigit;
		}
		// Append to the hex string
		$hex .= $hexDigit;
	}
	return $hash.$hex;
}

function widget($atts) {
    
    global $wp_widget_factory;
    
    extract(shortcode_atts(array(
        'widget_name' => FALSE
    ), $atts));
    
    $widget_name = wp_specialchars($widget_name);
    
    if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
        $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
        
        if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
            return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct"),'<strong>'.$class.'</strong>').'</p>';
        else:
            $class = $wp_class;
        endif;
    endif;
    
    ob_start();
    the_widget($widget_name, $instance, array('widget_id'=>'arbitrary-instance-'.$id,
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
    
}
add_shortcode('widget','widget'); 


//Convert Hex to RGB
function hex2rgb($hex) {
	
   $hex = colourBrightness($hex, -0.8);
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}

register_nav_menus( array(
	'Main Menu' => 'Main Site Navigation',
	'Footer Menu' => 'Footer Menu',
	'Courtesy Menu' => 'Courtesy Menu'
) );

// Get theme options
function get_wpbs_theme_options(){
  $theme_options_styles = '';
  
  	// Top Bar
 
  
	  $top_bar_bg_color = of_get_option('top_bar_bg_color');
	  if ( $top_bar_bg_color ) {
		$theme_options_styles .= '
		.top-bar {
		  background-color: '. $top_bar_bg_color . ';
		}';
	  }
	  
	  $top_bar_text_color = of_get_option('top_bar_text_color');
	  if ( $top_bar_text_color ) {
		$theme_options_styles .= '
		.hours-short {
		  color: '. $top_bar_text_color . ';
		}';
	  }
	  
	  $top_bar_link_color = of_get_option('top_bar_link_color');
	  if ( $top_bar_link_color ) {
		$theme_options_styles .= '
		.hours-short a {
		  color: '. $top_bar_link_color . ';
		}';
	  }
	  
	  // Body BG
	  
	  $body_bg_color = of_get_option('body_bg_color');
	  if ( $body_bg_color ) {
		$theme_options_styles .= '
		.body-bg{
		  background-color: '. $body_bg_color . ';
		}';
		
	  }
	  
	  
	  $body_bg_container_color = of_get_option('body_bg_container_color');
	  if ( $body_bg_container_color ) {
		$theme_options_styles .= '
		.body-bg .container{
		  background-color: '. $body_bg_container_color . ';
		}';
	  }
	  
	  $body_bg_container_shadow = of_get_option('body_bg_container_shadow');
	  if ( $body_bg_container_shadow == 1 ) {
		$theme_options_styles .= '
		.body-bg .container{
		  box-shadow: 2px 3px 5px rgba(0,0,0,0.4);
		}';
	  }
	  
	  // Footer Bar
	  
	  $footer_bar_bg_color = of_get_option('footer_bar_bg_color');
	  if ( $footer_bar_bg_color ) {
		$theme_options_styles .= '
		.footer-bar {
		  background-color: '. $footer_bar_bg_color . ';
		}';
	  }
	  
	  $footer_bar_text_color = of_get_option('footer_bar_text_color');
	  if ( $footer_bar_text_color ) {
		$theme_options_styles .= '
		.footer-bar {
		  color: '. $footer_bar_text_color . ';
		}';
	  }
	  
	  $footer_bar_link_color = of_get_option('footer_bar_link_color');
	  if ( $footer_bar_link_color ) {
		$theme_options_styles .= '
		.footer-bar a, .footer-menu li a {
		  color: '. $footer_bar_link_color . ';
		}';
	  }
	  
	  // Cppyright Bar
	  
	  $copyright_bar_bg_color = of_get_option('copyright_bar_bg_color');
	  if ( $copyright_bar_bg_color ) {
		$theme_options_styles .= '
		.footer-copyright {
		  background-color: '. $copyright_bar_bg_color . ';
		}';
	  }
	  
	  $copyright_bar_text_color = of_get_option('copyright_bar_text_color');
	  if ( $copyright_bar_text_color ) {
		$theme_options_styles .= '
		.footer-copyright {
		  color: '. $copyright_bar_text_color . ';
		}';
	  }
	  
	  $copyright_bar_link_color = of_get_option('copyright_bar_link_color');
	  if ( $copyright_bar_link_color ) {
		$theme_options_styles .= '
		.footer-copyright a {
		  color: '. $copyright_bar_link_color . ';
		}';
	  }
	  
	  
      $topbar_bg_color = of_get_option('top_nav_bg_color');
      if ( $topbar_bg_color ) {
        $theme_options_styles .= '
        .navbar-default {
          background-color: '. $topbar_bg_color . ';
        }
		.navbar-default .navbar-nav > .active > a {
          background-color: rgba('.hex2rgb($topbar_bg_color).',1.0) !important;
        }';
      }

      $topbar_link_color = of_get_option('top_nav_link_color');
      if ($topbar_link_color) {
        $theme_options_styles .= '
        .navbar-default .navbar-nav > li > a {
          color: '. $topbar_link_color . ';
        }';
      }

      $topbar_link_hover_color = of_get_option('top_nav_link_hover_color');
      if ($topbar_link_hover_color) {
        $theme_options_styles .= '
        .navbar-default .navbar-nav > li > a {
          color: '. $topbar_link_hover_color . ';
        }';
      }
	  
	  $topbar_dropdown_bg_color = of_get_option('top_nav_dropdown_bg');
      if ($topbar_dropdown_bg_color) {
        $theme_options_styles .= '
          .dropdown-menu {
            background-color: ' . $topbar_dropdown_bg_color . ';
			border-color: rgba('.hex2rgb($topbar_dropdown_bg_color).',1.0) !important;
          }
        ';
      }

      $topbar_dropdown_hover_bg_color = of_get_option('top_nav_dropdown_hover_bg');
      if ($topbar_dropdown_hover_bg_color) {
        $theme_options_styles .= '
          .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover {
            background-color: ' . $topbar_dropdown_hover_bg_color . ';
          }
        ';
      }

      $topbar_dropdown_item_color = of_get_option('top_nav_dropdown_item');
      if ($topbar_dropdown_item_color){
        $theme_options_styles .= '
          .dropdown-menu a{
            color: ' . $topbar_dropdown_item_color . ' !important;
          }
        ';
      }

      $hero_unit_bg_color = of_get_option('hero_unit_bg_color');
      if ($hero_unit_bg_color) {
        $theme_options_styles .= '
        .hero-unit {
          background-color: '. $hero_unit_bg_color . ';
        }';
      }

      $suppress_comments_message = of_get_option('suppress_comments_message');
      if ($suppress_comments_message){
        $theme_options_styles .= '
        #main article {
          border-bottom: none;
        }';
      }

      $additional_css = of_get_option('wpbs_css');
      if( $additional_css ){
        $theme_options_styles .= $additional_css;
      }

      if($theme_options_styles){
        echo '<style>'
        . $theme_options_styles . '
        </style>';
      }

      $bootstrap_theme = of_get_option('wpbs_theme');
      $use_theme = of_get_option('showhidden_themes');

      if( $bootstrap_theme && $use_theme ){
        if( $bootstrap_theme == 'default' ){}
        else {
          echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/admin/themes/' . $bootstrap_theme . '.css">';
        }
      }
} // end get_wpbs_theme_options function

add_editor_style('editor-style.css');

?>