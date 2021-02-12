<?php
/**
 * Reservation Received Page - This is the page guests are sent to after completing their reservation
 *
 * This template can be overridden by copying it to yourtheme/hotelier/booking/received.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'hotelier_before_reservation_received_page', $shortcode_atts );

$title_classes = htl_uncode_get_heading_classes( $shortcode_atts );
$button_classes = htl_uncode_get_button_classes( $shortcode_atts, 'booking_buttons' );

if ( $reservation ) : ?>

	<div class="reservation-received__section">

		<?php if ( $reservation->has_status( 'failed' ) ) : ?>

			<h3 class="reservation-response reservation-response--failed <?php echo esc_attr( implode( ' ', $title_classes ) ); ?>"><?php esc_html_e( 'Unfortunately your reservation cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'wp-hotelier' ); ?></h3>

			<h3 class="reservation-response reservation-response--failed">
				<a href="<?php echo esc_url( $reservation->get_booking_payment_url() ); ?>" class="button button--pay-failed-reservation <?php echo esc_attr( implode( ' ', $button_classes ) ); ?>"><?php _e( 'Pay', 'wp-hotelier' ) ?></a>
			</h3>

		<?php elseif ( $reservation->has_status( 'cancelled' ) ) : ?>

			<h3 class="reservation-response reservation-response--cancelled <?php echo esc_attr( implode( ' ', $title_classes ) ); ?>"><?php echo apply_filters( 'hotelier_reservation_cancelled_text', esc_html__( 'This reservation has been cancelled. The reservation was as follows.', 'wp-hotelier' ), $reservation ); ?></h3>

			<?php do_action( 'hotelier_reservation_details', $reservation ); ?>

		<?php elseif ( $reservation->has_status( 'refunded' ) ) : ?>

			<h3 class="reservation-response reservation-response--refunded <?php echo esc_attr( implode( ' ', $title_classes ) ); ?>"><?php echo apply_filters( 'hotelier_reservation_refunded_text', esc_html__( 'This reservation has been refunded. The reservation was as follows.', 'wp-hotelier' ), $reservation ); ?></h3>

			<?php do_action( 'hotelier_reservation_details', $reservation ); ?>

		<?php else : ?>

			<h3 class="reservation-response reservation-response--received <?php echo esc_attr( implode( ' ', $title_classes ) ); ?>"><?php echo apply_filters( 'hotelier_reservation_received_text', esc_html__( 'Thank you. Your reservation has been received.', 'wp-hotelier' ), $reservation ); ?></h3>

			<?php do_action( 'hotelier_reservation_details', $reservation ); ?>

		<?php endif; ?>

	</div>

	<?php do_action( 'hotelier_received_' . $reservation->payment_method, $reservation->id ); ?>
	<?php do_action( 'hotelier_received', $reservation->id ); ?>

<?php else : ?>

	<div class="reservation-received__section">

		<h3 class="reservation-response reservation-response--invalid"><?php esc_html_e( 'Invalid reservation.', 'wp-hotelier' ); ?></h3>

		<p><a class="button button--backward <?php echo esc_attr( implode( ' ', $button_classes ) ); ?>" href="<?php echo esc_url( HTL()->cart->get_room_list_form_url() ); ?>"><?php esc_html_e( 'List of available rooms', 'wp-hotelier' ) ?></a></p>

	</div>

<?php endif; ?>

<?php do_action( 'hotelier_after_reservation_received_page', $shortcode_atts ); ?>
