<?php
/**
 * Booking output
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Run hook before the booking form
 */
function htl_uncode_before_booking_form( $booking, $atts ) {
	// Attributes
	$form_style = isset( $atts['form_style'] ) ? $atts['form_style'] : false;
	$bold_text  = isset( $atts['bold_text'] ) && $atts['bold_text'] === 'yes' ? true : false;
	$show_thumbs  = isset( $atts['booking_payment_show_thumbs'] ) && $atts['booking_payment_show_thumbs'] === 'yes' ? true : false;
	$vertical_align  = isset( $atts['booking_vertical_align'] ) && $atts['booking_vertical_align'] === 'top' ? 'top' : 'middle';
	$form_compact  = isset( $atts['booking_form_compact'] ) && $atts['booking_form_compact'] === 'yes' ? true : false;

	// Extra settings
	$el_id    = isset( $atts['el_id'] ) ? $atts['el_id'] : false;
	$el_class = isset( $atts['el_class'] ) ? $atts['el_class'] : false;

	// Custom ID
	if ( $el_id ) {
		$container_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
	} else {
		$container_id = '';
	}

	// Custom classes
	$container_classes = array( 'uncode-htl-module', 'uncode-htl-module--booking' );

	if ( $el_class ) {
		$extra_classes = explode( ' ', $el_class );

		foreach ( $extra_classes as $extra_class ) {
			$container_classes[] = $extra_class;
		}
	}

	// Form style
	if ( $form_style === 'no-labels-default' || $form_style === 'no-labels-background' || $form_style === 'no-labels-underline' ) {
		$container_classes[] = 'form-no-labels';
	}

	// Inputs style
	if ( $form_style === 'default-background' || $form_style === 'no-labels-background' ) {
		$container_classes[] = 'input-background';
	} else if ( $form_style === 'default-underline' || $form_style === 'no-labels-underline' ) {
		$container_classes[] = 'input-underline';
	}

	// Bold text
	if ( $bold_text ) {
		$container_classes[] = 'bold-text';
	}

	// Show thumbs?
	if ( $show_thumbs ) {
		$container_classes[] = 'order-table-with-thumbs';
	}

	// Vertical align
	if ( $vertical_align ) {
		$container_classes[] = 'vertical-align-' . $vertical_align;
	}

	// Compact layout
	if ( $form_compact ) {
		$container_classes[] = 'form-compact-layout';
	}

	global $booking_button_class;
	$booking_button_class = htl_uncode_get_button_classes( $atts, 'booking_buttons' );

	global $booking_section_title_class;
	$booking_section_title_class = htl_uncode_get_heading_classes( $atts );

	echo '<div ' . $container_id . ' class="' . esc_attr( trim( implode( ' ', $container_classes ) ) ) . '">';
}
add_action( 'hotelier_before_booking_form', 'htl_uncode_before_booking_form', 10, 2 );

/**
 * Run hook before the reservation received page
 */
function htl_uncode_before_reservation_received_page( $atts ) {
	// Attributes
	$bold_text  = isset( $atts['bold_text'] ) && $atts['bold_text'] === 'yes' ? true : false;
	$show_thumbs  = isset( $atts['booking_payment_show_thumbs'] ) && $atts['booking_payment_show_thumbs'] === 'yes' ? true : false;
	$vertical_align  = isset( $atts['booking_vertical_align'] ) && $atts['booking_vertical_align'] === 'top' ? 'top' : 'middle';

	// Extra settings
	$el_id    = isset( $atts['el_id'] ) ? $atts['el_id'] : false;
	$el_class = isset( $atts['el_class'] ) ? $atts['el_class'] : false;

	// Custom ID
	if ( $el_id ) {
		$container_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
	} else {
		$container_id = '';
	}

	// Custom classes
	$container_classes = array( 'uncode-htl-module', 'uncode-htl-module--booking', 'uncode-htl-module--reservation-received' );

	if ( $el_class ) {
		$extra_classes = explode( ' ', $el_class );

		foreach ( $extra_classes as $extra_class ) {
			$container_classes[] = $extra_class;
		}
	}

	// Bold text
	if ( $bold_text ) {
		$container_classes[] = 'bold-text';
	}

	// Show thumbs?
	if ( $show_thumbs ) {
		$container_classes[] = 'order-table-with-thumbs';
	}

	// Vertical align
	if ( $vertical_align ) {
		$container_classes[] = 'vertical-align-' . $vertical_align;
	}

	global $booking_button_class;
	$booking_button_class = htl_uncode_get_button_classes( $atts, 'booking_buttons' );

	global $booking_section_title_class;
	$booking_section_title_class = htl_uncode_get_heading_classes( $atts );

	echo '<div ' . $container_id . ' class="' . esc_attr( trim( implode( ' ', $container_classes ) ) ) . '">';
}
add_action( 'hotelier_before_reservation_received_page', 'htl_uncode_before_reservation_received_page' );

