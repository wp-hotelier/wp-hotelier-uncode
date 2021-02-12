<?php
/**
 * Room Loop Start
 *
 * This template can be overridden by copying it to yourtheme/hotelier/loop/loop-start.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div id="index-<?php echo esc_html( rand() ); ?>" class="isotope-system">
	<div class="isotope-wrapper single-gutter">
		<div class="isotope-container isotope-layout style-masonry isotope-pagination" data-type="masonry" data-layout="masonry" data-lg="800">
