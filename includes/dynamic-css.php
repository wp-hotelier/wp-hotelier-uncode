<?php
/**
 * Dinamic CSS related functions.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function htl_uncode_print_dynamic_css() {
	if ( ! function_exists( 'ot_options_id' ) ) {
		return;
	}

	global $front_background_colors;

	if ( is_multisite() ) {
		$uncode_option = get_blog_option( get_current_blog_id(), ot_options_id() );
	} else {
		$uncode_option = get_option(ot_options_id());
	}

	if ( empty( $uncode_option ) ) {
		return;
	}

	$cs_accent_color        = $uncode_option['_uncode_accent_color'];
	$cs_heading_color_light = $uncode_option['_uncode_heading_color_light'];
	$cs_heading_color_dark  = $uncode_option['_uncode_heading_color_dark'];
	$cs_heading_font_family = $uncode_option['_uncode_heading_font_family'];

	foreach ( $front_background_colors as $key => $value ) {
		if ( $key === $cs_heading_color_light ) {
			$cs_heading_color_light = $value;
		}

		if ( $key === $cs_heading_color_dark ) {
			$cs_heading_color_dark = $value;
		}

		if ( $key === $cs_accent_color ) {
			$cs_accent_color = $value;
		}
	}

	/** Loop fonts **/
	if (isset($uncode_option['_uncode_font_groups'])) {
		$fonts = $uncode_option['_uncode_font_groups'];
		if (!empty($fonts) && is_array($fonts)) {
			foreach ($fonts as $key => $value) {
				$font_class = $value['_uncode_font_group_unique_id'];
				$font_name = urldecode($value['_uncode_font_group']);
				if ($font_name === 'manual') {
					$font_name = $value['_uncode_font_manual'];
				}
				$font_name = str_replace( ', ', ',', $font_name );
				$font_name_arr = explode( ',', $font_name );
				$font_name = '';
				foreach ( $font_name_arr as $key => $font_name_value ) {
					if (strpos($font_name_value, ' ') > 0 && strpos($font_name_value, "'") === false && strpos($font_name_value, "\"") === false) {
						$font_name_value = "'" . $font_name_value . "'";
					}
					$font_name .= $font_name_value;
					if ( ( $key+1 ) < count($font_name_arr) ) {
					    $font_name .= ',';
					}
				}

				if ($font_class === $cs_heading_font_family) {
					$cs_heading_font_family = $font_name;
				}
			}
		}
	}

	ob_start(); ?>

	<style type="text/css">
		.tmb-light.tmb .room__price--loop,
		.tmb-light.tmb .t-entry-room-details span {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.tmb-dark.tmb .room__price--loop,
		.tmb-dark.tmb .t-entry-room-details span {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.tmb-light.tmb .t-entry-visual .room__price--loop,
		.tmb-light.tmb .t-entry-visual .t-entry-room-details span {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.tmb-dark.tmb .t-entry-visual .room__price--loop,
		.tmb-dark.tmb .t-entry-visual .t-entry-room-details span {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.datepicker-form__label,
		.datepicker-form__label--checkin,
		.datepicker-form__label--checkout {
			font-family: <?php echo esc_html( $cs_heading_font_family ); ?>;
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .datepicker-form__label,
		.style-light .style-dark .datepicker-form__label {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.datepicker-form__icon {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .datepicker-form__icon,
		.style-light .style-dark .datepicker-form__icon {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-light .datepicker-input-select,
		.style-dark .style-light .datepicker-input-select {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .datepicker-input-select,
		.style-light .style-dark .datepicker-input-select {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.datepicker--dropdown-dark .datepicker {
			background-color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.datepicker__month-button--prev:after,
		.datepicker__month-button--next:after,
		.datepicker__week-name,
		.datepicker__close-button {
			font-family: <?php echo esc_html( $cs_heading_font_family ); ?>;
		}

		.style-light .room__price--single,
		.style-dark .style-light .room__price--single,
		.style-light .rate__price--single,
		.style-dark .style-light .rate__price--single {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .room__price--single,
		.style-light .style-dark .room__price--single,
		.style-dark .rate__price--single,
		.style-light .style-dark .rate__price--single {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-light .room__min-max-stay,
		.style-dark .style-light .room__min-max-stay {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .room__min-max-stay,
		.style-light .style-dark .room__min-max-stay {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-light .room__conditions-list li,
		.style-dark .style-light .room__conditions-list li,
		.style-light .rate__conditions-list li,
		.style-dark .style-light .rate__conditions-list li {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .room__conditions-list li,
		.style-light .style-dark .room__conditions-list li,
		.style-dark .rate__conditions-list li,
		.style-light .style-dark .rate__conditions-list li {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.room__deposit,
		.rate__deposit {
			font-family: <?php echo esc_html( $cs_heading_font_family ); ?>;
		}

		.style-light .room__meta-list--single li strong,
		.style-dark .style-light .room__meta-list--single li strong {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .room__meta-list--single li strong,
		.style-light .style-dark .room__meta-list--single li strong {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.listing__room.room--selected,
		.listing__room--queried {
			border-color: <?php echo esc_html( $cs_accent_color ); ?>;
		}

		.style-light .room__price--listing,
		.style-dark .style-light .room__price--listing,
		.style-light span.rate__price--listing,
		.style-dark .style-light span.rate__price--listing {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .room__price--listing,
		.style-light .style-dark .room__price--listing,
		.style-dark span.rate__price--listing,
		.style-light .style-dark span.rate__price--listing {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-light .room__max-guests-label,
		.style-dark .style-light .room__max-guests-label {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .room__max-guests-label,
		.style-light .style-dark .room__max-guests-label {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.rate__name--listing {
			font-family: <?php echo esc_html( $cs_heading_font_family ); ?>;
		}

		.style-light .room__conditions-title--listing,
		.style-dark .style-light .room__conditions-title--listing,
		.style-light.rate__conditions-title--listing,
		.style-dark .style-light .rate__conditions-title--listing {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .room__conditions-title--listing,
		.style-light .style-dark .room__conditions-title--listing,
		.style-dark .rate__conditions-title--listing,
		.style-light .style-dark .rate__conditions-title--listing {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-light .table--reservation-table th,
		.style-dark .style-light .table--reservation-table th {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .table--reservation-table th,
		.style-light .style-dark .table--reservation-table th {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-light .amount,
		.style-dark .style-light .amount {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .amount,
		.style-light .style-dark .amount {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-light .room-extra__price,
		.style-dark .style-light .room-extra__price {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .room-extra__price,
		.style-light .style-dark .room-extra__price {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-light .table--price-breakdown th,
		.style-dark .style-light .table--price-breakdown th {
			background-color: <?php echo esc_html( $cs_heading_color_light ); ?>;
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-dark .table--price-breakdown th,
		.style-light .style-dark .table--price-breakdown th {
			background-color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-light .uncode-htl-module--reservation-received .reservation-non-cancellable-disclaimer,
		.style-dark .style-light  .uncode-htl-module--reservation-received .reservation-non-cancellable-disclaimer {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .uncode-htl-module--reservation-received .reservation-non-cancellable-disclaimer,
		.style-light .style-dark  .uncode-htl-module--reservation-received .reservation-non-cancellable-disclaimer {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-light .payment-method__label,
		.style-dark .style-light .payment-method__label {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .payment-method__label,
		.style-light .style-dark .payment-method__label {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-light label[for=stripe-card-element],
		.style-dark .style-light label[for=stripe-card-element] {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark label[for=stripe-card-element],
		.style-light .style-dark label[for=stripe-card-element] {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.widget-booking .widget-booking__date-label {
			font-family: <?php echo esc_html( $cs_heading_font_family ); ?>;
		}

		.style-light .widget-booking .widget-booking__date-block,
		.style-dark .style-light .widget-booking .widget-booking__date-block {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .widget-booking .widget-booking__date-block,
		.style-light .style-dark .widget-booking .widget-booking__date-block {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-light .widget-booking .widget-booking__cart-total strong,
		.style-dark .style-light .widget-booking .widget-booking__cart-total strong {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .widget-booking .widget-booking__cart-total strong,
		.style-light .style-dark .widget-booking .widget-booking__cart-total strong {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-light .room-fee__title,
		.style-dark .style-light .room-fee__title {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .room-fee__title,
		.style-light .style-dark .room-fee__title {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-light .reservation-details__list strong,
		.style-dark .style-light .reservation-details__list strong {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .reservation-details__list strong,
		.style-light .style-dark .reservation-details__list strong {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-light .coupon-card__title,
		.style-dark .style-light .coupon-card__title {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .coupon-card__title,
		.style-light .style-dark .coupon-card__title {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}

		.style-light .reservation-table__room-extra .extra__name,
		.style-dark .style-light .reservation-table__room-extra .extra__name {
			color: <?php echo esc_html( $cs_heading_color_light ); ?>;
		}

		.style-dark .reservation-table__room-extra .extra__name,
		.style-light .style-dark .reservation-table__room-extra .extra__name {
			color: <?php echo esc_html( $cs_heading_color_dark ); ?>;
		}
	</style>

	<?php
	$style = ob_get_clean();

	echo $style;
}
add_action( 'wp_head', 'htl_uncode_print_dynamic_css' );
