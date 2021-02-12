<?php
/**
 * WP Hotelier conditional functions.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Alter default HTL conditional functions so is_listing() and is_booking()
 * will be true when using our custom modules on multiple pages
 */
function htl_uncode_conditional_functions() {
	if ( is_page() ) {
		$page_id = get_queried_object_id();

		if ( $page_id > 0 ) {
			$post            = get_post( $page_id );
			$post_content    = isset( $post->post_content ) ? $post->post_content : false;
			$shortcode_found = false;

			// Check default content
			$shortcode_found = htl_uncode_activate_htl_constants( $post_content );

			if ( $shortcode_found ) {
				return;
			}

			// Check content blocks in content
			if ( strpos( $post_content, '[uncode_block' ) !== false ) {
				$regex = '/\[uncode_block(.*?)\]/';
				$regex_attr = '/(.*?)=\"(.*?)\"/';
				preg_match_all( $regex, $post_content, $matches, PREG_SET_ORDER );

				foreach ( $matches as $key => $value ) {
					if (isset( $value[ 1 ] ) ) {
						preg_match_all( $regex_attr, trim( $value[ 1 ] ), $matches_attr, PREG_SET_ORDER );

						foreach ( $matches_attr as $key_attr => $value_attr ) {
							if ( 'id' === trim( $value_attr[ 1 ] ) ) {
								$cb_id           = $value_attr[ 2 ];
								$uncode_block    = get_post_field( 'post_content', $cb_id );
								$shortcode_found = htl_uncode_activate_htl_constants( $uncode_block );

								if ( $shortcode_found ) {
									return;
								}
							}
						}
					}
				}
			}

			// Get post meta
			$metabox_data = get_post_meta( $page_id );

			// Check content blocks in header
			if ( isset( $metabox_data[ '_uncode_header_type' ][ 0 ] ) && $metabox_data[ '_uncode_header_type' ][ 0 ] === 'header_uncodeblock' ) {
				if ( isset( $metabox_data[ '_uncode_blocks_list' ][ 0 ] ) && $metabox_data[ '_uncode_blocks_list' ][ 0 ] !== '' ) {
					$cb_id           = $metabox_data[ '_uncode_blocks_list' ][ 0 ];
					$uncode_block    = get_post_field( 'post_content', $cb_id );
					$shortcode_found = htl_uncode_activate_htl_constants( $uncode_block );

					if ( $shortcode_found ) {
						return;
					}
				}
			}

			// Check content blocks in footer
			if ( isset( $metabox_data[ '_uncode_specific_footer_block' ][ 0 ] ) && $metabox_data[ '_uncode_specific_footer_block' ][ 0 ] !== '' ) {
				$cb_id           = $metabox_data[ '_uncode_specific_footer_block' ][ 0 ];
				$uncode_block    = get_post_field( 'post_content', $cb_id );
				$shortcode_found = htl_uncode_activate_htl_constants( $uncode_block );

				if ( $shortcode_found ) {
					return;
				}
			}
		}
	}
}
add_action( 'template_redirect', 'htl_uncode_conditional_functions' );

/**
 * Check if content has a HTL shortcode and activate its constants
 */
function htl_uncode_activate_htl_constants( $content ) {
	$found = false;

	if ( strpos( $content, '[hotelier_listing' ) !== false ) {
		add_filter( 'hotelier_is_listing', '__return_true' );
		$found = true;

	} else if ( strpos( $content, '[hotelier_booking' ) !== false ) {
		add_filter( 'hotelier_is_booking', '__return_true' );
		$found = true;
	}

	return $found;
}
