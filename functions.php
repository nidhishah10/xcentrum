<?php
// Exit if accessed directly
if (!defined("ABSPATH")) {
	exit();
}
/**
 * Parking Systems functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage X Centrum
 * @since 1.0
 */
if (!defined('API_URL')) {
	define('API_URL', 'https://list.auto-commerce.eu/view/voertuigen_rssfeed.php?id=ac0072');
}

function get_theme_domain() {
	return "xcentrum";
}
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function xcentrum_setup() {
	/*
		     * Make theme available for translation.
		     * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/herb-and-water
		     * If you're building a theme based on Parking Systems, use a find and replace
		     * to change 'herb-and-water' to the name of your theme in all the template files.
	*/
	load_theme_textdomain("xcentrum");
	// Add default posts and comments RSS feed links to head.
	add_theme_support("automatic-feed-links");
	/*
		     * Let WordPress manage the document title.
		     * By adding theme support, we declare that this theme does not use a
		     * hard-coded <title> tag in the document head, and expect WordPress to
		     * provide it for us.
	*/
	add_theme_support("title-tag");
	add_theme_support("custom-logo");
	/*
		     * Enable support for Post Thumbnails on posts and pages.
		     *
		     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support("post-thumbnails");
	/*
		     * Switch default core markup for search form, comment form, and comments
		     * to output valid HTML5.
	*/
	add_theme_support("html5", ["comment-form", "contact-from"]);
	// Set the default content width.
	$GLOBALS["content_width"] = 525;
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus([
		"main-menu" => __("Main Menu", get_theme_domain()),

		"footer-menu" => __("Footer Menu ", get_theme_domain()),
	]);
	/*
		     * This theme styles the visual editor to resemble the theme style,
		     * specifically font, colors, and column width.
	*/
	add_editor_style(["css/editor-style.css"]);
	//add_theme_support( 'woocommerce' );
}

add_action("after_setup_theme", "xcentrum_setup");

/**
 * Enqueues scripts and styles.
 */

function xcentrum_scripts() {
	// Theme swiper Stylesheet

	wp_enqueue_style(
		"xcentrum-owl-carousel-style",
		get_theme_file_uri("css/vendor/owl.carousel.min.css"),
		[],
		rand()
	);
	

	wp_enqueue_style(
		"xcentrum-icons-style",
		get_theme_file_uri("css/icons.css"),
		[],
		rand()
	);

	wp_enqueue_style(
		"xcentrum-normalize-style",
		get_theme_file_uri("css/normalize.css"),
		[],
		rand()
	);

	wp_enqueue_style(
		"xcentrum-animate-style",
		get_theme_file_uri("css/vendor/animate.min.css"),
		[],
		rand()
	);

	wp_enqueue_style(
		"xcentrum-lightcase-style",
		get_theme_file_uri("css/vendor/lightcase.css"),
		[],
		rand()
	);
	/*
	wp_enqueue_style(
		"xcentrum-sal-style",
		get_theme_file_uri("css/vendor/sal.css"),
		[],
		rand()
	);
	*/
	// Theme Main Stylesheet
	wp_enqueue_style(
		"xcentrum-style",
		get_theme_file_uri("css/style.css"),
		[],
		rand()
	);

	// Theme Responsive Stylesheet
	wp_enqueue_style(
		"xcentrum-responsive-style",
		get_theme_file_uri("css/responsive.css"),
		[],
		rand()
	);

	// Theme Normalize Stylesheet
	//wp_enqueue_style( 'quest-audio-normalize-style', get_theme_file_uri('css/normalize.css'), array(), rand() );

	//check is not admin

	if (!is_admin()) {
		//Unload WP default jQuery

		wp_deregister_script("jquery");

		//Load jquery

		wp_register_script(
			"jquery",
			get_theme_file_uri("js/vendor/jquery.js"),
			[],
			null,
			true
		);

		wp_enqueue_script("jquery");
	} //Endif

	// Stickyfill Script File
	wp_enqueue_script(
		"xcentrum-stickyfill-script",
		get_theme_file_uri("js/vendor/stickyfill.min.js"),
		[],
		null,
		true
	);

	// lightcase script file
	wp_enqueue_script(
		"xcentrum-lightcase-script",
		get_theme_file_uri("js/vendor/lightcase.js"),
		[],
		null,
		true
	);

	// Owl Script File
	wp_enqueue_script(
		"xcentrum-owl-script",
		get_theme_file_uri("js/vendor/owl.carousel.min.js"),
		[],
		null,
		true
	);

	wp_enqueue_script(
		"xcentrum-sal-script",
		get_theme_file_uri("js/vendor/sal.js"),
		[],
		rand(),
		true
	);

	// Theme Main Script File
	wp_enqueue_script(
		"xcentrum-general-script",
		get_theme_file_uri("js/general.js"),
		[],
		rand(),
		true
	);

	wp_enqueue_script(
		"xcentrum-script",
		get_theme_file_uri("script.js"),
		[],
		rand(),
		true
	);
}

add_action("wp_enqueue_scripts", "xcentrum_scripts");

//Add acf option for the theme

if (function_exists("acf_add_options_page")) {
	acf_add_options_page(); //Options Page
} //endif

if (!function_exists("xcentrum_add_favicon")):

	function xcentrum_add_favicon() {
		$favicom = get_field("favicon_icon", "option")
		? get_field("favicon_icon", "option")
		: get_theme_file_uri("/images/favicon.ico");

		echo '<link rel="shortcut icon" href="' . $favicom . '" />';
	}
	add_action("login_head", "xcentrum_add_favicon");
	add_action("admin_head", "xcentrum_add_favicon");
	add_action("wp_head", "xcentrum_add_favicon");
endif; //endif

/**

 * Add Body class for logged in admin

 */

add_filter("body_class", "xcentrum_admin_body_class");

function xcentrum_admin_body_class($classes) {
	$user = wp_get_current_user();

	if (current_user_can("administrator")) {
		$classes[] = "admin-logged-in"; // your custom class name
	}

	if (is_page("home")) {
		$classes[] = "homepage";
	}

	//return $classes;

	return $classes;
}

if (!function_exists("xcentrum_mime_types")):
	/**

	 * Mime Types

	 **/

	function xcentrum_mime_types($mimes) {
		$mimes["svg"] = "image/svg+xml";

		return $mimes;
	}

	add_filter("upload_mimes", "xcentrum_mime_types");
endif; //endif

add_filter('nav_menu_css_class', 'xcentrum_nav_class', 10, 2);

function xcentrum_nav_class($classes, $item) {
	if (in_array('current-menu-item', $classes)) {
		$classes[] = 'active ';
	}
	return $classes;
}

/*function modify_product_cat_query($query)
{
if (is_post_type_archive("blog")) {
$query->set("posts_per_page", 6);
}
}

add_action("pre_get_posts", "modify_product_cat_query");*/

// Our Cars custom post type function
function create_carposttype() {

	register_post_type(
		'cars',
		// CPT Options
		array(
			'labels' => array(
				'name' => __('Cars'),
				'singular_name' => __('Car'),
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'cars'),
			'show_in_rest' => true,

		)
	);
}
// Hooking up our function to theme setup
add_action('init', 'create_carposttype');

// Our News custom post type function
function create_newsposttype() {

	if (!session_id()) {
		session_start();
	}

	register_post_type(
		'news',
		// CPT Options
		array(
			'labels' => array(
				'name' => __('News'),
				'singular_name' => __('News'),
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'news'),
			'show_in_rest' => true,

		)
	);
}
// Hooking up our function to theme setup
add_action('init', 'create_newsposttype');

/*Add this at start :
if (!defined('API_URL')) {
define('API_URL', 'https://list.auto-commerce.eu/view/voertuigen_rssfeed.php?id=ac0072');

}*/

/*This at end:*/

/***********************************API Function*************************************************/
function xcentrum_get_auto_data() {
	$api_data =  get_option( 'api_data_options', true );
	$xml = SimpleXML_Load_String($api_data, 'SimpleXMLElement', true);
	return $xml;
	/*if (isset($_SESSION['car_data'])) {
		$xml = $_SESSION['car_data'];
		return $xml;
	} else {

		$soap_do = curl_init();
		curl_setopt($soap_do, CURLOPT_URL, API_URL);
		curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
		curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
		//curl_setopt($soap_do, CURLOPT_POST,           true );
		//curl_setopt($soap_do, CURLOPT_POSTFIELDS,    $post_string);
		curl_setopt($soap_do, CURLOPT_HTTPHEADER, array('Content-Type: application/xml; charset=utf-8'));
		//curl_setopt($soap_do, CURLOPT_USERPWD, $user . ":" . $password);

		$result = curl_exec($soap_do);
		$err = curl_error($soap_do);

		//print_r($result);
		$xml = SimpleXML_Load_String($result, 'SimpleXMLElement', true);
		$_SESSION['car_data'] = $xml;
		return $xml;
	}
	*/

}

