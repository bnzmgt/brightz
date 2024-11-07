<?php

add_action('rest_api_init', function() {
    register_rest_route('custom/v1', '/acf-options/', array(
        'methods' => 'GET',
        'callback' => 'get_acf_options',
    ));
});

function get_acf_options() {
    if (function_exists('get_field')) {
        $footer_logo = get_field('footer_logo', 'option');
        $social_media = get_field('basic_social_media', 'option');

        // Format social_media repeater field for the API response
        $formatted_social_media = [];
        if (is_array($social_media)) {
            foreach ($social_media as $item) {
                $icon = '';
                $name = $item['basic_social_name'];

                // Match based on value and encode SVG as base64
                if ($name === 'instagram') {
                    $icon_svg = '<svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>';
                    $icon = 'data:image/svg+xml;base64,' . base64_encode($icon_svg);
                } elseif ($name === 'twitter') {
                    $icon_svg = '<svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>';
                    $icon = 'data:image/svg+xml;base64,' . base64_encode($icon_svg);
                }elseif ($name === 'facebook') {
                    $icon_svg = '<svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>';
                    $icon = 'data:image/svg+xml;base64,' . base64_encode($icon_svg);
                }

                $formatted_social_media[] = [
                    'name' => $name,
                    'link' => isset($item['basic_social_link']) ? $item['basic_social_link'] : '',
                    'icon' => $icon
                ];
            }
        }

        $options = array(
            'footer_copyright' => get_field('basic_copyright_text', 'option'),
            'whatsapp_number' => get_field('basic_whatsapp_number', 'option'),
            'footer_logo' => is_array($footer_logo) ? $footer_logo['url'] : $footer_logo,
            'basic_social_media' => $formatted_social_media,
            'basic_contact' => get_field('basic_contact', 'option')
        );
        return $options;
    }
    return null;
}

class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        // Override this method to remove the <ul> that wraps sub-menu items
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        // Override this method to remove the </ul> closing tag
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = !empty($item->classes) ? implode(' ', $item->classes) : '';
        $output .= sprintf(
            '<a href="%s" class="%s text-gray-800 hover:text-orange px-4 py-2 transition duration-300">',
            esc_url($item->url),
            esc_attr($classes)
        );

        $output .= apply_filters('the_title', $item->title, $item->ID);
        $output .= '</a>';
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= ''; // No need for closing tags as we're outputting individual <a> elements
    }
}




// -----------------------------------------------------------------------------
// Title Tag
// -----------------------------------------------------------------------------
add_theme_support('title-tag');

// -----------------------------------------------------------------------------
// Body class
// -----------------------------------------------------------------------------
add_filter('body_class', 'custombodyclass');
function custombodyclass($classes){
	if(is_home() || is_front_page())
		$classes[] = 'mainpage';
		return $classes;
}

// Filter except length to 35 words.
// tn custom excerpt length
function tn_custom_excerpt_length( $length ) {
return 35;
}
add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );

// -----------------------------------------------------------------------------
// Main Menu / Navwalker
// -----------------------------------------------------------------------------
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
register_nav_menus(array(
	'primary' => __( 'Primary Menu', 'header-menu' ),
));

function mytheme_add_woocommerce_support(){
  add_theme_support('woocommerce', array(
  'thumbnail_image_width' => 150,
  'single_image_width' => 300,
  'product_grid' => array(
    'default_rows' => 3,
    'min_rows' => 2,
    'max_rows' => 8,
    'default_columns' => 4,
    'min_columns' => 2,
    'max_columns' => 5,
    ),
  ));
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

// -----------------------------------------------------------------------------
// woocommerce zoom
// -----------------------------------------------------------------------------
function mytheme_add_woocommerce_zooming(){
  add_theme_support('wc-product-gallery-zoom');
  //add_theme_support('wc-product-gallery-lightbox');
  //add_theme_support('wc-product-gallery-slider');
}
add_action('wp', 'mytheme_add_woocommerce_zooming', 99);

function cl (){
    the_excerpt();
}
add_action('woocommerce_after_shop_lopp_item_title', 'cl', 40);

// -----------------------------------------------------------------------------
// ACF Option page
// -----------------------------------------------------------------------------
if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
		'page_title' 	=> 'Company Profile Management System',
		'menu_title'	=> 'Complements',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
  	));

  	acf_add_options_page(array(
		'page_title' 	=> 'Address Info',
		'menu_title'	=> 'Address Info',
		'menu_slug' 	=> 'address-info',
		'capability'	=> 'edit_posts',
    	'icon_url' 		=> 'dashicons-feedback',
    	'parent_slug' 	=> 'theme-general-settings',
		'redirect'		=> false
	));
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Event',
		'menu_title'	=> 'Event',
		'parent_slug'	=> 'theme-general-settings',
	));
}


