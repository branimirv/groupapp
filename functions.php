<?php
/**
 * GroupApp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package GroupApp
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function groupapp_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on GroupApp, use a find and replace
		* to change 'groupapp' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'groupapp', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'header', 'groupapp' ),
			'footer-1' => esc_html__( 'footer1', 'groupapp' ),
			'footer-2' => esc_html__( 'footer2', 'groupapp' ),
			'footer-3' => esc_html__( 'footer3', 'groupapp' ),
			'footer-4' => esc_html__( 'footer4', 'groupapp' ),
			'filter' => esc_html__( 'filter', 'groupapp' ),
			'auth' => esc_html__( 'auth', 'groupapp' ),
		)
	
	);
	if ( function_exists('register_sidebar') )
    register_sidebar(array(
    'name'  => 'Footer 1',
    'id'    => 'footer-1',
    'description'   => 'Widget that are place here will appear in the "Footer Column 1"',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4 class="footer-title">',
    'after_title' => '</h4>',
  )
);
if ( function_exists('register_sidebar') )
    register_sidebar(array(
    'name'  => 'Footer 2',
    'id'    => 'footer-2',
    'description'   => 'Widget that are place here will appear in the "Footer Column 2"',
	'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4 class="footer-title">',
    'after_title' => '</h4>',
  )
);
if ( function_exists('register_sidebar') )
    register_sidebar(array(
    'name'  => 'Footer 3',
    'id'    => 'footer-3',
    'description'   => 'Widget that are place here will appear in the "Footer Column 3"',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4 class="footer-title">',
    'after_title' => '</h4>',
  )
);
if ( function_exists('register_sidebar') )
    register_sidebar(array(
    'name'  => 'Footer 4',
    'id'    => 'footer-4',
	'before_widget' => '',
    'after_widget' => '',
    'description'   => 'Widget that are place here will appear in the "Footer Sidebar"',
    'before_title' => '<h4 class="footer-title">',
    'after_title' => '</h4>',
  )
); 
if ( function_exists('register_sidebar') )
    register_sidebar(array(
    'name'  => 'Footer 5',
    'id'    => 'footer-5',
    'description'   => 'Widget that are place here will appear in the "Footer Sidebar"',
	'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4 class="footer-title">',
    'after_title' => '</h4>',
  )
); 
// if ( function_exists('register_sidebar') )
//     register_sidebar(array(
//     'name'  => 'Filter',
//     'id'    => 'Filter',
//     'description'   => 'Widget that are place here will appear in the "Footer Sidebar"',
// 	'before_widget' => '',
//     'after_widget' => '',
//     'before_title' => '<h4 class="footer-title">',
//     'after_title' => '</h4>',
//   )
// ); 

   

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'groupapp_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'groupapp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function groupapp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'groupapp_content_width', 640 );
}
add_action( 'after_setup_theme', 'groupapp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function groupapp_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'groupapp' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'groupapp' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'groupapp_widgets_init' );

/**
 * Get Webpack asset manifest
 */
function groupapp_get_asset_manifest() {
	$manifest_path = get_template_directory() . '/dist/asset-manifest.json';
	
	if ( file_exists( $manifest_path ) ) {
		$manifest = json_decode( file_get_contents( $manifest_path ), true );
		return $manifest ? $manifest : array();
	}
	
	return array();
}

/**
 * Get asset URL with cache busting
 */
function groupapp_get_asset_url( $asset ) {
	// Check if we're in development mode (Webpack dev server is running)
	$dev_server_url = 'http://localhost:3000/';
	$is_dev_mode = false;
	
	// Check if dev server is running by trying to access the asset
	if ( function_exists( 'wp_remote_get' ) ) {
		$test_url = $dev_server_url . $asset;
		$response = wp_remote_get( $test_url, array(
			'timeout' => 1,
			'sslverify' => false
		) );
		
		if ( ! is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) === 200 ) {
			$is_dev_mode = true;
		}
	}
	
	// If dev server is running, use dev server URLs
	if ( $is_dev_mode ) {
		return $dev_server_url . $asset;
	}
	
	// Production mode: use manifest and built files
	$manifest = groupapp_get_asset_manifest();
	
	// If we have a manifest and the asset exists, use it
	if ( ! empty( $manifest ) ) {
		$manifest_keys = array(
			$asset,
			str_replace( array( 'css/', 'js/' ), '', $asset ),
		);

		foreach ( $manifest_keys as $manifest_key ) {
			if ( isset( $manifest[ $manifest_key ] ) ) {
				return get_template_directory_uri() . '/dist/' . ltrim( $manifest[ $manifest_key ], '/' );
			}
		}
	}
	
	// Fallback: look for actual files with hashes in dist folder
	$dist_path = get_template_directory() . '/dist/';
	
	if ( strpos( $asset, 'css/' ) === 0 ) {
		$pattern = $dist_path . 'css/main.*.css';
		$files = glob( $pattern );
		if ( ! empty( $files ) ) {
			$filename = basename( $files[0] );
			return get_template_directory_uri() . '/dist/css/' . $filename;
		}
	} elseif ( strpos( $asset, 'js/' ) === 0 ) {
		$js_name = str_replace( 'js/', '', $asset );
		$js_name = str_replace( '.js', '', $js_name );
		$pattern = $dist_path . 'js/' . $js_name . '.*.js';
		$files = glob( $pattern );
		if ( ! empty( $files ) ) {
			$filename = basename( $files[0] );
			return get_template_directory_uri() . '/dist/js/' . $filename;
		}
	}
	
	// Final fallback to direct path
	$asset_path = '/dist/' . $asset;
	$full_path = get_template_directory() . $asset_path;
	
	if ( file_exists( $full_path ) ) {
		return get_template_directory_uri() . $asset_path . '?v=' . filemtime( $full_path );
	}
	
	return false;
}