function xcentrum_shortcode_display_img($img) {

	$xml = xcentrum_get_auto_data();

	

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '10',
		),
		$img
	);

	$ctr = 0;
	$output = '';
	
	foreach ($xml->channel->item as $key => $item) {
		if ($ctr == $shortcode_args['num']) {
			continue;
		}
		$geturl = $_GET['autoid'];
		if ($geturl == $item->autoid) {

			$images = (array)$item->image;
			$imagelarge = (array)$item->imagelarge;
			
			$index = 0;
			foreach ($imagelarge as $single_image) {
				$output .= '<div class="item">
			            <a class="offer-bg-img" href= "' . $single_image . '" data-rel="lightcase:my-slideshow" style="background-image: url(' . $single_image . ');"></a>
			          </div>';
				$index++;
			}

			$ctr++;
		}

		
	}
	//return the output.
	return $output;
}
// Register the shortcode.
add_shortcode('xcentrum_recent_img', 'xcentrum_shortcode_display_img');

function xcentrum_shortcode_display_img_thumb($img) {

	$xml = xcentrum_get_auto_data();

	

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '10',
		),
		$img
	);

	$ctr = 0;
	$output = '';
	
	foreach ($xml->channel->item as $key => $item) {
		if ($ctr == $shortcode_args['num']) {
			continue;
		}
		$geturl = $_GET['autoid'];
		if ($geturl == $item->autoid) {

			$images = (array)$item->image;
			$imagelarge = (array)$item->imagelarge;
			
			$index = 0;
			foreach ($images as $single_image) {
				$output .= '<div class="item">
			            <a class="offer-bg-img" style="background-image: url(' . $single_image . ');"></a>
			          </div>';
				$index++;
			}

			$ctr++;
		}

		
	}
	//return the output.
	return $output;
}
// Register the shortcode.
add_shortcode('xcentrum_recent_img_thumb', 'xcentrum_shortcode_display_img_thumb');

function xcentrum_shortcode_display_post($attr) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '4',
		),
		$attr
	);

	$ctr = 0;
	$output = '';
	foreach ($xml->channel->item as $key => $item) {
		if ($ctr == $shortcode_args['num']) {
			continue;
		}
		$autoid = $item->autoid;
		$image = $item->image->foto_0;
		$title = $item->title;
		$year = $item->year;
		$km = $item->kilometers;
		$fuel = $item->fuel;
		$price = $item->price;
		$desc = $item->description;
		$carversion = $item->carversion;
		
		$type = $item->type;
		$color = $item->color;
		$transmission = $item->transmission;

		$new_title = $item->category." ".$item->model;

		$output .= '<div class="select-car">';
		if ($image != ''):
			$output .= '<a class ="m-1" href="' . site_url() . '/offer-details/?autoid=' . $autoid . '" data-rel = "lightcase"><img src="' . $image . '" alt="car-selection"></a>';
		endif;

		$output .= '<div class="stock-car-details">';
		if ($title != ''):
			$output .= '<div class="stock-car-heading"><h4><a href="' . site_url() . '/offer-details/?autoid=' . $autoid . '">' . $new_title . '</a></h4></div>';
		endif;

		/*if ($desc->count() != 0):
			$article_data = substr($desc, 0, 100);
			$output .= '<p>' . substr($desc, 0, 100) . '</p>';
		endif;*/

		if ($carversion != ''):
			$output .= '<p>' . $carversion . '</p>';
		endif;

		$output .= '<ul>';
		if ($year != ''):
			$output .= '<li>Bouwjaar ' . $year . '</li>';
		endif;
		if ($km != ''):
			$output .= '<li>' . $km . ' Km</li>';
		endif;
		if ($fuel != ''):
			$output .= '<li>' . $fuel . '</li>';
		endif;
		if ($transmission != ''): 
			$output .= '<li>' . $transmission . '</li>';
		endif;
		if ($type != ''):
			$output .= '<li>' . $type . '</li>';
		endif;
		if ($color != ''):
			$output .= '<li>' . $color . '</li></ul>';
		endif;
		$output .= '</ul>';
		if ($price != ''):
			$output .= '<h4 class="price">€ ' . $price . '</h4>';
		endif;
		$output .= '<a href="' . site_url() . '/offer-details/?autoid=' . $autoid . '" class="button btn-secondary btn-sm view-car">Bekijk deze auto <i
                    class="icon-right-arrow"></i></a>
              </div>
            </div>';
		$ctr++;
	}

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_auto', 'xcentrum_shortcode_display_post');

/*Offer Short Code*/

