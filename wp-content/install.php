<?php
function wp_install_defaults($user_id) {
	global $wpdb, $wp_rewrite, $current_site, $table_prefix;

	// Default category
	$cat_name = __('Uncategorized');
	/* translators: Default category slug */
	$cat_slug = sanitize_title(_x('Uncategorized', 'Default category slug'));

	if ( global_terms_enabled() ) {
		$cat_id = $wpdb->get_var( $wpdb->prepare( "SELECT cat_ID FROM {$wpdb->sitecategories} WHERE category_nicename = %s", $cat_slug ) );
		if ( $cat_id == null ) {
			$wpdb->insert( $wpdb->sitecategories, array('cat_ID' => 0, 'cat_name' => $cat_name, 'category_nicename' => $cat_slug, 'last_updated' => current_time('mysql', true)) );
			$cat_id = $wpdb->insert_id;
		}
		update_option('default_category', $cat_id);
	} else {
		$cat_id = 1;
	}

	update_option('permalink_structure', '/%postname%/');
	update_option('rewrite_rules', 'a:127:{s:18:"micki_right_box/?$";s:35:"index.php?post_type=micki_right_box";s:48:"micki_right_box/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?post_type=micki_right_box&feed=$matches[1]";s:43:"micki_right_box/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?post_type=micki_right_box&feed=$matches[1]";s:35:"micki_right_box/page/([0-9]{1,})/?$";s:53:"index.php?post_type=micki_right_box&paged=$matches[1]";s:19:"micki_bottom_box/?$";s:36:"index.php?post_type=micki_bottom_box";s:49:"micki_bottom_box/feed/(feed|rdf|rss|rss2|atom)/?$";s:53:"index.php?post_type=micki_bottom_box&feed=$matches[1]";s:44:"micki_bottom_box/(feed|rdf|rss|rss2|atom)/?$";s:53:"index.php?post_type=micki_bottom_box&feed=$matches[1]";s:36:"micki_bottom_box/page/([0-9]{1,})/?$";s:54:"index.php?post_type=micki_bottom_box&paged=$matches[1]";s:14:"micki_quote/?$";s:31:"index.php?post_type=micki_quote";s:44:"micki_quote/feed/(feed|rdf|rss|rss2|atom)/?$";s:48:"index.php?post_type=micki_quote&feed=$matches[1]";s:39:"micki_quote/(feed|rdf|rss|rss2|atom)/?$";s:48:"index.php?post_type=micki_quote&feed=$matches[1]";s:31:"micki_quote/page/([0-9]{1,})/?$";s:49:"index.php?post_type=micki_quote&paged=$matches[1]";s:47:"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:42:"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:35:"category/(.+?)/page/?([0-9]{1,})/?$";s:53:"index.php?category_name=$matches[1]&paged=$matches[2]";s:17:"category/(.+?)/?$";s:35:"index.php?category_name=$matches[1]";s:44:"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:39:"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:32:"tag/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?tag=$matches[1]&paged=$matches[2]";s:14:"tag/([^/]+)/?$";s:25:"index.php?tag=$matches[1]";s:45:"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:40:"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:33:"type/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?post_format=$matches[1]&paged=$matches[2]";s:15:"type/([^/]+)/?$";s:33:"index.php?post_format=$matches[1]";s:43:"micki_right_box/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:53:"micki_right_box/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:73:"micki_right_box/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:68:"micki_right_box/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:68:"micki_right_box/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:36:"micki_right_box/([^/]+)/trackback/?$";s:42:"index.php?micki_right_box=$matches[1]&tb=1";s:56:"micki_right_box/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:54:"index.php?micki_right_box=$matches[1]&feed=$matches[2]";s:51:"micki_right_box/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:54:"index.php?micki_right_box=$matches[1]&feed=$matches[2]";s:44:"micki_right_box/([^/]+)/page/?([0-9]{1,})/?$";s:55:"index.php?micki_right_box=$matches[1]&paged=$matches[2]";s:51:"micki_right_box/([^/]+)/comment-page-([0-9]{1,})/?$";s:55:"index.php?micki_right_box=$matches[1]&cpage=$matches[2]";s:36:"micki_right_box/([^/]+)(/[0-9]+)?/?$";s:54:"index.php?micki_right_box=$matches[1]&page=$matches[2]";s:32:"micki_right_box/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:42:"micki_right_box/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:62:"micki_right_box/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:57:"micki_right_box/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:57:"micki_right_box/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:44:"micki_bottom_box/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:54:"micki_bottom_box/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:74:"micki_bottom_box/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:69:"micki_bottom_box/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:69:"micki_bottom_box/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:37:"micki_bottom_box/([^/]+)/trackback/?$";s:43:"index.php?micki_bottom_box=$matches[1]&tb=1";s:57:"micki_bottom_box/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:55:"index.php?micki_bottom_box=$matches[1]&feed=$matches[2]";s:52:"micki_bottom_box/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:55:"index.php?micki_bottom_box=$matches[1]&feed=$matches[2]";s:45:"micki_bottom_box/([^/]+)/page/?([0-9]{1,})/?$";s:56:"index.php?micki_bottom_box=$matches[1]&paged=$matches[2]";s:52:"micki_bottom_box/([^/]+)/comment-page-([0-9]{1,})/?$";s:56:"index.php?micki_bottom_box=$matches[1]&cpage=$matches[2]";s:37:"micki_bottom_box/([^/]+)(/[0-9]+)?/?$";s:55:"index.php?micki_bottom_box=$matches[1]&page=$matches[2]";s:33:"micki_bottom_box/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:43:"micki_bottom_box/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:63:"micki_bottom_box/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:58:"micki_bottom_box/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:58:"micki_bottom_box/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:39:"micki_quote/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:49:"micki_quote/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:69:"micki_quote/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:64:"micki_quote/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:64:"micki_quote/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:32:"micki_quote/([^/]+)/trackback/?$";s:38:"index.php?micki_quote=$matches[1]&tb=1";s:52:"micki_quote/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?micki_quote=$matches[1]&feed=$matches[2]";s:47:"micki_quote/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?micki_quote=$matches[1]&feed=$matches[2]";s:40:"micki_quote/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?micki_quote=$matches[1]&paged=$matches[2]";s:47:"micki_quote/([^/]+)/comment-page-([0-9]{1,})/?$";s:51:"index.php?micki_quote=$matches[1]&cpage=$matches[2]";s:32:"micki_quote/([^/]+)(/[0-9]+)?/?$";s:50:"index.php?micki_quote=$matches[1]&page=$matches[2]";s:28:"micki_quote/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:38:"micki_quote/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:58:"micki_quote/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:53:"micki_quote/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:53:"micki_quote/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:48:".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$";s:18:"index.php?feed=old";s:18:".*wp-register.php$";s:23:"index.php?register=true";s:32:"feed/(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:27:"(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:20:"page/?([0-9]{1,})/?$";s:28:"index.php?&paged=$matches[1]";s:27:"comment-page-([0-9]{1,})/?$";s:38:"index.php?&page_id=1&cpage=$matches[1]";s:41:"comments/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:36:"comments/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:29:"comments/page/?([0-9]{1,})/?$";s:28:"index.php?&paged=$matches[1]";s:44:"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:39:"search/(.+)/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:32:"search/(.+)/page/?([0-9]{1,})/?$";s:41:"index.php?s=$matches[1]&paged=$matches[2]";s:14:"search/(.+)/?$";s:23:"index.php?s=$matches[1]";s:47:"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:42:"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:35:"author/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?author_name=$matches[1]&paged=$matches[2]";s:17:"author/([^/]+)/?$";s:33:"index.php?author_name=$matches[1]";s:69:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]";s:39:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$";s:63:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]";s:56:"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:51:"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:44:"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]";s:26:"([0-9]{4})/([0-9]{1,2})/?$";s:47:"index.php?year=$matches[1]&monthnum=$matches[2]";s:43:"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:38:"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:31:"([0-9]{4})/page/?([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&paged=$matches[2]";s:13:"([0-9]{4})/?$";s:26:"index.php?year=$matches[1]";s:27:".?.+?/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:".?.+?/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:20:"(.?.+?)/trackback/?$";s:35:"index.php?pagename=$matches[1]&tb=1";s:40:"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:35:"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:28:"(.?.+?)/page/?([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&paged=$matches[2]";s:35:"(.?.+?)/comment-page-([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&cpage=$matches[2]";s:20:"(.?.+?)(/[0-9]+)?/?$";s:47:"index.php?pagename=$matches[1]&page=$matches[2]";s:27:"[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:"[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:20:"([^/]+)/trackback/?$";s:31:"index.php?name=$matches[1]&tb=1";s:40:"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?name=$matches[1]&feed=$matches[2]";s:35:"([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?name=$matches[1]&feed=$matches[2]";s:35:"([^/]+)/comment-page-([0-9]{1,})/?$";s:44:"index.php?name=$matches[1]&cpage=$matches[2]";s:20:"([^/]+)(/[0-9]+)?/?$";s:43:"index.php?name=$matches[1]&page=$matches[2]";s:16:"[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:26:"[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:46:"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:41:"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:41:"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";}');

	$wpdb->insert( $wpdb->terms, array('term_id' => $cat_id, 'name' => $cat_name, 'slug' => $cat_slug, 'term_group' => 0) );
	$wpdb->insert( $wpdb->term_taxonomy, array('term_id' => $cat_id, 'taxonomy' => 'category', 'description' => '', 'parent' => 0, 'count' => 1));
	$cat_tt_id = $wpdb->insert_id;

	// Default link category
	$cat_name = __('Blogroll');
	/* translators: Default link category slug */
	$cat_slug = sanitize_title(_x('Blogroll', 'Default link category slug'));

	if ( global_terms_enabled() ) {
		$blogroll_id = $wpdb->get_var( $wpdb->prepare( "SELECT cat_ID FROM {$wpdb->sitecategories} WHERE category_nicename = %s", $cat_slug ) );
		if ( $blogroll_id == null ) {
			$wpdb->insert( $wpdb->sitecategories, array('cat_ID' => 0, 'cat_name' => $cat_name, 'category_nicename' => $cat_slug, 'last_updated' => current_time('mysql', true)) );
			$blogroll_id = $wpdb->insert_id;
		}
		update_option('default_link_category', $blogroll_id);
	} else {
		$blogroll_id = 2;
	}

	$wpdb->insert( $wpdb->terms, array('term_id' => $blogroll_id, 'name' => $cat_name, 'slug' => $cat_slug, 'term_group' => 0) );
	$wpdb->insert( $wpdb->term_taxonomy, array('term_id' => $blogroll_id, 'taxonomy' => 'link_category', 'description' => '', 'parent' => 0, 'count' => 7));
	$blogroll_tt_id = $wpdb->insert_id;

	$now = date('Y-m-d H:i:s');
	$now_gmt = gmdate('Y-m-d H:i:s');

	$page_num = 1;

	//home page
	$home_page = __( "We are part of Circle K International, the premier collegiate community service, leadership development, and friendship organization in the world. With more than 12,600 members in 17 nations, CKI is making a positive impact on the world every day." );

	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => $home_page,
								'post_title' => __( 'Home' ),
								'post_name' => __( 'home' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'page',
								));
	$home_id = $wpdb->insert_id;
	$wpdb->insert( $wpdb->postmeta, array( 'post_id' => $home_id, 'meta_key' => '_wp_page_template', 'meta_value' => 'full-page.php' ) );

	//About Page
	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_title' => __( 'About' ),
								'post_name' => __( 'about' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'page',
								'menu_order' => 1,
								));
	$about_id = $wpdb->insert_id;
	$wpdb->insert( $wpdb->postmeta, array( 'post_id' => $about_id, 'meta_key' => '_wp_page_template', 'meta_value' => 'redirect.php' ) );

	$general_info_content = 'Circle K is an amazing community service group on campus.  Although we focus on service, there are plenty of social and leadership opportunities as well.  Whether you are a new student or upperclassman, education major or engineer, Circle K is the perfect place to find your circle.

