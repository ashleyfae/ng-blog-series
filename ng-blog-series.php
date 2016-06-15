<?php
/*
 * Plugin Name: NG Blog Series
 * Plugin URI: https://www.nosegraze.com/create-blog-series/
 * Description: Adds a new custom taxonomy for adding posts to a blog series
 * Version: 1.0
 * Author: Nose Graze
 * Author URI: https://www.nosegraze.com
 * License: GPL2
 * Text Domain: ng-blog-series
 *
 * @package   ng-blog-series
 * @copyright Copyright (c) 2016, Ashley Evans
 * @license   GPL2+
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Registers the custom taxonomy
 *
 * @since 1.0
 * @return void
 */
function ng_register_blog_series_taxonomy() {

	$labels  = array(
		'name'                       => _x( 'Blog Series', 'Taxonomy General Name', 'ng-blog-series' ),
		'singular_name'              => _x( 'Blog Series', 'Taxonomy Singular Name', 'ng-blog-series' ),
		'menu_name'                  => __( 'Blog Series', 'ng-blog-series' ),
		'all_items'                  => __( 'All Series', 'ng-blog-series' ),
		'parent_item'                => __( 'Parent Series', 'ng-blog-series' ),
		'parent_item_colon'          => __( 'Parent Series:', 'ng-blog-series' ),
		'new_item_name'              => __( 'New Series Name', 'ng-blog-series' ),
		'add_new_item'               => __( 'Add New Series', 'ng-blog-series' ),
		'edit_item'                  => __( 'Edit Series', 'ng-blog-series' ),
		'update_item'                => __( 'Update Series', 'ng-blog-series' ),
		'view_item'                  => __( 'View Series', 'ng-blog-series' ),
		'separate_items_with_commas' => __( 'Separate series with commas', 'ng-blog-series' ),
		'add_or_remove_items'        => __( 'Add or remove series', 'ng-blog-series' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'ng-blog-series' ),
		'popular_items'              => __( 'Popular Series', 'ng-blog-series' ),
		'search_items'               => __( 'Search Series', 'ng-blog-series' ),
		'not_found'                  => __( 'Not Found', 'ng-blog-series' ),
	);
	$rewrite = array(
		'slug'         => 'series',
		'with_front'   => true,
		'hierarchical' => true,
	);
	$args    = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'show_tagcloud'     => false,
		'rewrite'           => $rewrite,
	);
	register_taxonomy( 'blog_series', array( 'post' ), $args );

}

add_action( 'init', 'ng_register_blog_series_taxonomy', 0 );

/**
 * Changes the order that the posts get displayed in when we're querying a blog series.
 * Sets the display order to ascending.
 *
 * @param WP_Query $query
 *
 * @since 1.0
 * @return void
 */
function ng_change_blog_series_post_order( $query ) {
	if ( $query->is_main_query() && is_tax( 'blog_series' ) ) {
		// Reverse the order the posts are displayed in.
		$query->set( 'order', 'ASC' );
	}
}

add_action( 'pre_get_posts', 'ng_change_blog_series_post_order' );