function xcentrum_shortcode_display_offer($offer) {

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '6',
		),
		$offer
	);
	$ctr = 0;
	$output = '';

	$search_val = isset($_REQUEST['search_val']) ? $_REQUEST['search_val'] : '';
	$search_val_lower = "";
	$title_lower = "";

	$getmodel = $_GET['model'];
	$getbrandsof = $_GET['brandsof'];
	$getbouwjaar = $_GET['bouwjaar'];
	$getprice = $_GET['price'];
	$getprice = str_replace(".", "", $getprice);
	$getprice = (int) $getprice;

	$xml = xcentrum_get_auto_data();
	/*print_r($xml);
	exit;*/

	$page = 1;

	$total_items = 6;
	$offset = 1;
	$limit_offset = 6;
	if (isset($_GET['pagenum']) && $_GET['pagenum'] > 0) {
		$page = $_GET['pagenum'] - 1;

		$offset = ($page * 6) + 1;
		$limit_offset = ($page * 6) + 6;
	}
	$index = 1;

	$temp_index = 1;

	if ($search_val != "" || $getmodel != '' || $getbrandsof != '' || $getbouwjaar != '' || $getprice != '') {

		foreach ($xml->channel->item as $key => $item) {
			

			$autoid = $item->autoid;
			$image = $item->image->foto_0;
			$title = $item->title;
			$year = $item->year;
			$km = $item->kilometers;
			$fuel = $item->fuel;
			$price = $item->price;
			$desc = $item->description;
			$carversion = $item->carversion;
			$type = $item->type;
			$color = $item->color;
			$transmission = $item->transmission;

			
			$flag = 2;

			$price_new = str_replace(".", "", $price);
			$price_new = (int) $price_new;

			if ($search_val != "") {
				$search_val_lower = strtolower($search_val);
				$title_lower = strtolower($title);
				/*if (str_contains($title_lower, $search_val_lower)) {
						//echo $title_lower;
					} else {
						continue;
					}
				*/
			}

			if ($search_val != "" && str_contains($title_lower, $search_val_lower)) {
				//$flag = 1;

				if ($getmodel == "" && $getbrandsof == "" && $getbouwjaar == "" && $getprice == "") {
					$flag = 1;

				} else {
					if ($getmodel != "" && $getbrandsof != "" && $getbouwjaar != "") {
						if ($getmodel == $item->model && $getbrandsof == $item->fuel && $getbouwjaar == $item->year) {
							$flag = 1;
						}

					} elseif ($getmodel != "" && $getbrandsof != "" && $getprice != "") {
						if ($getmodel == $item->model && $getbrandsof == $item->fuel && $getprice >= $price_new) {
							$flag = 1;
						}

					} elseif ($getmodel != "" && $getbouwjaar != "" && $getprice != "") {
						if ($getmodel == $item->model && $getbouwjaar == $item->year && $getprice >= $price_new) {
							$flag = 1;
						}

					} elseif ($getbrandsof != "" && $getbouwjaar != "" && $getprice != "") {
						if ($getbrandsof == $item->fuel && $getbouwjaar == $item->year && $getprice >= $price_new) {
							$flag = 1;
						}

					} elseif ($getmodel != "" && $getbrandsof != "") {
						if ($getmodel == $item->model && $getbrandsof == $item->fuel) {
							$flag = 1;
						}

					} elseif ($getmodel != "" && $getbouwjaar != "") {
						if ($getmodel == $item->model && $getbouwjaar == $item->year) {
							$flag = 1;
						}

					} elseif ($getbrandsof != "" && $getbouwjaar != "") {
						if ($getbouwjaar == $item->year && $getbrandsof == $item->fuel) {
							$flag = 1;
						}

					} elseif ($getbouwjaar != "" && $getprice != "") {
						if ($getbouwjaar == $item->year && $getprice >= $price_new) {
							$flag = 1;
						}

					} elseif ($getmodel != "" && $getprice != "") {
						if ($getmodel == $item->model && $getprice >= $price_new) {
							$flag = 1;
						}

					} elseif ($getmodel != "" && $getmodel == $item->model) {
						$flag = 1;

					} elseif ($getbrandsof != "" && $getbrandsof == $item->fuel) {
						$flag = 1;

					} elseif ($getbouwjaar != "" && $getbouwjaar == $item->year) {
						$flag = 1;

					} elseif ($getprice != "" && $getprice >= $price_new) {
						$flag = 1;

					}
				}

			} else {
				if ($getmodel == "" && $getbrandsof == "" && $getbouwjaar == "" && $getprice == "") {
					$flag = 1;

				} else {
					if ($getmodel != "" && $getbrandsof != "" && $getbouwjaar != "") {
						if ($getmodel == $item->model && $getbrandsof == $item->fuel && $getbouwjaar == $item->year) {
							$flag = 1;
						}

					} elseif ($getmodel != "" && $getbrandsof != "" && $getprice != "") {
						if ($getmodel == $item->model && $getbrandsof == $item->fuel && $getprice >= $price_new) {
							$flag = 1;
						}

					} elseif ($getmodel != "" && $getbouwjaar != "" && $getprice != "") {
						if ($getmodel == $item->model && $getbouwjaar == $item->year && $getprice >= $price_new) {
							$flag = 1;
						}

					} elseif ($getbrandsof != "" && $getbouwjaar != "" && $getprice != "") {
						if ($getbrandsof == $item->fuel && $getbouwjaar == $item->year && $getprice >= $price_new) {
							$flag = 1;
						}

					} elseif ($getmodel != "" && $getbrandsof != "") {
						if ($getmodel == $item->model && $getbrandsof == $item->fuel) {
							$flag = 1;
						}

					} elseif ($getmodel != "" && $getbouwjaar != "") {
						if ($getmodel == $item->model && $getbouwjaar == $item->year) {
							$flag = 1;
						}

					} elseif ($getbrandsof != "" && $getbouwjaar != "") {
						if ($getbouwjaar == $item->year && $getbrandsof == $item->fuel) {
							$flag = 1;
						}

					} elseif ($getbouwjaar != "" && $getprice != "") {
						if ($getbouwjaar == $item->year && $getprice >= $price_new) {
							$flag = 1;
						}

					} elseif ($getmodel != "" && $getprice != "") {
						if ($getmodel == $item->model && $getprice >= $price_new) {
							$flag = 1;
						}

					} elseif ($getmodel != "" && $getmodel == $item->model) {
						$flag = 1;

					} elseif ($getbrandsof != "" && $getbrandsof == $item->fuel) {
						$flag = 1;

					} elseif ($getbouwjaar != "" && $getbouwjaar == $item->year) {
						$flag = 1;

					} elseif ($getprice != "" && $getprice >= $price_new) {
						$flag = 1;

					}
				}
			}
			if ($flag == 1) {

				if ($temp_index >= $offset && $temp_index <= $limit_offset) {
					$new_title = $item->category." ".$item->model;
					$output .= '<div class="select-car" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">';
					if ($image != ''):
						$output .= '<a href="'  . site_url() . '/offer-details/?autoid=' . $autoid .  '"><figure><img src="' . $image . '" alt="car-selection"></figure></a>';
					endif;

					$output .= '<div class="stock-car-details ">'; 
					if ($title != ''):
						$output .= '<h4><a href="' . site_url() . '/offer-details/?autoid=' . $autoid . '">' . $new_title . '</a></h4>';
					endif;
					/*if ($desc->count() != 0):
						$article_data = substr($desc, 0, 100);
						$output .= '<p>' . substr($desc, 0, 100) . '</p>';
					endif;*/
					if ($carversion != ''):
						$output .= '<p>' . $carversion . '</p>';
					endif;
	
					$output .= '<ul>';
					if ($year != ''):
						$output .= '<li>Bouwjaar ' . $year . '</li>';
					endif;
					if ($km != ''):
						$output .= '<li>' . $km . ' Km</li>';
					endif;
					if ($fuel != ''):
						$output .= '<li>' . $fuel . '</li>';
					endif;
					if ($transmission != ''): 
						$output .= '<li>' . $transmission . '</li>';
					endif;
					if ($type != ''):
						$output .= '<li>' . $type . '</li>';
					endif;
					if ($color != ''):
						$output .= '<li>' . $color . '</li></ul>';
					endif;
					$output .= '</ul>';
					if ($price != ''):
						$output .= '<h4 class="price">€ ' . $price . '</h4>';
					endif;
					$output .= '<a href="' . site_url() . '/offer-details/?autoid=' . $autoid . '" class="button btn-secondary btn-sm view-car">Bekijk deze auto <i
							class="icon-right-arrow"></i></a>
					</div>
					</div>';
				}

				//$ctr++;

				$temp_index++;
			}

		}

	} else {

		foreach ($xml->channel->item as $key => $item) {
			if ($ctr == $shortcode_args['num']) {
				//continue;
			}

		

			$autoid = $item->autoid;
			$image = $item->image->foto_0;
			$title = $item->title;
			$year = $item->year;
			$km = $item->kilometers;
			$fuel = $item->fuel;
			$price = $item->price;
			$desc = $item->description;
			$carversion = $item->carversion;
			$category = $item->category;
			$model = $item->model;
			$type = $item->type;
			$color = $item->color;
			$transmission = $item->transmission;


			
			
			

			//print_r($item);

			if ($temp_index >= $offset && $temp_index <= $limit_offset) {
				$output .= '<div class="select-car" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">';
				if ($image != ''):
					$output .= '<a href="'  . site_url() . '/offer-details/?autoid=' . $autoid .  '"><figure><img src="' . $image . '" alt="car-selection"></figure></a>';
				endif;

				$output .= '<div class="stock-car-details ">';
				if ($title != ''):
					$new_title = $category." ".$model;
					$output .= '<h4><a href="' . site_url() . '/offer-details/?autoid=' . $autoid . '">' . $new_title . '</a></h4>';
				endif;
				/*if ($desc->count() != 0):
					$article_data = substr($desc, 0, 100);
					$output .= '<p>' . $article_data . '</p>';
				endif;*/
				if ($carversion != ''):
					$output .= '<p>' . $carversion . '</p>';
				endif;

				$output .= '<ul>';
				if ($year != ''):
					$output .= '<li>Bouwjaar ' . $year . '</li>';
				endif;
				if ($km != ''):
					$output .= '<li>' . $km . ' Km</li>';
				endif;
				if ($fuel != ''):
					$output .= '<li>' . $fuel . '</li>';
				endif;
				if ($transmission != ''):  
					$output .= '<li>' . $transmission . '</li>';
				endif;
				if ($type != ''):
					$output .= '<li>' . $type . '</li>';
				endif;
				if ($color != ''):
					$output .= '<li>' . $color . '</li></ul>';
				endif;
				$output .= '</ul>';
				if ($price != ''):
					$output .= '<h4 class="price">€ ' . $price . '</h4>';
				endif;
				$output .= '<a href="' . site_url() . '/offer-details/?autoid=' . $autoid . '" class="button btn-secondary btn-sm view-car">Bekijk deze auto <i
						class="icon-right-arrow"></i></a>
				</div>
				</div>';
				//$ctr++;
			}

			$temp_index++;
		}
	}

	$pagenum = isset($_GET['pagenum']) ? absint($_GET['pagenum']) : 1;

	$limit = 6; // number of rows in page
	$offset = ($pagenum - 1) * $limit;
	$total = count($xml->channel->item);
	$num_of_pages = ceil($total / $limit);

	$_SESSION['num_of_pages'] = $num_of_pages;
	$_SESSION['pagenum'] = $pagenum;
	//echo "TOTAL = ".$total;

	/*$data_html = '';

		$data_html .= $output;
	*/

	/*if (isset($_GET['pageno'])) {
			$pageno = $_GET['pageno'];
		} else {
			$pageno = 1;
		}

		$no_of_records_per_page = 10;
	*/
	/*$link = $item . '?pg=%d';
		$pagerContainer = '<div style="width: 300px;">';
		if ($totalPages != 0) {
			if ($page == 1) {
				$pagerContainer .= '';
			} else {
				$pagerContainer .= sprintf('<a href="' . $link . '" style="color: #c00"> &#171; prev page</a>', $page - 1);
			}
			$pagerContainer .= ' <span> page <strong>' . $page . '</strong> from ' . $totalPages . '</span>';
			if ($page == $totalPages) {
				$pagerContainer .= '';
			} else {
				$pagerContainer .= sprintf('<a href="' . $link . '" style="color: #c00"> next page &#187; </a>', $page + 1);
			}
		}
	*/

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent', 'xcentrum_shortcode_display_offer');

add_shortcode('xcentrum_pagination_code', 'xcentrum_pagination_code_callback');

function xcentrum_pagination_code_callback() {
	if (isset($_SESSION['num_of_pages'])) {
		$page_links = paginate_links(array(
			'base' => add_query_arg('pagenum', '%#%'),
			'format' => '',
			'prev_text' => __('&laquo;', 'aag'),
			'next_text' => __('&raquo;', 'aag'),
			'total' => $_SESSION['num_of_pages'],
			'current' => $_SESSION['pagenum'],
		));
		if ($page_links) {
			echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' .
				$page_links . '</div></div>';
		}
	}

}