Supported by Kiwanis International, our club is also affiliated with a global network of do-gooders.  Worldwide, over 13,000 Circle K members from 17 nations benefit their communities in the name of Circle K.  Several other organizations make up the <a href="SITE_URL/about/kiwanis-family/">Kiwanis Family</a>, such as Key Club for high schoolers and additional clubs for younger children or adults with disabilities.  Together, the Kiwanis Family also takes part in impactful global Kiwanis initiatives like the <a href="http://eliminateproject.org">Eliminate Project</a>.

For those interested, this website is the perfect place to begin your journey with Circle K.  At some point, we encourage you to <a href="SITE_URL/join/how-to-join/">become a member</a>.  You need not be a member to volunteer with us, though, so before joining, certainly check out our <a href="SITE_URL/events/">events page</a> for upcoming service projects, socials, and meetings.  We look forward to seeing you there!';

	$general_info_content = str_replace('SITE_URL', esc_url(network_home_url()), $general_info_content);

	//About subpages
	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => $general_info_content,
								'post_title' => __( 'General Info' ),
								'post_name' => __( 'general-info' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'page',
								'post_parent' => $about_id,
								'menu_order' => 0,
								));
	$post_id = $wpdb->insert_id;
	$wpdb->insert( $wpdb->postmeta, array( 'post_id' => $post_id, 'meta_key' => '_wp_page_template', 'meta_value' => 'default' ) );


	$meet_the_board_content = "<table>
