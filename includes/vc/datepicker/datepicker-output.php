<?php
/**
 * Datepicker output
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Run hook before the datepicker
 */
function htl_uncode_before_datepicker( $atts ) {
	$dropdown_skin = isset( $atts['datepicker_dropdown_skin'] ) && $atts['datepicker_dropdown_skin'] === 'dark' ? 'dark' : 'light';
	$layout        = isset( $atts['datepicker_layout'] ) && $atts['datepicker_layout'] === 'vertical' ? 'vertical' : 'default';
	$icon          = isset( $atts['icon'] ) && $atts['icon'] ? true : false;

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
	$container_classes = array( 'uncode-htl-module', 'uncode-htl-module--datepciker' );

	if ( $el_class ) {
		$extra_classes = explode( ' ', $el_class );

		foreach ( $extra_classes as $extra_class ) {
			$container_classes[] = $extra_class;
		}
	}

	$container_classes[] = 'datepicker--layout-' . $layout;
	$container_classes[] = 'datepicker--dropdown-' . $dropdown_skin;

	if ( $icon ) {
		$container_classes[] = 'datepicker--with-icon';
	}

	echo '<div ' . $container_id . ' class="' . esc_attr( trim( implode( ' ', $container_classes ) ) ) . '">';
}
add_action( 'hotelier_before_datepicker', 'htl_uncode_before_datepicker' );

/**
 * Run hook after the datepicker
 */
function htl_uncode_after_datepicker( $atts ) {
	echo '</div>';
}
add_action( 'hotelier_after_datepicker', 'htl_uncode_after_datepicker' );

/**
 * Print optional label before datepicker
 */
function htl_uncode_datepicker_before_input( $atts ) {
	// Label before datepicker
	if ( isset( $atts['datepicker_label'] ) && $atts['datepicker_label'] ) {
		echo '<span class="datepicker-form__label">' . esc_html( $atts['datepicker_label'] ) . '</span>';
	}
}
add_action( 'hotelier_datepicker_before_input', 'htl_uncode_datepicker_before_input' );

/**
 * Print optional icon before datepicker
 */
function htl_uncode_datepicker_before_input_select( $atts ) {
	if ( isset( $atts['icon'] ) && $atts['icon'] ) {
		echo '<span class="datepicker-form__icon"><i class="' . esc_html( $atts['icon'] ) . '"></i></span>';
	}
}
add_action( 'hotelier_uncode_datepicker_before_input', 'htl_uncode_datepicker_before_input_select' );