function xcentrum_start_session() {
	if (!headers_sent() && '' == session_id()) {
		session_start();
	}
}
add_action('init', 'xcentrum_start_session');

/* Specificaties Short Code*/
function xcentrum_shortcode_display_speci($speci) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '9',
		),
		$speci
	);

	$ctr = 0;
	$output = '';
	foreach ($xml->channel->item as $key => $item) {
		if ($ctr == $shortcode_args['num']) {
			continue;
		}
		$geturl = $_GET['autoid'];
		if ($geturl == $item->autoid) {

			$model = $item->model;
			$category = $item->category;
			$kenteken = $item->kenteken;
			$color = $item->color;
			$type = $item->type;
			$transmission = $item->transmission;
			$brandstoftank = $item->brandstoftank;
			$manufacturedate = $item->manufacturedate;
			$km = $item->kilometers;
			$fuel = $item->fuel;
			$price = $item->price;
			$desc = $item->description;
			$warranty = $item->warranty;
			$carversion = $item->carversion;
			$apk = $item->apk;
			$image = $item->image->foto_0;

			$output .= '<div class="specify" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
		<table>';
			$output .= '<tr><td>Merk</td>
                  <td><strong>' . $category . '</strong></td></tr>';

			$output .= '<tr><td>Model</td>
                  <td><strong>' . $model . '</strong></td></tr>';

			$output .= '<tr><td>Kenteken</td>
                  <td><strong>' . $kenteken . '</strong></td></tr>';

			$output .= '<tr><td>Uitvoering</td>
                  <td><strong>' . $carversion . '</strong></td></tr>';

			$output .= '<tr><td>Kleur</td>
                  <td><strong>' . $color . '</strong></td></tr>';

			$output .= '<tr><td>Type</td>
                  <td><strong>' . $type . '</strong></td></tr></table>
            </div>';

			$output .= '<div class="specify" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
          <table>';

			$output .= '<tr><td>Transmissie</td>
                  <td><strong>' . $transmission . '</strong></td></tr>';

			$output .= '<tr><td>Brandstof</td>
                  <td><strong>' . $brandstoftank . '</strong></td></tr>';

			$output .= '<tr><td>APK tot</td>
                  <td><strong>' . $apk . '</strong></td></tr>';

			$output .= '<tr><td>Bouwjaar</td>
                  <td><strong>' . $manufacturedate . '</strong></td></tr>';

			$output .= '<tr><td>Km stand</td>
                  <td><strong>' . $km . '</strong></td></tr>';

			$output .= '<tr><td>Garantie</td>
                  <td><strong>' . $warranty . '</strong></td></tr>';

			$output .= '</table>
        </div><div class="specify" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">';
			$output .= '<figure>
            <img src="' . $image . '" alt="specification">
          </figure>
        </div>';

		}
		$ctr++;
	}

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_speci', 'xcentrum_shortcode_display_speci');

/* Techniek, prestaties & verbruik  Short Code*/
function xcentrum_shortcode_display_tech($tech) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '8',
		),
		$tech
	);

	$ctr = 0;
	$output = '';
	foreach ($xml->channel->item as $key => $item) {
		if ($ctr == $shortcode_args['num']) {
			continue;
		}
		$geturl = $_GET['autoid'];
		if ($geturl == $item->autoid) {

			$cylinder = $item->cylinder;
			$motorinhoud = $item->motorinhoud;
			$power = $item->power;
			$acctijd = $item->acctijd;
			$max_koppel = $item->max_koppel;
			$weight = $item->weight;
			$brandstoftank = $item->brandstoftank;
			$verbr_gecomb = $item->verbr_gecomb;
			$wegenbelasting = $item->wegenbelasting;
			$rijklaargewicht = $item->rijklaargewicht;
			$electric = the_field('electric_car', 'option');

			$output .= '
            <div class="specify" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
              <table>';
			$output .= '<tr>
                  <td>Aantal cylinders</td>
                  <td><strong>' . $cylinder . '</strong></td>
                </tr>';
			$output .= '<tr>
                  <td>Motorinhoud</td>
                  <td><strong>' . $motorinhoud . '</strong></td>
                </tr>';
			$output .= '<tr>
                  <td>Vermogen</td>
                  <td><strong>' . $power . '</strong></td>
                </tr>';
			$output .= '<tr>
                  <td>Acceleratietijd 0-100</td>
                  <td><strong>' . $acctijd . '</strong></td>
                </tr>';
			$output .= '<tr>
                  <td>Boring X slag</td>
                  <td><strong>Lorem ipsum</strong></td>
                </tr>';
			$output .= '<tr>
                  <td>Max koppel</td>
                  <td><strong>' . $max_koppel . '</strong></td>
                </tr>';
			$output .= '</table>
            </div>
            <div class="specify" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
              <table>';
			$output .= '<tr>
                  <td>Compressieverh.</td>
                  <td><strong>' . $brandstoftank . '</strong></td>
                </tr>';
			$output .= '<tr>
                  <td>Rijklaargewicht</td>
                  <td><strong>' . $rijklaargewicht . '</strong></td>
                </tr>';
			$output .= '<tr>
                  <td>Gewicht (leeg)</td>
                  <td><strong>' . $weight . '</strong></td>
                </tr>';
			$output .= '<tr>
                  <td>Actieradius</td>
                  <td><strong>' . $electric . '</strong></td>
                </tr>';
			$output .= '<tr>
                  <td>Verbruik gecom.</td>
                  <td><strong>' . $verbr_gecomb . '</strong></td>
                </tr>';
			$output .= '<tr>
                  <td>Wegenbelastinh</td>
                  <td><strong>' . $wegenbelasting . '</strong></td>
                </tr>';
			$output .= '</table>
            </div>';

		}
		$ctr++;
	}

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_tech', 'xcentrum_shortcode_display_tech');