// -----------------------------------------------------------------------------
// Other / Related Blog Post
// -----------------------------------------------------------------------------
function example_cats_related_post() {
  $post_id = get_the_ID();
  $cat_ids = array();
  $categories = get_the_category( $post_id );

  if(!empty($categories) && is_wp_error($categories)):
    foreach ($categories as $category):
        array_push($cat_ids, $category->term_id);
    endforeach;
  endif;

  $current_post_type = get_post_type($post_id);
  $query_args = array(
      'category__in'   => $cat_ids,
      'post_type'      => $current_post_type,
      'post_not_in'    => array($post_id),
      'posts_per_page'  => '3'
 	);

  $related_cats_post = new WP_Query( $query_args );

	if($related_cats_post->have_posts()):
		while($related_cats_post->have_posts()): $related_cats_post->the_post(); ?>
		  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<div class="box-image">
					<span>
						<?php
							if ( has_post_thumbnail() ) {
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
								echo '<img src="'.$image[0].'" data-id="'.$post->ID.'" class="img-responsive">';
							}
						?>
					</span>
				</div><!-- end .box-image -->
	      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<span>Post by <?php the_author(); ?>, <?php the_time('F jS, Y'); ?></span>
	      <?php the_content(); ?>
		  </div>
		<?php endwhile;

		// Restore original Post Data
		wp_reset_postdata();
	endif;
}


add_action('acf/render_field_settings/type=image', 'add_default_value_to_image_field', 20);
function add_default_value_to_image_field($field) {
  $args = array(
    'label' => 'Default Image',
    'instructions' => 'Appears when creating a new post',
    'type' => 'image',
    'name' => 'default_value'
  );
  acf_render_field_setting($field, $args);
}

add_action('admin_enqueue_scripts', 'enqueue_uploader_for_image_default');
function enqueue_uploader_for_image_default() {
  $screen = get_current_screen();
  if ($screen && $screen->id && ($screen->id == 'acf-field-group')) {
    acf_enqueue_uploader();
  }
}

add_filter('acf/load_value/type=image', 'reset_default_image', 10, 3);

function reset_default_image($value, $post_id, $field) {
  if (!$value) {
    $value = $field['default_value'];
  }
  return $value;
}

// loading the field
add_action('acf/load_field/name=SF_uImage', 'load_select_field_name_choices');
function load_select_field_name_choices($field) {
  $choices = array();
  if (have_rows('sf_uno', 'options')) {
    while (have_rows('sf_uno', 'options')) {
      the_row();
      $title = get_sub_field('SF_uImage');
      $choices[$title] = $title;
    } // end while have rows
  }  // end if get field
} // end function

function my_acf_admin_head() {
    ?>
    <style type="text/css">

        .postbox-container .meta-box-sortables .postbox {
            width: 50%;
            margin: 0 auto;
        }

        #editor .postbox > .postbox-header .hndle  {
            padding-left: 0px;
        }
    </style>
    <?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');

// -----------------------------------------------------------------------------
// Main Image Size Setting
// -----------------------------------------------------------------------------
if (function_exists('add_theme_support')) {
    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true);
    add_image_size('medium', 320, 200, true);
    add_image_size('small', 120, '', true);
    add_image_size('full');
    add_image_size('admin-list-thumb', 80, 80, true);
    add_image_size('album-grid', 450, 450, true );
    add_image_size('gallery-slide', 900, 500, true);
    add_image_size('custom-size', 900, 300, true);
    add_image_size('gallery-slide-main', 1920, 1080, true);
}

