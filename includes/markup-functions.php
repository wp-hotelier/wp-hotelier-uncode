<?php
/**
 * Markup related functions.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Return array of button classes.
 */
function htl_uncode_get_button_classes( $atts, $prefix ) {
	$button_class = array( 'btn', 'btn-no-scale' );

	if ( isset( $atts[$prefix. '_color'] ) ) {
		$button_class[] = 'btn-' . $atts[$prefix. '_color'];
	} else {
		$button_class[] = 'btn-default';
	}

	if ( isset( $atts[$prefix. '_hover_effect'] ) && $atts[$prefix. '_hover_effect'] === 'full-colored' ) {
		$button_class[] = 'btn-flat';
	}

	if ( isset( $atts[$prefix. '_custom_typo'] ) && $atts[$prefix. '_custom_typo'] === 'yes' ) {
		$button_class[] = 'btn-custom-typo';

		if ( isset( $atts[$prefix. '_font_family'] ) && $atts[$prefix. '_font_family'] ) {
			$button_class[] = $atts[$prefix. '_font_family'];
		}

		if ( isset( $atts[$prefix. '_font_weight'] ) && $atts[$prefix. '_font_weight'] ) {
			$button_class[] = 'font-weight-' . $atts[$prefix. '_font_weight'];
		}

		if ( isset( $atts[$prefix. '_text_transform'] ) && $atts[$prefix. '_text_transform'] ) {
			$button_class[] = 'text-' . $atts[$prefix. '_text_transform'];
		}

		if ( isset( $atts[$prefix. '_letter_spacing'] ) && $atts[$prefix. '_letter_spacing'] ) {
			$button_class[] = $atts[$prefix. '_letter_spacing'];
		} else {
			$button_class[] = 'no-letterspace';
		}
	}

	return $button_class;
}

/**
 * Return array of heading classes.
 */
function htl_uncode_get_heading_classes( $atts ) {
	$heading_class = array();

	if ( isset( $atts['custom_titles_typography'] ) && $atts['custom_titles_typography'] === 'yes' ) {
		if ( isset( $atts['titles_size'] ) && $atts['titles_size'] ) {
			$heading_class[] = $atts['titles_size'];
		} else {
			$heading_class[] = 'h2';
		}

		if ( isset( $atts['titles_weight'] ) && $atts['titles_weight'] ) {
			$heading_class[] = 'font-weight-' . $atts['titles_weight'];
		}

		if ( isset( $atts['titles_transform'] ) && $atts['titles_transform'] ) {
			$heading_class[] = 'text-' . $atts['titles_transform'];
		}

		if ( isset( $atts['titles_height'] ) && $atts['titles_height'] ) {
			$heading_class[] = $atts['titles_height'];
		}

		if ( isset( $atts['titles_space'] ) && $atts['titles_space'] ) {
			$heading_class[] = $atts['titles_space'];
		}
	}

	return $heading_class;
}

