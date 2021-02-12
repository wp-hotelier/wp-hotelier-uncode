<?php
/**
 * Room name
 *
 * This template can be overridden by copying it to yourtheme/hotelier/room-list/content/title.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$heading_class = htl_uncode_get_heading_classes( $shortcode_atts );
?>

<h3 class="room__name room__name--listing <?php echo esc_attr( implode( ' ', $heading_class ) ); ?>"><a class="room__link room__link--listing" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