function filter_function() {

	//print_r($_POST);
	$xml = xcentrum_get_auto_data();

	$price_van = $_POST['van_price'];
	$price_tot = $_POST['tot_price'];
	$year_from = $_POST['year_from'];
	$year_to = $_POST['year_to'];
	$km_from = $_POST['km_from'];
	$km_to = $_POST['km_to'];
	

	$getmerk = array();
	$getmodel = array();
	$getbrandsof = array();
	$getbouwjaar = array();
	$getkilometers = array();
	$gettransmission = array();
	$getcolors = array();

	if (isset($_POST['filter__data']) && isset($_POST['filter__data']['merk'])) {
		$getmerk = $_POST['filter__data']['merk'];
	}
	/*if (isset($_POST['filter__data']) && isset($_POST['filter__data']['models'])) {
		$getmodel = $_POST['filter__data']['models'];
	}*/
	if (isset($_POST['filter__data']) && isset($_POST['filter__data']['brandsof'])) {
		$getbrandsof = $_POST['filter__data']['brandsof'];
	}
	/*if (isset($_POST['filter__data']) && isset($_POST['filter__data']['years'])) {
		$getbouwjaar = $_POST['filter__data']['years'];
	}*/
	if (isset($_POST['filter__data']) && isset($_POST['filter__data']['kilometers'])) {
		$getkilometers = $_POST['filter__data']['kilometers'];
	}
	if (isset($_POST['filter__data']) && isset($_POST['filter__data']['transmission'])) {
		$gettransmission = $_POST['filter__data']['transmission'];
	}
	if (isset($_POST['filter__data']) && isset($_POST['filter__data']['colors'])) {
		$getcolors = $_POST['filter__data']['colors'];
	}

	$search_val = isset($_POST['search_val']) ? $_POST['search_val'] : '';

	$search_val_lower = "";
	$title_lower = "";
	//print_r($xml);

	/*echo "<pre>";
		print_r($_POST);
		print_r($xml);
	*/

	$output = "";
	$final_flag = 2;

	//echo "count = ".count($xml->channel->item);

	$total_pages = 1;
	$current_page = 1;
	$offset = 1;
	$limit = 6;
	$limit_entries = 6;
	if (isset($_POST['current_page']) && $_POST['current_page'] > 0) {
		$current_page = $_POST['current_page'];

		$offset = (($current_page - 1) * 6) + 1;
		$limit = (($current_page - 1) * 6) + 6;
	}

	$index = 1;
	$model_array = array();
	$brandstof_array = array();
	$bouwjaar_array = array();
	$kilometerstand_array = array();
	$color_array = array();
	$transmission_array = array();
	
	foreach ($xml->channel->item as $key => $item) {

		$autoid = $item->autoid;
		$image = $item->image->foto_0;
		$title = $item->title;
		$year = $item->year;
		$km = $item->kilometers;
		$fuel = $item->fuel;
		$transmission = $item->transmission;
		$acctijd = $item->acctijd;
		$price = $item->price;
		$desc = $item->description;
		$type = $item->type;
		$color = $item->color;
		$model = $item->model;
		$category = $item->category;
		$carversion = $item->carversion;
		
		//exit;
		$price_new = str_replace(".", "", $price);
		$price_new = (int) $price_new;

		if ($search_val != "") {
			$search_val_lower = strtolower($search_val);
			$title_lower = strtolower($title);
			/*if (str_contains($title_lower, $search_val_lower)) {
					//echo $title_lower;
				} else {
					continue;
			*/
		}
		$flag = 2;

		if(sizeof($getmerk) > 0){
			if(in_array($item->category, $getmerk)){
				$model_array[] = (string)$model;
				$brandstof_array[] = (string)$fuel;
				$bouwjaar_array[] = (string)$year;
				$kilometerstand_array[] = (string)$km;
				$color_array[] = (string)$color;
				$transmission_array[] = (string)$transmission;
				
			}
		}else{

		}
		if ($search_val != "") {
			//$flag = 1;
		
			if (str_contains($title_lower, $search_val_lower)) {
		
				if (sizeof($getmerk) == 0 && sizeof($getmodel) == 0 && sizeof($getbrandsof) == 0 && sizeof($getbouwjaar) == 0 && sizeof($getkilometers) == 0 && sizeof($gettransmission) == 0 && sizeof($getcolors) == 0) {
					$flag = 1;
		
				} else {
					if (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
							$flag = 1;
						}
					} elseif (sizeof($getmerk) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0) {
		
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers)) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($gettransmission) > 0) {
		
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->transmission, $gettransmission)) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbouwjaar) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->year, $getbouwjaar) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
		
						if (in_array($item->category, $getmerk) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0) {
		
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar)) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getbrandsof) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->fuel, $getbrandsof) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
		
						if (in_array($item->category, $getmerk) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($gettransmission) > 0) {
		
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->transmission, $gettransmission)) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0) {
		
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof)) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getbrandsof) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->fuel, $getbrandsof) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->year, $getbouwjaar) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getkilometers) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && in_array($item->kilometers, $getkilometers) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
		
						if (in_array($item->category, $getmerk) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0) {
		
						if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel)) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getbrandsof) > 0) {
		
						if (in_array($item->category, $getmerk) && in_array($item->fuel, $getbrandsof)) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getbouwjaar) > 0) {
		
						if (in_array($item->category, $getmerk) && in_array($item->year, $getbouwjaar)) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getkilometers) > 0) {
		
						if (in_array($item->category, $getmerk) && in_array($item->kilometers, $getkilometers)) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($gettransmission) > 0) {
		
						if (in_array($item->category, $getmerk) && in_array($item->transmission, $gettransmission)) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmerk) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->category, $getmerk) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
		
						if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
							$flag = 1;
						}
		
					} elseif (sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
		
					} elseif (sizeof($getmodel) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->model, $getmodel) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
					} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
					} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
					} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && $check_array_contains == 2) {
							$flag = 1;
						}
					} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0) {
		
						if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers)) {
							$flag = 1;
						}
					} elseif (sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
		
						if (in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
							$flag = 1;
						}
					} elseif (sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
					} elseif (sizeof($getmodel) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->model, $getmodel) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
					} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
					} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && $check_array_contains == 2) {
							$flag = 1;
						}
					} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0) {
		
						if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar)) {
							$flag = 1;
						}
					} elseif (sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0) {
		
						if (in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers)) {
							$flag = 1;
						}
					} elseif (sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
		
						if (in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
							$flag = 1;
						}
					} elseif (sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
					} elseif (sizeof($getmodel) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->model, $getmodel) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
					} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && $check_array_contains == 2) {
							$flag = 1;
						}
					} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0) {
		
						if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof)) {
							$flag = 1;
						}
					} elseif (sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0) {
		
						if (in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers)) {
							$flag = 1;
						}
					} elseif (sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
							$flag = 1;
						}
					} elseif (sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0) {
		
						if (in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar)) {
							$flag = 1;
						}
					} elseif (sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
		
						if (in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
							$flag = 1;
						}
					} elseif (sizeof($getmodel) > 0 && sizeof($getbouwjaar) > 0) {
		
						if (in_array($item->model, $getmodel) && in_array($item->year, $getbouwjaar)) {
							$flag = 1;
						}
					} elseif (sizeof($getbrandsof) > 0 && sizeof($getkilometers) > 0) {
		
						if (in_array($item->fuel, $getbrandsof) && in_array($item->kilometers, $getkilometers)) {
							$flag = 1;
						}
					} elseif (sizeof($getbouwjaar) > 0 && sizeof($gettransmission) > 0) {
		
						if (in_array($item->year, $getbouwjaar) && in_array($item->transmission, $gettransmission)) {
							$flag = 1;
						}
					} elseif (sizeof($getkilometers) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
		
						if (in_array($item->kilometers, $getkilometers) && $check_array_contains == 2) {
							$flag = 1;
						}
					} elseif (sizeof($getmodel) > 0 && sizeof($gettransmission) > 0) {
		
						if (in_array($item->model, $getmodel) && in_array($item->transmission, $gettransmission)) {
							$flag = 1;
						}
					} elseif (sizeof($getbrandsof) > 0 && sizeof($getcolors) > 0) {
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if (in_array($item->fuel, $getbrandsof) && $check_array_contains == 2) {
							$flag = 1;
						}
					} elseif (sizeof($getmodel) > 0) {
		
						if (in_array($item->model, $getmodel)) {
							$flag = 1;
						}
					} elseif (sizeof($getbrandsof) > 0) {
		
						if (in_array($item->fuel, $getbrandsof)) {
							$flag = 1;
						}
					} elseif (sizeof($getbouwjaar) > 0) {
		
						if (in_array($item->year, $getbouwjaar)) {
							$flag = 1;
						}
					} elseif (sizeof($getkilometers) > 0) {
		
						if (in_array($item->kilometers, $getkilometers)) {
							$flag = 1;
						}
					} elseif (sizeof($gettransmission) > 0) {
		
						if (in_array($item->transmission, $gettransmission)) {
							$flag = 1;
						}
					} elseif (sizeof($getcolors) > 0) {
						
						$check_array_contains = check_array_contains($getcolors, $item->color);
						if ($check_array_contains == 2) {
							$flag = 1;
						}
					} elseif (sizeof($getmerk) > 0) {
		
						if (in_array($item->category, $getmerk)) {
							$flag = 1;
						}
		
					}
				}
			}
		
		} else {
					
			if (sizeof($getmerk) == 0 && sizeof($getmodel) == 0 && sizeof($getbrandsof) == 0 && sizeof($getbouwjaar) == 0 && sizeof($getkilometers) == 0 && sizeof($gettransmission) == 0 && sizeof($getcolors) == 0) {
				$flag = 1;
		
			} else {
				if (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
						$flag = 1;
					}
				} elseif (sizeof($getmerk) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0) {
		
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers)) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($gettransmission) > 0) {
		
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->transmission, $gettransmission)) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbouwjaar) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->year, $getbouwjaar) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
		
					if (in_array($item->category, $getmerk) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0) {
		
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar)) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getbrandsof) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->fuel, $getbrandsof) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
		
					if (in_array($item->category, $getmerk) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($gettransmission) > 0) {
		
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->transmission, $gettransmission)) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0) {
		
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof)) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getbrandsof) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->fuel, $getbrandsof) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->year, $getbouwjaar) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getkilometers) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && in_array($item->kilometers, $getkilometers) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
		
					if (in_array($item->category, $getmerk) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getmodel) > 0) {
		
					if (in_array($item->category, $getmerk) && in_array($item->model, $getmodel)) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getbrandsof) > 0) {
		
					if (in_array($item->category, $getmerk) && in_array($item->fuel, $getbrandsof)) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getbouwjaar) > 0) {
		
					if (in_array($item->category, $getmerk) && in_array($item->year, $getbouwjaar)) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getkilometers) > 0) {
		
					if (in_array($item->category, $getmerk) && in_array($item->kilometers, $getkilometers)) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($gettransmission) > 0) {
		
					if (in_array($item->category, $getmerk) && in_array($item->transmission, $gettransmission)) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmerk) > 0 && sizeof($getcolors) > 0) {
					
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->category, $getmerk) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
		
					if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
						$flag = 1;
					}
		
				} elseif (sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
		
				} elseif (sizeof($getmodel) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->model, $getmodel) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
				} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
				} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
				} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && $check_array_contains == 2) {
						$flag = 1;
					}
				} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0) {
		
					if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers)) {
						$flag = 1;
					}
				} elseif (sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
		
					if (in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
						$flag = 1;
					}
				} elseif (sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
				} elseif (sizeof($getmodel) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->model, $getmodel) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
				} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
				} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && $check_array_contains == 2) {
						$flag = 1;
					}
				} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0) {
		
					if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar)) {
						$flag = 1;
					}
				} elseif (sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0) {
		
					if (in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers)) {
						$flag = 1;
					}
				} elseif (sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
		
					if (in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
						$flag = 1;
					}
				} elseif (sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
				} elseif (sizeof($getmodel) > 0 && sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->model, $getmodel) && in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
				} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof) && $check_array_contains == 2) {
						$flag = 1;
					}
				} elseif (sizeof($getmodel) > 0 && sizeof($getbrandsof) > 0) {
		
					if (in_array($item->model, $getmodel) && in_array($item->fuel, $getbrandsof)) {
						$flag = 1;
					}
				} elseif (sizeof($getbouwjaar) > 0 && sizeof($getkilometers) > 0) {
		
					if (in_array($item->year, $getbouwjaar) && in_array($item->kilometers, $getkilometers)) {
						$flag = 1;
					}
				} elseif (sizeof($gettransmission) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->transmission, $gettransmission) && $check_array_contains == 2) {
						$flag = 1;
					}
				} elseif (sizeof($getbrandsof) > 0 && sizeof($getbouwjaar) > 0) {
		
					if (in_array($item->fuel, $getbrandsof) && in_array($item->year, $getbouwjaar)) {
						$flag = 1;
					}
				} elseif (sizeof($getkilometers) > 0 && sizeof($gettransmission) > 0) {
		
					if (in_array($item->kilometers, $getkilometers) && in_array($item->transmission, $gettransmission)) {
						$flag = 1;
					}
				} elseif (sizeof($getmodel) > 0 && sizeof($getbouwjaar) > 0) {
		
					if (in_array($item->model, $getmodel) && in_array($item->year, $getbouwjaar)) {
						$flag = 1;
					}
				} elseif (sizeof($getbrandsof) > 0 && sizeof($getkilometers) > 0) {
		
					if (in_array($item->fuel, $getbrandsof) && in_array($item->kilometers, $getkilometers)) {
						$flag = 1;
					}
				} elseif (sizeof($getbouwjaar) > 0 && sizeof($gettransmission) > 0) {
		
					if (in_array($item->year, $getbouwjaar) && in_array($item->transmission, $gettransmission)) {
						$flag = 1;
					}
				} elseif (sizeof($getkilometers) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->kilometers, $getkilometers) && $check_array_contains == 2) {
						$flag = 1;
					}
				} elseif (sizeof($getmodel) > 0 && sizeof($gettransmission) > 0) {
		
					if (in_array($item->model, $getmodel) && in_array($item->transmission, $gettransmission)) {
						$flag = 1;
					}
				} elseif (sizeof($getbrandsof) > 0 && sizeof($getcolors) > 0) {
					$check_array_contains = check_array_contains($getcolors, $item->color);
					if (in_array($item->fuel, $getbrandsof) && $check_array_contains == 2) {
						$flag = 1;
					}
				} elseif (sizeof($getmodel) > 0) {
		
					if (in_array($item->model, $getmodel)) {
						$flag = 1;
					}
				} elseif (sizeof($getbrandsof) > 0) {
		
					if (in_array($item->fuel, $getbrandsof)) {
						$flag = 1;
					}
				} elseif (sizeof($getbouwjaar) > 0) {
		
					if (in_array($item->year, $getbouwjaar)) {
						$flag = 1;
					}
				} elseif (sizeof($getkilometers) > 0) {
		
					if (in_array($item->kilometers, $getkilometers)) {
						$flag = 1;
					}
				} elseif (sizeof($gettransmission) > 0) {
		
					if (in_array($item->transmission, $gettransmission)) {
						$flag = 1;
					}
				} elseif (sizeof($getcolors) > 0) {
					
					$check_array_contains = check_array_contains($getcolors, $item->color);
					
					if ($check_array_contains == 2) {
						$flag = 1;
					}
				} elseif (sizeof($getmerk) > 0) {
		
					if (in_array($item->category, $getmerk)) {
						$flag = 1;
					}
		
				}
			}
		
		}

		if ($flag == 1) {
			$price_van = $_POST['van_price'];
			$price_tot = $_POST['tot_price'];

			if ((isset($price_van) && $price_van != "") || (isset($price_tot) && $price_tot != "")) {
				if (isset($price_van) && $price_van != "") {
					$price = $item->price;
					$price_new = str_replace(".", "", $price);
					$price_new = (int) $price_new;

					if ($price_new <= $price_van) {
						continue;
					}
				}
				if (isset($price_tot) && $price_tot != "") {
					$price = $item->price;
					$price_new = str_replace(".", "", $price);
					$price_new = (int) $price_new;

					if ($price_new >= $price_tot) {
						continue;
					}
				}
			}
			if ((isset($year_from) && $year_from != "") || (isset($year_to) && $year_to != "")) {
				$year = (int) $year;
				
				if (isset($year_from) && $year_from != "") {
					
					if ($year <= $year_from) {
						continue;
					}
				}
				if (isset($year_to) && $year_to != "") {
					
					if ($year >= $year_to) {
						continue;
					}
				}
			}
			if ((isset($km_from) && $km_from != "") || (isset($km_to) && $km_to != "")) {
				$km = str_replace(".", "", $km);
				$km = (int) $km;
				
				if (isset($km_from) && $km_from != "") {
					
					if ($km <= $km_from) {
						continue;
					}
				}
				if (isset($km_to) && $km_to != "") {
					
					if ($km >= $km_to) {
						continue;
					}
				}
			}


			if ($index >= $offset && $index <= $limit) {
				$final_flag = 1;
				$output .= '<div class="select-car">';
				if ($image != ''):
					$output .= '<a href="'  . site_url() . '/offer-details/?autoid=' . $autoid .  '"><figure><img src="' . $image . '" alt="car-selection"></figure></a>';
				endif;

				$output .= '<div class="stock-car-details">';
				if ($title != ''):
					$new_title = $item->category." ".$item->model;
					$output .= '<h4><a href="' . site_url() . '/offer-details/?autoid=' . $autoid . '">' . $new_title . '</a></h4>';
				endif;

				/*if ($desc->count() != 0):
					$output .= '<p>' . substr($desc, 0, 100) . '</p>';
				endif;
				*/

				if ($carversion != ''):
					$output .= '<p>' . $carversion . '</p>';
				endif;

				$output .= '<ul>';
				if ($year != ''):
					$output .= '<li>Bouwjaar ' . $year . '</li>';
				endif;
				if ($km != ''):
					$output .= '<li>' . $km . ' Km</li>';
				endif;
				if ($fuel != ''):
					$output .= '<li>' . $fuel . '</li>';
				endif;
				if ($transmission != ''):
					$output .= '<li>' . $transmission . '</li>';
				endif;
				if ($type != ''):
					$output .= '<li>' . $type . '</li>';
				endif;
				if ($color != ''):
					$output .= '<li>' . $color . '</li></ul>';
				endif;

				if ($price != ''):
					$output .= '<h4 class="price">€ ' . $price . '</h4>';
				endif;

				$output .= '<a href="' . site_url() . '/offer-details/?autoid=' . $autoid . '" class="button btn-secondary btn-sm view-car">Bekijk deze auto <i
								class="icon-right-arrow"></i></a>
						</div>
						</div>';
			}

			//reset($_POST['array']);
			$index++;
		} else {
			//$output = "<div class=\"nocars\">Er zijn geen auto's voor de geselecteerde criteria !</div>";
		}

	}
	if ($final_flag == 2) {
		$output = "<div class=\"nocars\">Er zijn geen auto's voor de geselecteerde criteria !</div>";
	}
	$model_array = array_values(array_unique($model_array));
	$brandstof_array = array_unique($brandstof_array);
	$bouwjaar_array = array_values(array_unique($bouwjaar_array));
	
	$kilometerstand_array = array_unique($kilometerstand_array);
	$color_array = array_unique($color_array);
	$transmission_array = array_unique($transmission_array);
	




	$total_pages = ceil($index / $limit_entries);
	$current_page = (int) $current_page;
	$result = array(
				"output" 		=> $output, 
				"total_pages" 	=> $total_pages, 
				"current_page" 	=> $current_page, 
				"models"		=> $model_array, 
				"brandsoff"		=> $brandstof_array, 
				"bouwjaar"		=> $bouwjaar_array, 
				"kilometers"	=> $kilometerstand_array, 
				"colors"		=> $color_array,
				"transmission"	=> $transmission_array
				);
	//return the output.
	echo json_encode($result);
	die();
}
add_action('wp_ajax_myfilter', 'filter_function');
add_action('wp_ajax_nopriv_myfilter', 'filter_function');