// -----------------------------------------------------------------------------
// Style and vendor
// -----------------------------------------------------------------------------
function my_theme_enqueue_styles() {

    $parent_style = 'brightz-style';
    //wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.3/jquery.min.js', array(), null, true );
    wp_enqueue_script('jquery', 'https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js', array(), null, true );    
    wp_enqueue_script('jsflexslider', 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.1/jquery.flexslider-min.js', array(), null, true );
    
		// wp_enqueue_script('jsowl', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array(), null, true );
		wp_enqueue_script('jsfancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array(), null, true );
    // wp_enqueue_script('jsvendor', get_stylesheet_directory_uri() .  '/asset/js/vendor/vendor.min.js', array(), null, true );
    wp_enqueue_script('jsglobal', get_stylesheet_directory_uri() .  '/asset/js/global.js', array(), null, true );

    // wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.0.4/css/all.css', array(), null,'all' );
    wp_enqueue_style('flexslider', 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.1/flexslider.min.css', array(), null,'all' );
		// wp_enqueue_style('owlcarousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), null,'all' );
		wp_enqueue_style('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', array(), null,'all' );
    // wp_enqueue_style('fontello', get_stylesheet_directory_uri() . '/asset/fontello/css/marker.css', array(), null,'all' );
		wp_enqueue_style('themify', get_stylesheet_directory_uri() . '/asset/fonts/themify-icons.css', array(), null,'all' );
		// wp_enqueue_style('logistico', get_stylesheet_directory_uri() . '/asset/css/vendor/logistico/main.css', array(), null,'all' );
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/main.css' );

}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles', 60 );
//add_filter('acf/settings/show_admin', '__return_false');

/**
 * Load bootstrap from CDN
 * https://getbootstrap.com/
 *
 * Added functions to add the integrity and crossorigin attributes to the style and script tags.
 */
function enqueue_load_bootstrap() {
    // Add bootstrap CSS
    // wp_register_style( 'bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', false, NULL, 'all' );
    // wp_register_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css', false, NULL, 'all' );
    // wp_enqueue_style( 'bootstrap-css' );

    // Add popper js
    // wp_register_script( 'popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', ['jquery'], NULL, true );
    // wp_register_script( 'popper-js', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', ['jquery'], NULL, true );
    // wp_enqueue_script( 'popper-js' );

    // Add bootstrap js
    // wp_register_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js', ['jquery'], NULL, true );
    //wp_register_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js', array('strategy' => 'defer'), ['jquery'], NULL, true );
    // wp_enqueue_script( 'bootstrap-js' );
}

// Add integrity and cross origin attributes to the bootstrap css.
// function add_bootstrap_css_attributes( $html, $handle ) {
//     if ( $handle === 'bootstrap-css' ) {
//         return str_replace( '/>', 'integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />', $html );
//     }
//     return $html;
// }
// add_filter( 'style_loader_tag', 'add_bootstrap_css_attributes', 10, 2 );

// Add integrity and cross origin attributes to the bootstrap script.
// function add_bootstrap_script_attributes( $html, $handle ) {
//     if ( $handle === 'bootstrap-js' ) {
//         return str_replace( '></script>', ' integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>', $html );
//     }
//     return $html;
// }
// add_filter('script_loader_tag', 'add_bootstrap_script_attributes', 10, 2);

// Add integrity and cross origin attributes to the popper script.
// function add_popper_script_attributes( $html, $handle ) {
//     if ( $handle === 'popper-js' ) {
//         return str_replace( '></script>', ' integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>', $html );
//     }
//     return $html;
// }
// add_filter('script_loader_tag', 'add_popper_script_attributes', 10, 2);

// add_action( 'wp_enqueue_scripts', 'enqueue_load_bootstrap' );

// -----------------------------------------------------------------------------
// Google Fonts
// -----------------------------------------------------------------------------
function custom_add_google_fonts() {
		wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'custom_add_google_fonts' );

function custom_excerpt_length($text) {
    return wp_trim_words($text, 30, '...'); // Adjust the word limit if necessary
}

function custom_trim_excerpt($text) {
    $raw_excerpt = $text;
    if ( '' == $text ) {
        $text = get_the_content('');
        $text = strip_shortcodes($text);
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);

        $text = strip_tags($text);

        $excerpt_length = 50; // Limit to 200 characters
        $excerpt_more = apply_filters('excerpt_more', ' ' . '...');
        $text = substr($text, 0, $excerpt_length) . $excerpt_more;
    }
    return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_trim_excerpt');

// -----------------------------------------------------------------------------
// Recent Page
// -----------------------------------------------------------------------------
function wpcrux_recent_posts( $num ) {
  // Prepare variables
  global $post;
  $html = null;

  // Build our basic custom query arguments
  $recent_pages_args = array(
    'post_type'      => 'page',
    'posts_per_page' => $num, // Number of recent pages to display
    'post__not_in'   => array( $post->ID ), // Ensure that the current page is not displayed
  );

  // Initiate the custom query
  $recent_pages = new WP_Query( $recent_pages_args );

  // Run the loop and collect data for the matched results
  if ( $recent_pages->have_posts() ) {
    $html = '<h3 class="widget-title">Recent Pages</h3><ul class="recent-pages">';
    while ( $recent_pages->have_posts() ) {
      $recent_pages->the_post();
      $html.= '<li><a href="' . get_permalink() . '" rel="bookmark noopener" target="_blank">' . get_the_title() . '</a></li>';
    }
    $html.= '</ul><!-- .recent-pages -->';
  }

  // Reset the loop
  wp_reset_postdata();

  // Return the final HTML
  return $html;
}

// -----------------------------------------------------------------------------
// Remove Header on 404
// -----------------------------------------------------------------------------
function remove_header() {
   	if ( is_page( 'error404' ) ) {
      	return;
   	}
   ?>
   	<style media="all">
   		body.error404 .navbar {
			display: none;
		}
   	</style>
   <?php
}
add_action('wp_head', 'remove_header');

// -----------------------------------------------------------------------------
// Breadcrumb
// -----------------------------------------------------------------------------
if ( ! function_exists( 'breadcrumbs' ) ) :
function breadcrumbs() {
$delimiter = '&rsaquo;';
$home = 'Home';

echo '<div xmlns:v="http://rdf.data-vocabulary.org/#">';
global $post;
echo ' <span typeof="v:Breadcrumb">
<a rel="v:url" property="v:title" href="'.home_url( '/' ).'">'.$home.'</a>
</span> ';
$cats = get_the_category();
if ($cats) {
foreach($cats as $cat) {
echo $delimiter . "<span typeof=\"v:Breadcrumb\">
<a rel=\"v:url\" property=\"v:title\" href=\"".get_category_link($cat->term_id)."\" >$cat->name</a>
</span>"; }
}
echo $delimiter . the_title(' <span>', '</span>', false);
echo '</div>';
}
endif;

function torque_breadcrumbs() {
	/* Change according to your needs */
	$show_on_homepage = 0;
	$show_current = 1;
	$delimiter = '&raquo;';
	$home_url = 'Home';
	$before_wrap = '<span clas="current">';
	$after_wrap = '</span>';

	/* Don't change values below */
	global $post;
	$home_url = get_bloginfo( 'url' );

	/* Check for homepage first! */
	if ( is_home() || is_front_page() ) {
		$on_homepage = 1;
	}
	if ( 0 === $show_on_homepage && 1 === $on_homepage ) return;

	/* Proceed with showing the breadcrumbs */
	$breadcrumbs = '<ol id="crumbs" itemscope itemtype="http://schema.org/BreadcrumbList">';

	$breadcrumbs .= '<li itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a target="_blank" href="' . $home_url . '">' . $home_url . '</a></li>';

	/* Build breadcrumbs here */

	$breadcrumbs .= '</ol>';

	echo $breadcrumbs;
}

function select2_adjust() {
  	echo '<style>
			.select2-container--default .select2-selection--multiple .select2-selection__choice,
    		.select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        		padding-left: 20px;
    		}
  		</style>';
}
add_action('admin_head', 'select2_adjust'); // admin_head is a hook my_custom_fonts is a function we are adding it to the hook

// -----------------------------------------------------------------------------
// Remove HTML tag
// -----------------------------------------------------------------------------
function register_html_support() {
    add_theme_support( 'html5', array( 'script', 'style' ) );
}

add_action( 'after_setup_theme', 'register_html_support' );

// -----------------------------------------------------------------------------
// Update Checker
// -----------------------------------------------------------------------------
require_once ( get_stylesheet_directory() . '/inc/plugin-update-checker/plugin-update-checker.php' );
    $updateChecker = Puc_v4_Factory::buildUpdateChecker(
        'https://github.com/bnzmgt/brightz',
        __FILE__,
        'brightz'
    );

    // $updateChecker->setAuthentication( array(
    //     'consumer_key' => 'fgRqxkNVeWkCxpumeT',
    //     'consumer_secret' => 'eJJTb6YYSGjVKZ6LszVgrGPejR79BKH8',
    // ));

    $updateChecker->setBranch( 'develop' );

?>