<tr>
<td><img src='IMAGE_DIR/silhouette_male.png' alt='Silhouette' /></td>
<td>
<h4>Ian McDonald, President</h4>
<p>
<strong>Year:</strong> Senior
<strong>Major:</strong> Materials Science
<strong>Favorite Project:</strong> I like the Kiwanis Thrift sale.  There are so many items to look at, and I can always find something interesting.
<strong>Contact: </strong><a href='mailto:ian@micirclek.org'>ian@micirclek.org</a>
</p>
</td>
</tr>
<tr>
<td><img src='IMAGE_DIR/silhouette_male.png' alt='Silhouette' /></td>
<td>
<h4>Marc Rudolph, Vice President</h4>
<p>
<strong>Year:</strong> Senior
<strong>Major:</strong> Biomedical Engineering
<strong>Favorite Project:</strong> It's not really a project, but I like our formal every year.  I'm definitely a fan of dancing and am not afraid to get my grove on to old classics like \"Dancing Queen.\"
<strong>Contact: </strong><a href='mailto:marc@micirclek.org'>marc@micirclek.org</a>
</p>
</td>
</tr>
<tr>
<td><img src='IMAGE_DIR/silhouette_female.png' alt='Silhouette' /></td>
<td>
<h4>Amanda Klein, Secretary</h4>
<p>
<strong>Year:</strong> Senior
<strong>Major:</strong> Mechanical Engineering
<strong>Favorite Project:</strong> Playing with Preschoolers.  We get to supervise them during gym class, and they're sooooooo CUTE!
<strong>Contact: </strong><a href='mailto:amanda@micirclek.org'>amanda@micirclek.org</a>
</p>
</td>
</tr>
<tr>
<td><img src='IMAGE_DIR/silhouette_male.png' alt='Silhouette' /></td>
<td>
<h4>Joe Kurleto, Treasurer</h4>
<p>
<strong>Year:</strong> Senior
<strong>Major:</strong> Electrical Engineering
<strong>Favorite Project:</strong> Computer help at retirement homes.  They have the funniest issues!
<strong>Contact: </strong><a href='mailto:joe@micirclek.org'>joe@micirclek.org</a>
</p>
</td>
</tr>
<tr>
<td><img src='IMAGE_DIR/silhouette_female.png' alt='Silhouette' /></td>
<td>
<h4>Erica Garcia, Bulletin Editor</h4>
<p>
<strong>Year:</strong> Senior
<strong>Major:</strong> Graphic Design
<strong>Favorite Project:</strong> Charit-A-Bowl without doubt.  Last we year we won.  Yaayy team Yellow #2!
<strong>Contact: </strong><a href='mailto:erica@micirclek.org'>erica@micirclek.org</a>
</p>
</td>
</tr>
</table>";


	$meet_the_board_content = str_replace('IMAGE_DIR', esc_url(network_home_url('/wp-content/themes/micki/images')), $meet_the_board_content);

	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => $meet_the_board_content,
								'post_title' => __( 'Meet the Board' ),
								'post_name' => __( 'meet-the-board' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'page',
								'post_parent' => $about_id,
								'menu_order' => 1,
								));
	$post_id = $wpdb->insert_id;
	$wpdb->insert( $wpdb->postmeta, array( 'post_id' => $post_id, 'meta_key' => '_wp_page_template', 'meta_value' => 'default' ) );

	$kiwanis_family_content = "<table>