/*options_comfort Short Code*/

function xcentrum_shortcode_display_comfort($comfort) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '1',
		),
		$comfort
	);

	$ctr = 0;
	$output = '';
	foreach ($xml->channel->item as $key => $item) {
		
		$get_url = $_GET['autoid'];  
		
		if ($get_url == $item->autoid) {
			
			$options_comfort = $item->options_ext;
			$options_comfort = $options_comfort->option;

			$options_array = (array)$options_comfort; 
			
			
			$output .= '<div class="options-list" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
				<ul>';
			
				for ($i=0; $i < sizeof($options_array); $i++) { 
					$output .= '<li>' . $options_array[$i] . '</li>';	
				}
			$output .= '</ul>
				</div>';
		}
		
		$ctr++;
	}

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_comfort', 'xcentrum_shortcode_display_comfort');

function xcentrum_shortcode_display_product($product) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '2',
		),
		$product
	);

	$ctr = 0;
	$output = '';
	foreach ($xml->channel->item as $key => $item) {
		
		$get_url = $_GET['autoid'];
		if ($get_url == $item->autoid) {

			$model = $item->model;
			$category = $item->category;
			$kenteken = $item->kenteken;
			$color = $item->color;
			$type = $item->type;
			$transmission = $item->transmission;
			$brandstoftank = $item->brandstoftank;
			$year = $item->year;
			$km = $item->kilometers;
			$fuel = $item->fuel;
			$price = $item->price;
			$desc = $item->description;
			$carversion = $item->carversion;

			$output .= '<div class="product-title-desc" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">';
			$output .= '<h2>Highlights van deze ' . $category . ' ' . $model . '</h2>';
			$output .= '<p>' . $desc . '</p>';
			$output .= '</div>';
			
		}
		$ctr++;
	}

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_product', 'xcentrum_shortcode_display_product');