/**
 * Enqueue scripts and styles.
 */
function groupapp_scripts() {
	// Main CSS - try Webpack built version first, fallback to theme default
	$main_css = groupapp_get_asset_url( 'css/main.css' );
	if ( $main_css ) {
		wp_enqueue_style( 'groupapp-main', $main_css, array(), null );
	} else {
		// Fallback to default WordPress style
		wp_enqueue_style( 'groupapp-style', get_stylesheet_uri(), array(), _S_VERSION );
	}
	
	// RTL support
	wp_style_add_data( 'groupapp-main', 'rtl', 'replace' );

	// Vendor JavaScript must load before main (webpack split chunks).
	$vendor_js = groupapp_get_asset_url( 'js/vendors.js' );
	if ( $vendor_js ) {
		wp_enqueue_script( 'groupapp-vendors', $vendor_js, array(), null, true );
	}

	// Main JavaScript bundle
	$main_js = groupapp_get_asset_url( 'js/main.js' );
	if ( $main_js ) {
		$main_deps = $vendor_js ? array( 'groupapp-vendors' ) : array();
		wp_enqueue_script( 'groupapp-main', $main_js, $main_deps, null, true );

		// Add WordPress AJAX support
		wp_localize_script( 'groupapp-main', 'groupapp_ajax', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'groupapp_nonce' ),
		) );
	}

	// Legacy navigation script fallback
	$navigation_path = get_template_directory() . '/js/navigation.js';
	if ( ! $main_js && file_exists( $navigation_path ) ) {
		wp_enqueue_script( 'groupapp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	}

	// Comment reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'groupapp_scripts' );

/**
 * Replace WordPress core jQuery with the bundled copy from vendors/main.
 * Plugins that list jquery as a dependency still load in the correct order.
 */
function groupapp_jquery_shim() {
	if ( is_admin() ) {
		return;
	}

	$main_js = groupapp_get_asset_url( 'js/main.js' );
	if ( ! $main_js ) {
		return;
	}

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', false, array( 'groupapp-main' ), null, true );
	wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'groupapp_jquery_shim', 100 );

/**
 * Enqueue admin styles and scripts
 */
function groupapp_admin_scripts( $hook ) {
	// Admin CSS
	$admin_css = groupapp_get_asset_url( 'css/admin.css' );
	if ( $admin_css ) {
		wp_enqueue_style( 'groupapp-admin', $admin_css, array(), null );
	}
	
	// Admin JavaScript
	$admin_js = groupapp_get_asset_url( 'js/admin.js' );
	if ( $admin_js ) {
		wp_enqueue_script( 'groupapp-admin', $admin_js, array( 'jquery' ), null, true );
	}
}
add_action( 'admin_enqueue_scripts', 'groupapp_admin_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_theme_support( 'custom-logo' );
add_theme_support( 'custom-logo', array(
	'height'      => 100,
	'width'       => 400,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-description' ),
) );
function theme_prefix_setup() {
	
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-width' => true,
	) );

}
add_action( 'after_setup_theme', 'theme_prefix_setup' );
function theme_prefix_the_custom_logo() {
	
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}

}






function wpb_widgets_init() {

	register_sidebar( array(
		'name'          => 'header button',
		'id'            => 'custom-header-widget',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="chw-title">',
		'after_title'   => '</h2>',
	) );
	// register_sidebar( array(
	// 	'name'          => 'image add foote',
	// 	'id'            => 'custom-footer-widget',
	// 	'before_widget' => '',
	// 	'after_widget'  => '',
	// 	'before_title'  => '<h2 class="chw-title">',
	// 	'after_title'   => '</h2>',
	// ) );

}
add_action( 'widgets_init', 'wpb_widgets_init' );