/**
 * Run hook before the pay page
 */
function htl_uncode_before_pay_page( $atts ) {
	// Attributes
	$form_style = isset( $atts['form_style'] ) ? $atts['form_style'] : false;
	$bold_text  = isset( $atts['bold_text'] ) && $atts['bold_text'] === 'yes' ? true : false;
	$show_thumbs  = isset( $atts['booking_payment_show_thumbs'] ) && $atts['booking_payment_show_thumbs'] === 'yes' ? true : false;
	$vertical_align  = isset( $atts['booking_vertical_align'] ) && $atts['booking_vertical_align'] === 'top' ? 'top' : 'middle';

	// Extra settings
	$el_id    = isset( $atts['el_id'] ) ? $atts['el_id'] : false;
	$el_class = isset( $atts['el_class'] ) ? $atts['el_class'] : false;

	// Custom ID
	if ( $el_id ) {
		$container_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
	} else {
		$container_id = '';
	}

	// Custom classes
	$container_classes = array( 'uncode-htl-module', 'uncode-htl-module--booking', 'uncode-htl-module--pay-page' );

	if ( $el_class ) {
		$extra_classes = explode( ' ', $el_class );

		foreach ( $extra_classes as $extra_class ) {
			$container_classes[] = $extra_class;
		}
	}

	// Form style
	if ( $form_style === 'no-labels-default' || $form_style === 'no-labels-background' || $form_style === 'no-labels-underline' ) {
		$container_classes[] = 'form-no-labels';
	}

	// Inputs style
	if ( $form_style === 'default-background' || $form_style === 'no-labels-background' ) {
		$container_classes[] = 'input-background';
	} else if ( $form_style === 'default-underline' || $form_style === 'no-labels-underline' ) {
		$container_classes[] = 'input-underline';
	}

	// Bold text
	if ( $bold_text ) {
		$container_classes[] = 'bold-text';
	}

	// Show thumbs?
	if ( $show_thumbs ) {
		$container_classes[] = 'order-table-with-thumbs';
	}

	// Vertical align
	if ( $vertical_align ) {
		$container_classes[] = 'vertical-align-' . $vertical_align;
	}

	global $booking_button_class;
	$booking_button_class = htl_uncode_get_button_classes( $atts, 'booking_buttons' );

	global $booking_section_title_class;
	$booking_section_title_class = htl_uncode_get_heading_classes( $atts );

	echo '<div ' . $container_id . ' class="' . esc_attr( trim( implode( ' ', $container_classes ) ) ) . '">';
}
add_action( 'before_hotelier_pay', 'htl_uncode_before_pay_page' );

/**
 * Run hook after the booking form
 */
function htl_uncode_after_booking_form( $atts ) {
	echo '</div>';
}
add_action( 'hotelier_after_booking_form', 'htl_uncode_after_booking_form' );
add_action( 'hotelier_after_reservation_received_page', 'htl_uncode_after_booking_form' );
add_action( 'after_hotelier_pay', 'htl_uncode_after_booking_form' );

/**
 * Add room thumbnails to reservation table
 */