function xcentrum_shortcode_recent_product_block($product) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '2',
		),
		$product
	);

	$ctr = 0;
	$output = '';
	foreach ($xml->channel->item as $key => $item) {
		
		$get_url = $_GET['autoid'];
		if ($get_url == $item->autoid) {

			$model = $item->model;
			$category = $item->category;
			$kenteken = $item->kenteken;
			$color = $item->color;
			$type = $item->type;
			$transmission = $item->transmission;
			$brandstoftank = $item->brandstoftank;
			$year = $item->year;
			$km = $item->kilometers;
			$fuel = $item->fuel;
			$price = $item->price;
			$desc = $item->description;
			$carversion = $item->carversion;

			
			$output .= '<div class="product-details-block" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
          <div class="inner">';
			$output .= '<h2>' . $category . '</h2>';
			$output .= '<p>' . $carversion . '</p>';
			$output .= '<ul>';
			$output .= '<li>Bouwjaar ' . $year . '</li>';
			$output .= '<li>' . $km . '</li>';
			$output .= '<li>Bezine</li>';
			$output .= '</ul>';
			$output .= '<h4 class="price">€ ' . $price . '</h4>';
			$output .= '<div class="product-contact">';
			$output .= '<span>' . $carversion . '</span>';
			$output .= '<a href="' . site_url() . '/contact/" class="button">Neem contact op <i class="icon-right-arrow"></i></a>';
			$output .= '</div></div></div>';
		}
		$ctr++;
	}

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_product_block', 'xcentrum_shortcode_recent_product_block');

/* Short Code..........................Filter data...............................*/
function xcentrum_shortcode_offer_fltr_model($model) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '10',
		),
		$model
	);

	$ctr = 0;
	$output = '';
	$output .= '<div class="accordion-row model">';
	$output .= '<h5 class="accordion-trigger">Model</h5>';
	$output .= '<div class="accordion-data">';
	$output .= '<div class="form-block">';
	$arr = array();
	foreach ($xml->channel->item as $key => $item) {
		$arr[] = $item->model;
	}
	$unique_data = array_unique($arr);

	foreach ($unique_data as $model) {
		if ($ctr == $shortcode_args['num']) {
			continue;
		}
		//$model = $item->model;
		$checked = "";
		if (isset($_GET['model']) && $_GET['model'] != "") {
			if ($model == $_GET['model']) {
				$checked = "checked";
			}
		}

		$output .= '<div class="form-group">';
		$output .= '<div class="checkbox">';
		$output .= '<label for="default-checkbox">';
		$output .= '<input type="checkbox" id="default-checkbox" value="' . $model . '" ' . $checked . '>';
		$output .= '<em class="input-helper"></em>';
		$output .= '<span>' . $model . '</span>';
		$output .= '</label></div>
                        </div>';
		$ctr++;
	}
	$output .= '</div>

				</div>

                  </div>';

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_model', 'xcentrum_shortcode_offer_fltr_model');

function xcentrum_shortcode_offer_fltr_category($category) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '11',
		),
		$category
	);

	$ctr = 0;
	$output = '';
	$output .= '<div class="accordion-row merk">';
	$output .= '<h5 class="accordion-trigger">Merk</h5>';
	$output .= '<div class="accordion-data">';
	$output .= '<div class="form-block">';

	$arr = array();
	foreach ($xml->channel->item as $key => $item) {
		$arr[] = $item->category;
	}
	$unique_data = array_unique($arr);

	foreach ($unique_data as $category) {
		if ($ctr == $shortcode_args['num']) {
			continue;
		}
		//$category = $item->category;
		//print_r($category);

		$result = array_unique($category);
		$output .= '<div class="form-group">';
		$output .= '<div class="checkbox">';
		$output .= '<label for="default-checkbox">';
		$output .= '<input type="checkbox" id="default-checkbox" value="' . $category . '">';
		$output .= '<em class="input-helper"></em>';
		$output .= '<span>' . $category . '</span>';
		$output .= '</label></div>
                        </div>';
		$ctr++;
	}
	$output .= '</div>
				</div>
                  </div>';

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_category', 'xcentrum_shortcode_offer_fltr_category');

function xcentrum_shortcode_offer_fltr_brandstoftank($brandstoftank) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '12',
		),
		$brandstoftank
	);

	$ctr = 0;
	$output = '';
	$output .= '<div class="accordion-row brandsof">';
	$output .= '<h5 class="accordion-trigger">Brandstof</h5>';
	$output .= '<div class="accordion-data">';
	$output .= '<div class="form-block">';

	$arr = array();
	foreach ($xml->channel->item as $key => $item) {
		$arr[] = $item->fuel;
	}
	$unique_data = array_unique($arr);

	foreach ($unique_data as $fuel) {
		if ($ctr == $shortcode_args['num']) {
			continue;
		}
		//$fuel = $item->fuel;
		$checked = "";
		if (isset($_GET['brandsof']) && $_GET['brandsof'] != "") {
			if ($fuel == $_GET['brandsof']) {
				$checked = "checked";
			}
		}

		$output .= '<div class="form-group">';
		$output .= '<div class="checkbox">';
		$output .= '<label for="default-checkbox">';
		$output .= '<input type="checkbox" id="default-checkbox" value="' . $fuel . '" ' . $checked . '>';
		$output .= '<em class="input-helper"></em>';
		$output .= '<span>' . $fuel . '</span>';
		$output .= '</label></div>
                        </div>';
		$ctr++;
	}
	$output .= '</div>
				</div>
                  </div>';

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_brandstoftank', 'xcentrum_shortcode_offer_fltr_brandstoftank');

function xcentrum_shortcode_offer_fltr_price($price) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '13',
		),
		$price
	);

	$ctr = 0;
	$output = '';

	$output .= '<div class="accordion-row price">
                    <h5 class="accordion-trigger">Prijs</h5>
					<div class="form-block">
						<div class="form-group">
						<div class="price-details">
							<span class="prefix">Vat &euro; </span>
							<input type="text" name="price_van" class="price_van" value="">
							
						</div>
						<div class="price-details">
							<span class="prefix">Tot &euro; </span>
							<input type="text" name="price_tot" class="price_tot" value="">							
						</div>
						</div>
					</div>
            	</div>';

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_price', 'xcentrum_shortcode_offer_fltr_price');

function xcentrum_shortcode_offer_fltr_year($year) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '14',
		),
		$year
	);

	$ctr = 0;
	$output = '';
	$output .= '<div class="accordion-row year">';
	$output .= '<h5 class="accordion-trigger">Bouwjaar</h5>';
	$output .= '<div class="accordion-data">
					<div class="form-block">
						<div class="form-group">';
	$output .= '<select name="year_from" class="year_from">';
	$year = date("Y"); 
	for($i=2000;$i<=$year;$i++){
		$output .= '<option value="'.$i.'">'.$i.'</option>';
	}
	$output .= '	</select>
				</div>';
	$output .= '<div class="form-group">';
	$output .= '<select name="year_to" class="year_to">';
	for($i=2000;$i<=$year;$i++){
		$flag = "";
		if($i == $year){
			$flag = "selected";
		}
		$output .= '<option value="'.$i.'" '.$flag.'>'.$i.'</option>';
	}
	$output .= '</select></div></div></div></div>'; 

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_years', 'xcentrum_shortcode_offer_fltr_year');