// add_action( 'template_redirect', 'single_post_second_loop_pagingation_fix', 0 );
//     function single_post_second_loop_pagingation_fix() {
//         if ( is_singular( 'post' ) ) {
//             global $wp_query;
//             $page = ( int ) $wp_query->get( 'page' );
//             if ( $page > 1 ) {
 
//                     $query->set( 'page', 1 );
//                     $query->set( 'paged', $page );
//             }
//             remove_action( 'template_redirect', 'redirect_canonical' );
//         }
//     }
function my_excerpt_length( $length ) {
    return 3; // Устанавливаем максимальное количество слов в строке
}

function custom_excerpt_length( $length ) {
    return 25; // Устанавливаем максимальное количество строк
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more($more) {
    global $post;
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function wptp_create_post_type() {
	$labels = array(
	  'name' => __( 'Customer stories' ),
	  'singular_name' => __( 'stories' ),
	  'add_new' => __( 'New stories' ),
	  'add_new_item' => __( 'Add New Article' ),
	  'edit_item' => __( 'Edit Article' ),
	  'new_item' => __( 'New Article' ),
	  'view_item' => __( 'View Article' ),
	  'search_items' => __( 'Search Articles' ),
	  'not_found' =>  __( 'No Articles Found' ),
	  'not_found_in_trash' => __( 'No Articles found in Trash' ),
	//   'taxonomies' => array('category'),
	  );
	$args = array(
		'rewrite' => array('slug' => 'customer-stories', 'with_front' => false),
	  'labels' => $labels,
	//   'has_archive' => 'customer-stories',
	  'public' => true,
	  'hierarchical' => false,
	//   'taxonomies' => array('category'),
	  'menu_position' => 5,
	  'supports' => array(
		'title',
		'editor',
		'excerpt',
		'custom-fields',
		'thumbnail',
		
		),
		
	  );
	register_post_type( 'customer-stories', $args );
	
  }
  add_action( 'init', 'wptp_create_post_type' );
  

//   function new_create_post_type() {
// 	$labels = array(
// 	  'name' => __( 'Customer stories' ),
// 	  'singular_name' => __( 'stories' ),
// 	  'add_new' => __( 'New stories' ),
// 	  'add_new_item' => __( 'Add New Article' ),
// 	  'edit_item' => __( 'Edit Article' ),
// 	  'new_item' => __( 'New Article' ),
// 	  'view_item' => __( 'View Article' ),
// 	  'search_items' => __( 'Search Articles' ),
// 	  'not_found' =>  __( 'No Articles Found' ),
// 	  'not_found_in_trash' => __( 'No Articles found in Trash' ),
// 	//   'taxonomies' => array('category'),
// 	  );
// 	$args = array(
// 		'rewrite' => array('slug' => 'customer-stories', 'with_front' => false),
// 	  'labels' => $labels,
// 	//   'has_archive' => 'customer-stories',
// 	  'public' => true,
// 	  'hierarchical' => false,
// 	//   'taxonomies' => array('category'),
// 	  'menu_position' => 7,
// 	  'supports' => array(
// 		'title',
// 		'editor',
// 		'excerpt',
// 		'custom-fields',
// 		'thumbnail',
		
// 		),
		
// 	  );
// 	register_post_type( 'customer_stories', $args );
	
//   }
//   add_action( 'init', 'new_create_post_type' );


function delseocategory($cat) {
	$cat = str_replace('/category', 's', $cat);
	return $cat;
   }
   add_filter('category_link', 'delseocategory', 1, 1);



//blog
   add_action('wp_ajax_load_more_posts', 'load_more_posts');
   add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');
   function load_more_posts() {
	
	  $args = array(
		  'post_type'   => 'post',
		  'paged'       => $_POST['page'] + 1,
		  'post_status' => 'publish',
		  'posts_per_page' => 21,
		  
	  );
   
	  $query = new WP_Query($args);
   
	  $num_posts = $_POST['num_posts']; // количество постов, которые были загружены до этого
   
	  if ($query->have_posts()) :
		 while ($query->have_posts()) :
		   $query->the_post();
		   $num_posts++; // увеличиваем количество постов после каждой итерации цикла
		   ?>
			<div class="col-lg-4 col-sm-6 col-12 ttd ">
				  <div class="block-tupical-min minimg">
				  <a href="<?php the_permalink(); ?>">
				  <div class='brd'>
				<?php the_post_thumbnail('post-thumb'); ?>
				  </div>
				  </a>
				  <?php
    $category = get_the_category();
    if ( $category && ! is_wp_error( $category ) ) {
        $category_link = get_category_link( $category[0]->term_id );
        if ( url_to_postid( $category_link ) !== 0 ) {
            ?>
            <div class="cat"><a class='gr' href="<?php echo esc_url( $category_link ); ?>"><?php echo esc_html( $category[0]->name ); ?></a><span><?php echo do_shortcode('[rt_reading_time]'); ?>min read</span></div>
            <?php
        } else {
            ?>
            <div class="cat"><b class='gr'><?php echo esc_html( $category[0]->name ); ?></b><span><?php echo do_shortcode('[rt_reading_time]'); ?>min read</span></div>
            <?php
        }
    }
?>
                        <a href="<?php the_permalink(); ?>">
                            <p class="title">
                                <?php the_title();?>
                            </p>
                        </a>
					  <div class="text"><?php the_excerpt(); ?></div>
					  <p class="ptr"><?php the_author(); ?> <span><?php the_date(); ?></span></p>
				  </div>
			  </div>
		  <?php
		 endwhile;
		 
	   endif;
	 
	   wp_reset_postdata();
	   wp_die();
	   
	   if ($num_posts < $_POST['total_posts']) { // проверяем, есть ли еще посты, которые можно загрузить
		  echo 'true'; // отправляем ответ "true" в случае, если есть еще посты
	   } else {
		  echo 'false'; // отправляем пустой ответ в случае, если больше нет постов
	   }
   }

   function get_current_category() {
    $uri = urldecode($_SERVER['REQUEST_URI']);
    
    $parts = explode('/', $uri);
    // Индекс категории может варьироваться в зависимости от вашего формата ссылок,
    // поэтому вам может потребоваться адаптировать этот код для вашего случая.
    $category_index = array_search('blogs', $parts);
    if ($category_index !== false && isset($parts[$category_index+1])) {
        return $parts[$category_index+1];
    }
    
    return '';
}
$cat = get_current_category();
// echo $cat;
//category blog

// var_dump($cat);
function load_more_posts_cat() {
   
    $category = $_POST['category'];
    // var_dump($category);
    $args = array(
        'post_type' => 'post',
        'paged' => $_POST['page'] + 1,
        'post_status' => 'publish',
        'posts_per_page' => 21,
        'category_name' => $category,
    );
    
    $query = new WP_Query($args);
    $num_posts = $_POST['num_posts'];
    
    ob_start(); // начинаем буферизацию вывода
    
    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
            ?>
            <div class="col-lg-4 col-sm-6 col-12 ttd ">
              <div class="block-tupical-min minimg">
                <a href="<?php the_permalink(); ?>">
                  <div class='brd'>
                    <?php the_post_thumbnail('post-thumb'); ?>
                  </div>
                </a>
                <?php
                  $category = get_the_category();
                  if ($category && !is_wp_error($category)) {
                    $category_link = get_category_link($category[0]->term_id);
                    if (url_to_postid($category_link) !== 0) {
                      ?>
                      <div class="cat"><a class='gr' href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($category[0]->name); ?></a><span><?php echo do_shortcode('[rt_reading_time]'); ?>min read</span></div>
                      <?php
                    } else {
                      ?>
                      <div class="cat"><b class='gr'><?php echo esc_html($category[0]->name); ?></b><span><?php echo do_shortcode('[rt_reading_time]'); ?>min read</span></div>
                      <?php
                    }
                  }
                ?>
                <a href="<?php the_permalink(); ?>">
                  <p class="title">
                    <?php the_title();?>
                  </p>
                </a>
                <div class="text"><?php the_excerpt(); ?></div>
                <p class="ptr"><?php the_author(); ?> <span><?php the_date(); ?></span></p>
              </div>
            </div>
            <?php
        endwhile;
    endif;
    
    wp_reset_postdata();
    $result = ob_get_clean(); // заканчиваем буферизацию вывода и сохраняем результат в переменной

    $response = array(
        'category' => $category, // добавляем категорию в ответ
        'result' => $result, // добавляем HTML-код постов в ответ
        'has_more_posts' => ($num_posts < $_POST['total_posts']) ? true : false // добавляем информацию о том, есть ли еще посты для загрузки
    );
    
    wp_send_json_success($response); // отправляем успешный ответ в JSON-формате
}

add_action('wp_ajax_load_more_posts_cat', 'load_more_posts_cat');
add_action('wp_ajax_nopriv_load_more_posts_cat', 'load_more_posts_cat');





function custom_admin_styles() {
    wp_enqueue_style( 'custom-admin-styles', get_stylesheet_directory_uri() . '/admin-styles.css' );
}

add_action( 'admin_enqueue_scripts', 'custom_admin_styles' );


// ACF POSTS CTA
if( function_exists('acf_add_options_page') ) {
    
	acf_add_options_sub_page(array(
		'page_title'    => 'Posts CTA',
        'menu_title'    => 'Posts CTA',
        'menu_slug'     => 'posts-cta',
        'capability'    => 'edit_posts',
		'parent_slug'	=> 'edit.php',
		'position'		=> false,
		'icon_url'		=> false,
	));

	acf_add_options_sub_page(array(
		'page_title'    => 'Posts AD',
        'menu_title'    => 'Posts AD',
        'menu_slug'     => 'posts-ad',
        'capability'    => 'edit_posts',
		'parent_slug'	=> 'edit.php',
		'position'		=> false,
		'icon_url'		=> false,
	));
    
}

// Helper function for bold
function check_span_title($title) {
    return str_replace( [ '{{', '}}' ], [ '<span>', '</span>' ], $title );
}

require_once('inc/walker.php');

// INTEGRATIONS
function create_integration_post_type() {
    register_post_type('integration',
        array(
            'labels' => array(
                'name' => __('Integrations'),
                'singular_name' => __('Integration')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'integrations', 'with_front' => false),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        )
    );
}
add_action('init', 'create_integration_post_type');

function create_integration_taxonomy() {
    register_taxonomy(
        'integration_category',
        'integration',
        array(
            'label' => __('Integration Categories'),
            'rewrite' => array('slug' => 'integration-category'),
            'hierarchical' => true,
        )
    );
}
add_action('init', 'create_integration_taxonomy');

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Integrations Archive Settings',
        'menu_title'    => 'Integrations Archive',
        'menu_slug'     => 'integrations-archive-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

// CTA
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'CTA',
        'menu_title'    => 'CTA',
        'menu_slug'     => 'cta',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

/**
 * Header Mega Menu — ACF Options page + field group + render helper.
 *
 * Drives the contents of the two header mega-menu dropdowns (Platform / Solutions).
 * Top-level labels and order still come from the `menu-1` WP Nav Menu; this only
 * controls the panel contents (title, subtitle, left image, item list).
 */
if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page( array(
        'page_title' => 'Header Menu',
        'menu_title' => 'Header Menu',
        'menu_slug'  => 'header-menu',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ) );
}

if ( function_exists( 'acf_add_local_field_group' ) ) {
    $groupapp_mega_menu_panels = array(
        'platform'  => 'Platform',
        'solutions' => 'Solutions',
    );

    $groupapp_mega_menu_fields = array();

    foreach ( $groupapp_mega_menu_panels as $panel_key => $panel_label ) {
        $groupapp_mega_menu_fields[] = array(
            'key'   => 'field_mega_' . $panel_key . '_tab',
            'label' => $panel_label,
            'type'  => 'tab',
        );
        $groupapp_mega_menu_fields[] = array(
            'key'           => 'field_mega_' . $panel_key . '_title',
            'label'         => 'Title',
            'name'          => $panel_key . '_title',
            'type'          => 'text',
            'instructions'  => 'Heading shown at the top of the ' . $panel_label . ' dropdown.',
            'default_value' => '',
        );
        $groupapp_mega_menu_fields[] = array(
            'key'           => 'field_mega_' . $panel_key . '_subtitle',
            'label'         => 'Subtitle',
            'name'          => $panel_key . '_subtitle',
            'type'          => 'text',
            'instructions'  => 'Sub-heading shown under the title.',
            'default_value' => '',
        );
        $groupapp_mega_menu_fields[] = array(
            'key'           => 'field_mega_' . $panel_key . '_image',
            'label'         => 'Left image',
            'name'          => $panel_key . '_image',
            'type'          => 'image',
            'return_format' => 'array',
            'preview_size'  => 'medium',
            'instructions'  => 'Visual displayed on the left side of the dropdown.',
        );
        $groupapp_mega_menu_fields[] = array(
            'key'          => 'field_mega_' . $panel_key . '_items',
            'label'        => 'Items',
            'name'         => $panel_key . '_items',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => 'Add item',
            'sub_fields'   => array(
                array(
                    'key'           => 'field_mega_' . $panel_key . '_item_icon',
                    'label'         => 'Icon',
                    'name'          => 'icon',
                    'type'          => 'image',
                    'return_format' => 'array',
                    'preview_size'  => 'thumbnail',
                    'mime_types'    => 'svg,png',
                    'wrapper'       => array( 'width' => '20' ),
                ),
                array(
                    'key'     => 'field_mega_' . $panel_key . '_item_label',
                    'label'   => 'Label',
                    'name'    => 'label',
                    'type'    => 'text',
                    'wrapper' => array( 'width' => '30' ),
                ),
                array(
                    'key'     => 'field_mega_' . $panel_key . '_item_desc',
                    'label'   => 'Description',
                    'name'    => 'description',
                    'type'    => 'textarea',
                    'rows'    => 2,
                    'wrapper' => array( 'width' => '30' ),
                ),
                array(
                    'key'          => 'field_mega_' . $panel_key . '_item_link',
                    'label'        => 'Link',
                    'name'         => 'link',
                    'type'         => 'link',
                    'return_format' => 'array',
                    'wrapper'      => array( 'width' => '20' ),
                ),
            ),
        );
    }

    acf_add_local_field_group( array(
        'key'      => 'group_header_mega_menu',
        'title'    => 'Header Menu',
        'fields'   => $groupapp_mega_menu_fields,
        'location' => array(
            array(
                array(
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'header-menu',
                ),
            ),
        ),
    ) );
}

/**
 * Render a mega-menu panel from ACF Options.
 *
 * @param string $panel 'platform' or 'solutions'
 * @param string $id    DOM id for the panel (matches aria-controls on the trigger)
 */
function groupapp_render_mega_menu( $panel, $id ) {
    if ( ! function_exists( 'get_field' ) ) {
        return;
    }

    $title    = get_field( $panel . '_title',    'option' );
    $subtitle = get_field( $panel . '_subtitle', 'option' );
    $image    = get_field( $panel . '_image',    'option' );
    $items    = get_field( $panel . '_items',    'option' );

    if ( empty( $items ) && empty( $title ) ) {
        return;
    }
    ?>
    <div id="<?php echo esc_attr( $id ); ?>" class="mega-menu" data-panel="<?php echo esc_attr( $panel ); ?>" hidden>
        <div class="mega-menu__card">
            <?php if ( $title || $subtitle ) : ?>
                <div class="mega-menu__head">
                    <?php if ( $title ) : ?>
                        <h3 class="mega-menu__title"><?php echo esc_html( $title ); ?></h3>
                    <?php endif; ?>
                    <?php if ( $subtitle ) : ?>
                        <p class="mega-menu__subtitle"><?php echo esc_html( $subtitle ); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="mega-menu__body">
                <figure class="mega-menu__visual">
                    <?php if ( $image && ! empty( $image['url'] ) ) : ?>
                        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>">
                    <?php endif; ?>
                </figure>

                <?php if ( ! empty( $items ) ) :
                    $items_class = 'mega-menu__items';
                    if ( count( $items ) === 3 ) {
                        $items_class .= ' mega-menu__items--single-col';
                    }
                ?>
                    <ul class="<?php echo esc_attr( $items_class ); ?>">
                        <?php foreach ( $items as $item ) :
                            $link = $item['link'] ?? array();
                            $url    = $link['url']    ?? '#';
                            $target = $link['target'] ?? '';
                            $icon   = $item['icon']   ?? array();
                        ?>
                            <li class="mega-menu__item">
                                <a class="mega-menu__link" href="<?php echo esc_url( $url ); ?>"<?php echo $target ? ' target="' . esc_attr( $target ) . '"' : ''; ?>>
                                    <?php if ( ! empty( $icon['url'] ) ) : ?>
                                        <span class="mega-menu__icon" aria-hidden="true">
                                            <img src="<?php echo esc_url( $icon['url'] ); ?>" alt="">
                                        </span>
                                    <?php endif; ?>
                                    <span class="mega-menu__text">
                                        <span class="mega-menu__label"><?php echo esc_html( $item['label'] ?? '' ); ?></span>
                                        <?php if ( ! empty( $item['description'] ) ) : ?>
                                            <span class="mega-menu__desc"><?php echo esc_html( $item['description'] ); ?></span>
                                        <?php endif; ?>
                                    </span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Get the top-level nav label for a mega-menu panel (Platform / Solutions).
 *
 * @param string $panel 'platform' or 'solutions'
 */
function groupapp_get_mega_menu_panel_title( $panel ) {
    $class_map = array(
        'platform'  => 'mega-platform',
        'solutions' => 'mega-solutions',
    );

    if ( ! isset( $class_map[ $panel ] ) ) {
        return ucfirst( $panel );
    }

    $locations = get_nav_menu_locations();
    if ( isset( $locations['menu-1'] ) ) {
        $items = wp_get_nav_menu_items( $locations['menu-1'] );
        if ( $items ) {
            foreach ( $items as $item ) {
                if ( in_array( $class_map[ $panel ], (array) $item->classes, true ) ) {
                    return $item->title;
                }
            }
        }
    }

    return ucfirst( $panel );
}

/**
 * Chevron icon for footer mobile accordion triggers.
 */
function groupapp_footer_accordion_chevron() {
    return '<svg class="footer--top__chev" width="12" height="12" viewBox="0 0 12 12" aria-hidden="true" focusable="false"><path d="M2 4l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
}

/**
 * Render a widget sidebar column as a mobile accordion item.
 *
 * @param string $sidebar      Registered sidebar name or id.
 * @param string $panel_id     Unique panel id slug.
 * @param string $default_title Fallback title if the widget title is missing.
 */
function groupapp_render_footer_sidebar_accordion( $sidebar, $panel_id, $default_title = 'Quick Links' ) {
    if ( ! is_active_sidebar( $sidebar ) ) {
        return;
    }

    ob_start();
    dynamic_sidebar( $sidebar );
    $content = trim( ob_get_clean() );

    if ( '' === $content ) {
        return;
    }

    $title = $default_title;
    if ( preg_match( '/<h4[^>]*\bfooter-title\b[^>]*>(.*?)<\/h4>/is', $content, $matches ) ) {
        $title   = wp_strip_all_tags( $matches[1] );
        $content = preg_replace( '/<h4[^>]*\bfooter-title\b[^>]*>.*?<\/h4>\s*/is', '', $content, 1 );
    }

    $panel_dom_id = 'footer-panel-' . sanitize_title( $panel_id );
    ?>
    <div class="footer--top__menu footer--top__accordion-item">
        <button type="button"
            class="footer--top__accordion-trigger"
            aria-expanded="false"
            aria-controls="<?php echo esc_attr( $panel_dom_id ); ?>">
            <span class="footer-title"><?php echo esc_html( $title ); ?></span>
            <?php echo groupapp_footer_accordion_chevron(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </button>
        <div id="<?php echo esc_attr( $panel_dom_id ); ?>" class="footer--top__accordion-panel" hidden>
            <?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </div>
    </div>
    <?php
}

/**
 * Render a footer column of links sourced from the header mega-menu ACF items.
 *
 * @param string $panel 'platform' or 'solutions'
 */
function groupapp_render_footer_menu_links( $panel ) {
    if ( ! function_exists( 'get_field' ) ) {
        return;
    }

    $items = get_field( $panel . '_items', 'option' );
    if ( empty( $items ) ) {
        return;
    }

    $title        = groupapp_get_mega_menu_panel_title( $panel );
    $menu_class   = 'footer--top__menu footer--top__accordion-item';
    $panel_dom_id = 'footer-panel-' . sanitize_title( $panel );
    ?>
    <div class="<?php echo esc_attr( $menu_class ); ?>">
        <button type="button"
            class="footer--top__accordion-trigger"
            aria-expanded="false"
            aria-controls="<?php echo esc_attr( $panel_dom_id ); ?>">
            <span class="footer-title"><?php echo esc_html( $title ); ?></span>
            <?php echo groupapp_footer_accordion_chevron(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </button>
        <div id="<?php echo esc_attr( $panel_dom_id ); ?>" class="footer--top__accordion-panel" hidden>
            <ul class="footer--top__menu-list">
                <?php foreach ( $items as $item ) :
                    $link   = $item['link'] ?? array();
                    $url    = $link['url']    ?? '#';
                    $target = $link['target'] ?? '';
                    $label  = $item['label']  ?? ( $link['title'] ?? '' );
                    if ( ! $label ) {
                        continue;
                    }
                ?>
                    <li>
                        <a href="<?php echo esc_url( $url ); ?>"<?php echo $target ? ' target="' . esc_attr( $target ) . '"' : ''; ?>>
                            <?php echo esc_html( $label ); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php
}

/**
 * Resolve a WordPress attachment ID from an ACF image field value.
 *
 * @param array|int|string|false $image ACF image array, attachment ID, or URL.
 * @return int Attachment ID, or 0 when not resolvable.
 */
function groupapp_acf_get_attachment_id( $image ) {
	if ( empty( $image ) ) {
		return 0;
	}

	if ( is_numeric( $image ) ) {
		return (int) $image;
	}

	if ( is_string( $image ) ) {
		return (int) attachment_url_to_postid( $image );
	}

	if ( is_array( $image ) ) {
		$attachment_id = (int) ( $image['ID'] ?? $image['id'] ?? 0 );
		if ( $attachment_id ) {
			return $attachment_id;
		}

		if ( ! empty( $image['url'] ) ) {
			return (int) attachment_url_to_postid( $image['url'] );
		}
	}

	return 0;
}

/**
 * Whether an ACF image field has a resolvable attachment or fallback URL.
 *
 * @param array|int|string|false $image ACF image field value.
 * @return bool
 */
function groupapp_acf_has_image( $image ) {
	if ( groupapp_acf_get_attachment_id( $image ) ) {
		return true;
	}

	return is_array( $image ) && ! empty( $image['url'] );
}

/**
 * Output a responsive image from an ACF image field via wp_get_attachment_image().
 *
 * @param array|int|string $image ACF image array, attachment ID, or URL.
 * @param string           $size  Registered image size.
 * @param array            $args  Optional. class, alt, sizes, loading, fetchpriority, echo.
 * @return string HTML when echo is false, otherwise empty string.
 */
function groupapp_acf_image( $image, $size = 'full', $args = array() ) {
	$defaults = array(
		'class'          => '',
		'alt'            => '',
		'sizes'          => '',
		'loading'        => 'lazy',
		'fetchpriority'  => '',
		'echo'           => true,
	);
	$args = wp_parse_args( $args, $defaults );

	$attachment_id = groupapp_acf_get_attachment_id( $image );

	if ( is_array( $image ) && empty( $args['alt'] ) && ! empty( $image['alt'] ) ) {
		$args['alt'] = $image['alt'];
	}

	$attr = array(
		'class'   => $args['class'],
		'alt'     => $args['alt'],
		'loading' => $args['loading'],
	);

	if ( $args['sizes'] ) {
		$attr['sizes'] = $args['sizes'];
	}

	if ( $args['fetchpriority'] ) {
		$attr['fetchpriority'] = $args['fetchpriority'];
	}

	if ( $attachment_id ) {
		$html = wp_get_attachment_image( $attachment_id, $size, false, $attr );
	} elseif ( is_array( $image ) && ! empty( $image['url'] ) ) {
		$html = sprintf(
			'<img class="%1$s" src="%2$s" alt="%3$s" loading="%4$s"%5$s>',
			esc_attr( $args['class'] ),
			esc_url( $image['url'] ),
			esc_attr( $args['alt'] ),
			esc_attr( $args['loading'] ),
			$args['fetchpriority'] ? ' fetchpriority="' . esc_attr( $args['fetchpriority'] ) . '"' : ''
		);
	} else {
		return '';
	}

	if ( $args['echo'] ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		return '';
	}

	return $html;
}

/**
 * Output a responsive image preload link.
 *
 * @param array|int|string $image ACF image array, attachment ID, or URL.
 * @param string           $size  Registered image size.
 * @param string           $sizes sizes attribute for imagesizes.
 * @param string           $media Optional media query attribute.
 */
function groupapp_render_image_preload_link( $image, $size, $sizes, $media = '' ) {
	$attachment_id = groupapp_acf_get_attachment_id( $image );

	if ( $attachment_id ) {
		$src    = wp_get_attachment_image_url( $attachment_id, $size );
		$srcset = wp_get_attachment_image_srcset( $attachment_id, $size );
	} elseif ( is_array( $image ) && ! empty( $image['url'] ) ) {
		$src    = $image['url'];
		$srcset = '';
	} else {
		return;
	}

	if ( ! $src ) {
		return;
	}

	$attrs = sprintf(
		'rel="preload" as="image" href="%s" fetchpriority="high"',
		esc_url( $src )
	);

	if ( $srcset ) {
		$attrs .= sprintf( ' imagesrcset="%s"', esc_attr( $srcset ) );
	}

	if ( $sizes ) {
		$attrs .= sprintf( ' imagesizes="%s"', esc_attr( $sizes ) );
	}

	if ( $media ) {
		$attrs .= sprintf( ' media="%s"', esc_attr( $media ) );
	}

	echo '<link ' . $attrs . ">\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Preload home page hero images for faster LCP.
 */
function groupapp_home_hero_preload_links() {
	if ( ! is_page_template( 'home-page.php' ) && ! is_front_page() ) {
		return;
	}

	$page_id = get_queried_object_id();
	$blocks  = $page_id ? get_field( 'content_block_home', $page_id ) : null;

	if ( ! is_array( $blocks ) ) {
		return;
	}

	foreach ( $blocks as $block ) {
		if ( ( $block['acf_fc_layout'] ?? '' ) !== 'hero_section' ) {
			continue;
		}

		$hero_image        = $block['image'] ?? null;
		$hero_image_mobile = $block['image_mobile'] ?? null;
		$hero_has_desktop  = groupapp_acf_has_image( $hero_image );
		$hero_has_mobile   = groupapp_acf_has_image( $hero_image_mobile );

		if ( $hero_has_desktop ) {
			$hero_desktop_sizes = $hero_has_mobile
				? '(max-width: 767px) 0px, (max-width: 992px) 100vw, 1200px'
				: '(max-width: 992px) 100vw, 1200px';
			$hero_desktop_media = $hero_has_mobile ? '(min-width: 768px)' : '';

			groupapp_render_image_preload_link( $hero_image, 'full', $hero_desktop_sizes, $hero_desktop_media );
		}

		if ( $hero_has_mobile && $hero_has_desktop ) {
			groupapp_render_image_preload_link(
				$hero_image_mobile,
				'full',
				'(max-width: 767px) min(370px, 100vw), 0px',
				'(max-width: 767px)'
			);
		} elseif ( $hero_has_mobile ) {
			groupapp_render_image_preload_link(
				$hero_image_mobile,
				'full',
				'(max-width: 992px) 100vw, 1200px'
			);
		}

		break;
	}
}