<tr>
<td><a href='http://sites.kiwanis.org/kiwanis/en/home.aspx'><img src='IMAGE_DIR/kiwanis.png' alt='kiwanis' /></a></td>
<td>
<h4>Kiwanis International</h4>
<p>
Established in 1915, Kiwanis International is one of the largest service organizations in the world. Kiwanis's primary focus is children. A great distinction of Kiwanis International among professional service clubs is its sponsored organizations and programs—the Kiwanis family!
</p>
</td>
</tr>
<tr>
<td><a href='http://www.aktionclub.org/Home.aspx'><img src='IMAGE_DIR/aktion-club.png' alt='aktion club' /></a></td>
<td>
<h4>Aktion Club</h4>
<p>
Aktion Club is a community-service organization for adults who live with a disability. Aktion Club members strive to return to their communities the benefits, help, and caring they have received, as well as develop important skills in the process.
</p>
</td>
</tr>
<tr>
<td><a href='http://www.keyclub.org/home.aspx'><img src='IMAGE_DIR/key-club.png' alt='key club' /></a></td>
<td>
<h4>Key Club International</h4>
<p>
Key Club International is the oldest and largest service program for high school students worldwide. This student-led organization teaches leadership through service to others. Every day, Key Club members carry out the motto 'Caring: Our Way of Life.'
</p>
</td>
</tr>
<tr>
<td><a href='http://www.buildersclub.org/Home.aspx'><img src='IMAGE_DIR/builders-club.png' alt='builders club' /></a></td>
<td>
<h4>Builders Club</h4>
<p>
Builders Club is the largest community-service program for junior and middle school students worldwide. Its goal is to develop leadership qualities in young people through experiences in volunteer service.
</p>
</td>
</tr>
<tr>
<td><a href='http://www.kiwaniskids.org/en/Kiwanis_Kids/KiwanisKidsHome.aspx'><img src='IMAGE_DIR/k-kids.png' alt='k-kids' /></a></td>
<td>
<h4>Kiwanis Kids</h4>
<p>
Kiwanis Kids is the fastest growing service club for elementary students. The program focuses on character education as well as exposure to the concepts of community service and serving learning.
</p>
</td>
</tr>
</table>";

	$kiwanis_family_content = str_replace('IMAGE_DIR', esc_url(network_home_url('/wp-content/themes/micki/images')), $kiwanis_family_content);

	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => $kiwanis_family_content,
								'post_title' => __( 'Kiwanis Family Relations' ),
								'post_name' => __( 'kiwanis-family' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'page',
								'post_parent' => $about_id,
								'menu_order' => 2,
								));
	$post_id = $wpdb->insert_id;
	$wpdb->insert( $wpdb->postmeta, array( 'post_id' => $post_id, 'meta_key' => '_wp_page_template', 'meta_value' => 'default' ) );

	//Events page
	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => 'We\'re working on an awesome calendar to put here. Come back soon!',
								'post_title' => __( 'Events' ),
								'post_name' => __( 'events' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'page',
								'menu_order' => 2,
								));
	$post_id = $wpdb->insert_id;
	$wpdb->insert( $wpdb->postmeta, array( 'post_id' => $post_id, 'meta_key' => '_wp_page_template', 'meta_value' => 'full-page.php' ) );

	//Join page
	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_title' => __( 'Join' ),
								'post_name' => __( 'join' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'page',
								'menu_order' => 3,
								));
	$join_id = $wpdb->insert_id;
	$wpdb->insert( $wpdb->postmeta, array( 'post_id' => $join_id, 'meta_key' => '_wp_page_template', 'meta_value' => 'redirect.php' ) );

	$how_to_join_content = "Joining Circle K is a two step process. First, fill out our online membership form. Afterward, bring $30 to any meeting for dues.