function htl_uncode_reservation_table_add_thumbs( $room ) {
	if ( ! isset( $room->id ) ) {
		return;
	}

	echo '<a href="' . get_the_permalink( $room->id ) . '" class="reservation-table__room-thumbnail">';

	if ( has_post_thumbnail( $room->id ) ) {
		echo get_the_post_thumbnail( $room->id, 'room_thumbnail' );
	} else {
		echo htl_placeholder_img( 'room_thumbnail' );
	}

	echo '</a>';
}
add_action( 'hotelier_reservation_table_before_room_name', 'htl_uncode_reservation_table_add_thumbs' );
add_action( 'hotelier_reservation_received_table_before_room_name', 'htl_uncode_reservation_table_add_thumbs' );

/**
 * Add special button classes to remove room
 */
function htl_uncode_cart_item_remove_link( $html ) {
	global $booking_button_class;

	$html = str_replace( 'reservation-table__room-remove', 'reservation-table__room-remove btn-sm ' . implode( ' ', $booking_button_class ), $html );

	return $html;
}
add_filter( 'hotelier_cart_item_remove_link', 'htl_uncode_cart_item_remove_link' );

/**
 * Add special button classes to book button
 */
function htl_uncode_book_button_html( $html ) {
	global $booking_button_class;

	$html = str_replace( 'button--book-button', 'button--book-button ' . implode( ' ', $booking_button_class ), $html );

	return $html;
}
add_filter( 'hotelier_book_button_html', 'htl_uncode_book_button_html' );

/**
 * Add special button classes to cancel reservation button
 */
function htl_uncode_cancel_reservation_button_classes( $classes ) {
	global $booking_button_class;

	$classes = array_merge( $classes, $booking_button_class );

	return $classes;
}
add_filter( 'hotelier_cancel_reservation_button_classes', 'htl_uncode_cancel_reservation_button_classes' );

/**
 * Add special heading classes
 */
function htl_uncode_booking_section_title_class( $class ) {
	global $booking_section_title_class;

	if ( is_array( $booking_section_title_class ) && count( $booking_section_title_class ) > 0 ) {
		$class = str_replace( 'section-header__title', 'section-header__title ' . implode( ' ', $booking_section_title_class ), $class );
	}

	return $class;
}
add_filter( 'hotelier_booking_section_title_class', 'htl_uncode_booking_section_title_class' );

/**
 * Add title before table in pay page
 */
function htl_uncode_booking_add_title_before_pay_form() {
	global $booking_section_title_class;

	?>

	<header class="section-header">
		<h3 class="<?php echo esc_attr( apply_filters( 'hotelier_booking_section_title_class', 'section-header__title' ) ); ?>"><?php esc_html_e( 'Reservation details', 'wp-hotelier' ); ?></h3>
	</header>

	<?php
}
add_filter( 'hotelier_before_pay_form', 'htl_uncode_booking_add_title_before_pay_form' );

/**
 * Activate placeholder in Stripe input
 */
function htl_uncode_add_placeholder_to_stripe_input( $field, $key, $args, $value ) {
	if ( $key === 'stripe-card-cardholder-name' ) {
		$field = str_replace( '<input', '<input placeholder="' .esc_html__( 'Card Holder Name (required) ', 'wp-hotelier-uncode' ) . '" ', $field );
	}

	return $field;
}
add_filter( 'hotelier_form_field_text', 'htl_uncode_add_placeholder_to_stripe_input', 10, 4 );

/**
 * Open wrappers to pay page sections
 */
function htl_uncode_form_pay_before_reservation_table() {
	?>
	<div class="booking__section">
	<?php
}
add_action( 'hotelier_form_pay_before_reservation_table', 'htl_uncode_form_pay_before_reservation_table' );
add_action( 'hotelier_form_pay_before_payment_div', 'htl_uncode_form_pay_before_reservation_table' );

/**
 * Close wrappers to pay page sections
 */
function htl_uncode_form_pay_after_reservation_table() {
	?>
	</div>
	<?php
}
add_action( 'hotelier_form_pay_after_reservation_table', 'htl_uncode_form_pay_after_reservation_table' );
add_action( 'hotelier_form_pay_after_payment_div', 'htl_uncode_form_pay_after_reservation_table' );
