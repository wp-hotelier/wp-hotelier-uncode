<?php
/**
 * Visual Composer functions.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Add custom elements in post module (admin).
 */
function htl_uncode_post_type_list_options( $options ) {
	if ( isset( $options[ 'options' ] ) ) {
		// Romm price
		$options[ 'options' ][] = array(
			'room_price',
			esc_html__('Room price', 'wp-hotelier-uncode') ,
			array(
				array(
					'full',
					esc_html__('Full price', 'wp-hotelier-uncode')
				) ,
				array(
					'no_text',
					esc_html__('No text', 'wp-hotelier-uncode')
				),
			),
			array(
				array(
					'default',
					esc_html__('Default layout', 'wp-hotelier-uncode')
				) ,
				array(
					'inline',
					esc_html__('Inline price', 'wp-hotelier-uncode')
				),
			)
		);

		// Room details
		$options[ 'options' ][] = array(
			'room_details',
			esc_html__('Room details', 'wp-hotelier-uncode') ,
			array(
				array(
					'adults',
					esc_html__('Show adults', 'wp-hotelier-uncode')
				),
				array(
					'adults_with_icon',
					esc_html__('Show adults (with icon)', 'wp-hotelier-uncode')
				),
				array(
					'hide_adults',
					esc_html__('Hide adults', 'wp-hotelier-uncode')
				),
			),
			array(
				array(
					'children',
					esc_html__('Show children', 'wp-hotelier-uncode')
				),
				array(
					'children_with_icon',
					esc_html__('Show children (with icon)', 'wp-hotelier-uncode')
				),
				array(
					'hide_children',
					esc_html__('Hide children', 'wp-hotelier-uncode')
				),
			),
			array(
				array(
					'bed_size',
					esc_html__('Show bed size', 'wp-hotelier-uncode')
				),
				array(
					'bed_size_with_icon',
					esc_html__('Show bed size (with icon)', 'wp-hotelier-uncode')
				),
				array(
					'hide_bed_size',
					esc_html__('Hide bed size', 'wp-hotelier-uncode')
				),
			),
			array(
				array(
					'room_size',
					esc_html__('Show room size', 'wp-hotelier-uncode')
				),
				array(
					'room_size_with_icon',
					esc_html__('Show room size (with icon)', 'wp-hotelier-uncode')
				),
				array(
					'hide_room_size',
					esc_html__('Hide room size', 'wp-hotelier-uncode')
				),
			),
		);
	}

	return $options;
}
add_filter( 'uncode_sorted_list_generic_options', 'htl_uncode_post_type_list_options' );

/**
 * Print room details in block module.
 */
function htl_uncode_inner_entry( $key, $value, $block_data, $layout ) {
	if ( $key === 'room_price' ) {
		if ( isset( $value[1] ) && $value[1] === 'default' ) {
			$_room = htl_get_room( $block_data['id'] );
			$price = $_room->get_min_price_html();
			$price = isset( $value[0] ) && $value[0] === 'no_text' ? htl_uncode_get_price_amount_whitout_text( $price ) : $price;

			// Get title classes
			$title_classes = isset( $block_data['title_classes'] ) && $block_data['title_classes'] ? $block_data['title_classes'] : array('h3');

			echo '<span class="room__price room__price--loop ' . trim( implode( ' ', $title_classes ) ) . '">' . $price . '</span>';
		}
	} else if ( $key === 'room_details' ) {
		$_room        = htl_get_room( $block_data['id'] );
		$room_details = '';

		$text_size = '';

		if ( isset( $block_data[ 'text_lead' ] ) ) {
			if ( $block_data[ 'text_lead' ] === 'yes' ) {
				$text_size = 'text-lead';
			} else if ( $block_data[ 'text_lead' ] === 'small' ) {
				$text_size = 'text-small';
			}
		}

		if ( is_array( $value ) ) {
			foreach ( $value as $detail ) {
				switch ( $detail ) {
					case 'adults':
						$max_guests = $_room->get_max_guests();

						if ( $max_guests > 0 ) {
							$text         = sprintf( _n( '%s Adult', '%s Adults', $max_guests, 'wp-hotelier-uncode' ), $max_guests );
							$room_details .= '<span>' . esc_html( $text ) . '</span>';
						}
						break;

					case 'adults_with_icon':
						$max_guests = $_room->get_max_guests();

						if ( $max_guests > 0 ) {
							$room_details .= '<span><i class="fa fa-male"></i>' . $max_guests . '</span>';
						}
						break;

					case 'children':
						$max_children = $_room->get_max_children();

						if ( $max_children > 0 ) {
							$text         = sprintf( __( '%s Children', 'wp-hotelier-uncode' ), $max_children );
							$room_details .= '<span>' . esc_html( $text ) . '</span>';
						}
						break;

					case 'children_with_icon':
						$max_children = $_room->get_max_children();

						if ( $max_children > 0 ) {
							$room_details .= '<span><i class="fa fa-child"></i>' . $max_children . '</span>';
						}
						break;

					case 'bed_size':
						$bed_size = $_room->get_bed_size();

						if ( $bed_size ) {
							$room_details .= '<span>' . esc_html( $bed_size ) . '</span>';
						}
						break;

					case 'bed_size_with_icon':
						$bed_size = $_room->get_bed_size();

						if ( $bed_size ) {
							$room_details .= '<span><i class="fa fa-bed"></i>' . esc_html( $bed_size ) . '</span>';
						}
						break;

					case 'room_size':
						$room_size = $_room->get_formatted_room_size();

						if ( $room_size ) {
							$room_details .= '<span>' . esc_html( $room_size ) . '</span>';
						}
						break;

					case 'room_size_with_icon':
						$room_size = $_room->get_formatted_room_size();

						if ( $room_size ) {
							$room_details .= '<span><i class="fa fa-info-circle"></i>' . esc_html( $room_size ) . '</span>';
						}
						break;
				}
			}
		}

		// Set classes
		$classes   = array();
		$classes[] = $text_size;

		echo '<p class="t-entry-room-details ' . trim( implode( ' ', $classes ) ) . '">' . $room_details . '</p>';
	}
}
add_action( 'uncode_inner_entry', 'htl_uncode_inner_entry', 10, 4 );

/**
 * Print price inline after title in block module.
 */
function htl_uncode_inner_entry_after_title( $block_data, $layout ) {
	if ( isset( $layout['room_price'] ) ) {
		$value = $layout['room_price'];

		if ( isset( $value[1] ) && $value[1] === 'inline' ) {
			$_room = htl_get_room( $block_data['id'] );
			$price = $_room->get_min_price_html();

			// Get title classes
			$title_classes = isset( $block_data['title_classes'] ) && $block_data['title_classes'] ? $block_data['title_classes'] : array('h3');

			$inline_price = '<span class="room__price room__price--loop ' . trim( implode( ' ', $title_classes ) ) . '">' . htl_uncode_get_price_amount_whitout_text( $price ) . '</span>';

			echo $inline_price;
		}
	}
}
add_action( 'uncode_inner_entry_after_title', 'htl_uncode_inner_entry_after_title', 10, 2 );