Before that, though, we definitely encourage you to try out service projects, socials, and meetings. Transportation is provided to all of our events, and membership is not necessarily required. It’s a great way to get to know people in our club!";

	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => $how_to_join_content,
								'post_title' => __( 'How to Join' ),
								'post_name' => __( 'how-to-join' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'page',
								'post_parent' => $join_id,
								'menu_order' => 0,
								));
	$post_id = $wpdb->insert_id;
	$wpdb->insert( $wpdb->postmeta, array( 'post_id' => $post_id, 'meta_key' => '_wp_page_template', 'meta_value' => 'default' ) );

	$membership_form_content = "The first step toward becoming a member is filling out this membership form.  Afterward, you will also have to pay $30 dues.  We look forward to seeing you at service projects!

<iframe src='https://docs.google.com/spreadsheet/embeddedform?formkey=dGdBN2Nna1llTWVBbnhZRW1sZVVaaEE6MQ' width='500' height='854' frameborder='0' marginheight='0' marginwidth='0'>Loading...</iframe>";

	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => $membership_form_content,
								'post_title' => __( 'Membership Form' ),
								'post_name' => __( 'membership-form' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'page',
								'post_parent' => $join_id,
								'menu_order' => 1,
								));
	$post_id = $wpdb->insert_id;
	$wpdb->insert( $wpdb->postmeta, array( 'post_id' => $post_id, 'meta_key' => '_wp_page_template', 'meta_value' => 'default' ) );

	$join_committee_content = '';

	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => $join_committee_content,
								'post_title' => __( 'Join a Committee' ),
								'post_name' => __( 'join-a-committee' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'page',
								'post_parent' => $join_id,
								'menu_order' => 2,
								));
	$post_id = $wpdb->insert_id;
	$wpdb->insert( $wpdb->postmeta, array( 'post_id' => $post_id, 'meta_key' => '_wp_page_template', 'meta_value' => 'default' ) );


	//Right Boxes
	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => 'Congrats to Priti Stellar, our January member of the month.',
								'post_title' => __( 'Member of the Month' ),
								'post_name' => __( 'member-of-the-month' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'micki_right_box',
								));

	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => 'Thursday at 7:00pm',
								'post_title' => __( 'Next Meeting' ),
								'post_name' => __( 'next-meeting' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'micki_right_box',
								));

	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => 'District Convention is at Northwood University March 22-24.  Visit <a href="http://micirclek.org/dcon">http://micirclek.org/dcon</a> for more info.',
								'post_title' => __( 'Promoted Project' ),
								'post_name' => __( 'promoted-project' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'micki_right_box',
								));

	//Bottom Boxes

	$bb_join_content = "Become a member