function xcentrum_shortcode_offer_fltr_kilometers($kilometers) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '15',
		),
		$kilometers
	);

	$ctr = 0;
	$output = '';
	$output .= '<div class="accordion-row kilometer">';
	$output .= '<h5 class="accordion-trigger">Kilometerstand</h5>';
	$output .= '<div class="accordion-data">';
	$output .= '	<div class="form-block">
						<div class="form-group">
							<div class="km-details">
								<input type="text" name="km_from" class="km_from" value="">
								<span class="suffix">km</span>
							</div>
							<div class="km-details">
								<input type="text" name="km_to" class="km_to" value="">
								<span class="suffix">km</span>
							</div>
						</div>	
					</div>
				</div>
				</div>';

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_kilometers', 'xcentrum_shortcode_offer_fltr_kilometers');

function xcentrum_shortcode_offer_fltr_transmission($transmission) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '16',
		),
		$transmission
	);

	$ctr = 0;
	$output = '';
	$output .= '<div class="accordion-row transmission">';
	$output .= '<h5 class="accordion-trigger">Transmissie</h5>';
	$output .= '<div class="accordion-data">';
	$output .= '<div class="form-block">';

	$arr = array();
	foreach ($xml->channel->item as $key => $item) {
		$arr[] = $item->transmission;
	}
	$unique_data = array_unique($arr);

	foreach ($unique_data as $transmission) {
		if ($ctr == $shortcode_args['num']) {
			continue;
		}
		//$transmission = $item->transmission;

		$output .= '<div class="form-group">';
		$output .= '<div class="checkbox">';
		$output .= '<label for="default-checkbox">';
		$output .= '<input type="checkbox" id="default-checkbox" value="' . $transmission . '">';
		$output .= '<em class="input-helper"></em>';
		$output .= '<span>' . $transmission . '</span>';
		$output .= '</label></div>
                        </div>';
		$ctr++;
	}
	$output .= '</div>
				</div>
                  </div>';

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_transmission', 'xcentrum_shortcode_offer_fltr_transmission');

function xcentrum_shortcode_offer_fltr_carroserie($carroserie) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '17',
		),
		$carroserie
	);

	$ctr = 0;
	$output = '';
	$output .= '<div class="accordion-row">';
	$output .= '<h5 class="accordion-trigger">Carversion</h5>';
	$output .= '<div class="accordion-data">';
	$output .= '<div class="form-block">';

	$arr = array();
	foreach ($xml->channel->item as $key => $item) {
		$arr[] = $item->carversion;
	}
	$unique_data = array_unique($arr);

	foreach ($unique_data as $carversion) {
		if ($ctr == $shortcode_args['num']) {
			continue;
		}
		//$carversion = $item->carversion;

		$output .= '<div class="form-group">';
		$output .= '<div class="checkbox">';
		$output .= '<label for="default-checkbox">';
		$output .= '<input type="checkbox" id="default-checkbox" value="' . $carversion . '">';
		$output .= '<em class="input-helper"></em>';
		$output .= '<span>' . $carversion . '</span>';
		$output .= '</label></div>
                        </div>';
		$ctr++;
	}
	$output .= '</div>
				</div>
                  </div>';

	//return the output.
	return $output;
}

function check_array_contains(array $arr,$str){
	$flag = 1;
    foreach($arr as $a){
        if (strpos($str,$a) !== false) { 
			$flag = 2;
		}
    }
	return $flag;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_carroserie', 'xcentrum_shortcode_offer_fltr_carroserie');

function xcentrum_shortcode_offer_fltr_color($color) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '18',
		),
		$color
	);

	$ctr = 0;
	$output = '';
	$output .= '<div class="accordion-row color">';
	$output .= '<h5 class="accordion-trigger">Kleur</h5>';
	$output .= '<div class="accordion-data">';
	$output .= '<div class="form-block">';

	$arr = array();
	foreach ($xml->channel->item as $key => $item) {
		$arr[] = $item->color;
	}
	$unique_data = array_unique($arr);

	$output .= '<div class="form-group">
					<div class="checkbox">
						<label for="default-checkbox">
							<input type="checkbox" id="default-checkbox" value="BLAUW">
							<em class="input-helper"/>
							<span>BLAUW</span>
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="checkbox">
						<label for="default-checkbox">
							<input type="checkbox" id="default-checkbox" value="GRIJS">
							<em class="input-helper"/>
							<span>GRIJS</span>
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="checkbox">
						<label for="default-checkbox">
							<input type="checkbox" id="default-checkbox" value="GROEN">
							<em class="input-helper"/>
							<span>GROEN</span>
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="checkbox">
						<label for="default-checkbox">
							<input type="checkbox" id="default-checkbox" value="WIT">
							<em class="input-helper"/>
							<span>WIT</span>
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="checkbox">
						<label for="default-checkbox">
							<input type="checkbox" id="default-checkbox" value="ZILVER">
							<em class="input-helper"/>
							<span>ZILVER</span>
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="checkbox">
						<label for="default-checkbox">
							<input type="checkbox" id="default-checkbox" value="ZWART">
							<em class="input-helper"/>
							<span>ZWART</span>
						</label>
					</div>
				</div>';
	/*
	foreach ($unique_data as $color) {
		if ($ctr == $shortcode_args['num']) {
			continue;
		}
		//$carversion = $item->carversion;

		$output .= '<div class="form-group">';
		$output .= '<div class="checkbox">';
		$output .= '<label for="default-checkbox">';
		$output .= '<input type="checkbox" id="default-checkbox" value="' . $color . '">';
		$output .= '<em class="input-helper"></em>';
		$output .= '<span>' . $color . '</span>';
		$output .= '</label></div>
                        </div>';
		$ctr++;
	}*/
	$output .= '</div>
				</div>
                  </div>';

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_color', 'xcentrum_shortcode_offer_fltr_color');

function xcentrum_shortcode_search_merkmodel($merkmodel) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '19',
		),
		$merkmodel
	);

	$ctr = 0;
	$output = '';
	$output .= '<div class="custom-select" ><select id="model" name="model">';
	$output .= '<option value="">Merk/Model</option>';

	$arr = array();
	foreach ($xml->channel->item as $key => $item) {
		$arr[] = $item->model;
		$category[] = $item->category;
	}
	$unique_data = array_unique($arr);

	foreach ($unique_data as $model) {
		if ($ctr == $shortcode_args['num']) {
			continue;
		}

		$output .= '<option value="' . $model . '">' . $model . '</option>';

		$ctr++;
	}

	$unique_data = array_unique($category);
	//print_r($unique_data);

	foreach ($unique_data as $cat) {
		if ($ctr == $shortcode_args['num']) {
			continue;
		}
		/*print_r("hii");
		exit;*/
		$output .= '<option>' . $cat . '</option>';

		$ctr++;
	}
	$output .= '</select></div>';

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_merkmodel', 'xcentrum_shortcode_search_merkmodel');

function xcentrum_shortcode_search_brandsof($brandsof) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '20',
		),
		$brandsof
	);

	$ctr = 0;
	$output = '';
	$output .= '<div class="custom-select"><select id="brandsof" name="brandsof">';
	$output .= '<option value="">Brandstof</option>';

	$arr = array();
	foreach ($xml->channel->item as $key => $item) {
		$arr[] = $item->fuel;
	}
	$unique_data = array_unique($arr);

	foreach ($unique_data as $fuel) {
		if ($ctr == $shortcode_args['num']) {
			continue;
		}

		$output .= '<option value="' . $fuel . '">' . $fuel . '</option>';

		$ctr++;
	}
	$output .= '</select></div>';

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_brandsof', 'xcentrum_shortcode_search_brandsof');

function xcentrum_shortcode_search_year($year) {

	$xml = xcentrum_get_auto_data();

	// Defines Shortcode's Attributes
	$shortcode_args = shortcode_atts(
		array(
			'num' => '21',
		),
		$year
	);

	$ctr = 0;
	$output = '';
	$output .= '<div class="custom-select"><select id="bouwjaar" name="bouwjaar">';
	$output .= '<option value="">Bouwjaar vanaf</option>';

	$arr = array();
	foreach ($xml->channel->item as $key => $item) {
		$arr[] = $item->year;
	}
	$unique_data = array_unique($arr);

	foreach ($unique_data as $year) {
		if ($ctr == $shortcode_args['num']) {
			continue;
		}

		$output .= '<option value="' . $year . '">' . $year . '</option>';

		$ctr++;
	}
	$output .= '</select></div>';

	//return the output.
	return $output;
}

// Register the shortcode.
add_shortcode('xcentrum_recent_year', 'xcentrum_shortcode_search_year');

// add a parent item to the WordPress admin toolbar

function add_link_to_admin_bar($admin_bar) {
    $args = array(
        'id' => 'refresh-api-data',
        'title' => 'Refresh API data', 
        'href' => 'https://x-centrum.nl/load_api_data.php'
    );
    $admin_bar->add_node($args);
}
	
add_action('admin_bar_menu', 'add_link_to_admin_bar', 999);