<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package GroupApp
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function groupapp_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'groupapp_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function groupapp_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'groupapp_pingback_header' );

/**
 * Returns the page ID that uses the main blog template (blogs.php).
 *
 * @return int
 */
function groupapp_get_blogs_page_id() {
	static $blogs_page_id = null;

	if ( null !== $blogs_page_id ) {
		return $blogs_page_id;
	}

	$pages = get_pages(
		array(
			'meta_key'   => '_wp_page_template',
			'meta_value' => 'blogs.php',
			'number'     => 1,
		)
	);

	$blogs_page_id = $pages ? (int) $pages[0]->ID : 0;

	return $blogs_page_id;
}

/**
 * Normalizes an ACF link field value to a URL string.
 *
 * @param mixed $link ACF link field (array|string|int).
 * @return string
 */
function groupapp_normalize_blog_category_filter_link( $link ) {
	if ( is_array( $link ) ) {
		return isset( $link['url'] ) ? (string) $link['url'] : '';
	}

	if ( is_numeric( $link ) ) {
		return get_permalink( (int) $link ) ?: '';
	}

	return is_string( $link ) ? $link : '';
}

/**
 * Resolves a category filter link to the local page permalink when possible.
 *
 * @param mixed $link ACF link field value.
 * @return string
 */
function groupapp_get_blog_category_filter_url( $link ) {
	$url = groupapp_normalize_blog_category_filter_link( $link );

	if ( empty( $url ) ) {
		return '';
	}

	$page_id = (int) url_to_postid( $url );

	if ( $page_id ) {
		return get_permalink( $page_id ) ?: $url;
	}

	$path = wp_parse_url( $url, PHP_URL_PATH );
	$slug = $path ? basename( untrailingslashit( (string) $path ) ) : '';

	if ( ! $slug ) {
		return $url;
	}

	$pages = get_posts(
		array(
			'name'             => $slug,
			'post_type'        => 'page',
			'post_status'      => 'publish',
			'posts_per_page'   => 1,
			'meta_key'         => '_wp_page_template',
			'meta_value'       => 'category-blog.php',
			'suppress_filters' => true,
		)
	);

	if ( $pages ) {
		return get_permalink( $pages[0]->ID ) ?: $url;
	}

	return $url;
}

/**
 * Whether a category filter link points at the current page.
 *
 * @param mixed $link Category filter value from ACF.
 * @return bool
 */
function groupapp_is_blog_category_filter_active( $link ) {
	$url = groupapp_normalize_blog_category_filter_link( $link );

	if ( empty( $url ) ) {
		return false;
	}

	$current_page_id = (int) get_queried_object_id();

	if ( ! $current_page_id ) {
		return false;
	}

	$resolved_url  = groupapp_get_blog_category_filter_url( $link );
	$link_page_id  = (int) url_to_postid( $resolved_url ?: $url );

	if ( $link_page_id && $link_page_id === $current_page_id ) {
		return true;
	}

	$current_permalink = trailingslashit( get_permalink( $current_page_id ) );

	if ( trailingslashit( $url ) === $current_permalink || trailingslashit( $resolved_url ) === $current_permalink ) {
		return true;
	}

	$current_path = wp_parse_url( $current_permalink, PHP_URL_PATH );
	$link_path    = wp_parse_url( $resolved_url ?: $url, PHP_URL_PATH );

	if ( $current_path && $link_path && trailingslashit( (string) $current_path ) === trailingslashit( (string) $link_path ) ) {
		return true;
	}

	$current_post = get_post( $current_page_id );

	if ( ! $current_post ) {
		return false;
	}

	$acf_path = wp_parse_url( $url, PHP_URL_PATH );
	$acf_slug = $acf_path ? basename( untrailingslashit( (string) $acf_path ) ) : '';

	return $acf_slug && $acf_slug === $current_post->post_name;
}

/**
 * Normalizes ACF repeater rows into FAQ items with consistent keys.
 *
 * @param mixed  $rows          ACF repeater rows.
 * @param string $question_key  Field key for the question text.
 * @param string $answer_key    Field key for the answer text.
 * @return array<int, array{question: string, answer: string}>
 */
function groupapp_normalize_faq_items( $rows, $question_key = 'question', $answer_key = 'answer' ) {
	if ( ! is_array( $rows ) ) {
		return array();
	}

	$items = array();

	foreach ( $rows as $row ) {
		if ( ! is_array( $row ) ) {
			continue;
		}

		$question = isset( $row[ $question_key ] ) ? (string) $row[ $question_key ] : '';
		$answer   = isset( $row[ $answer_key ] ) ? (string) $row[ $answer_key ] : '';

		if ( '' === $question && '' === $answer ) {
			continue;
		}

		$items[] = array(
			'question' => $question,
			'answer'   => $answer,
		);
	}

	return $items;
}

/**
 * Builds template args for template-parts/faq-section.php.
 *
 * @param mixed  $rows          ACF repeater rows.
 * @param string $title         Section heading.
 * @param string $question_key  Field key for the question text.
 * @param string $answer_key    Field key for the answer text.
 * @return array{title: string, items: array<int, array{question: string, answer: string}>}
 */
function groupapp_get_faq_section_args( $rows, $title = '', $question_key = 'question', $answer_key = 'answer' ) {
	return array(
		'title' => (string) $title,
		'items' => groupapp_normalize_faq_items( $rows, $question_key, $answer_key ),
	);
}