Volunteer Today";

	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => $bb_join_content,
								'post_title' => __( 'Join' ),
								'post_name' => __( 'join' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'micki_bottom_box',
								));

	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => 'circlek@micirclek.org',
								'post_title' => __( 'Contact' ),
								'post_name' => __( 'contact' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'micki_bottom_box',
								));

	//Quotes

	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => 'Oh shoot... I just accidentally deleted everything in the database...',
								'post_title' => 'Jonathan Pevarnek',
								'post_name' => 'jonathan-pevarnek',
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'micki_quote',
								));

	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => 'I joined Circle K because community service makes me happy, and being around people who love volunteering as much as I do makes me even happier!',
								'post_title' => 'Rosaline Tio',
								'post_name' => 'rosaline-tio',
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'micki_quote',
								));

	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => 'My favorite service project is K-Kids because the kids are just so crazy and fun.',
								'post_title' => 'Jen Dehart',
								'post_name' => 'jen-dehart',
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'micki_quote',
								));

	$guid = get_option('home') . '/?page_id=' . $page_num++;
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => 'My favorite service projects are nursing home events such as bingo at Gilbert.  The old people drama makes me giggle.',
								'post_title' => 'Justine Sirhan',
								'post_name' => 'justine-sirhan',
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $guid,
								'post_type' => 'micki_quote',
								));

	update_option('show_on_front', 'page');
	update_option('page_on_front', $home_id);
	update_option('template', 'micki');
	update_option('stylesheet', 'micki');
	update_option('current_theme', 'Michigan Circle K');
	update_option('blogdescription', 'Live to Serve, Love to Serve!');
}
