<?php
/**
 * Day View Single Event
 * This file contains one event in the day view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/single-event.php
 *
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$venue_details = tribe_get_venue_details();

// Venue microformats
$has_venue         = ( $venue_details ) ? ' vcard' : '';
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// The address string via tribe_get_venue_details will often be populated even when there's
// no address, so let's get the address string on its own for a couple of checks below.
$venue_address = tribe_get_address();
?>

<!-- Event Title -->
<?php do_action( 'tribe_events_before_the_event_title' ) ?>
<div class="event-title">
	<?php the_title() ?>
</div>
<?php do_action( 'tribe_events_after_the_event_title' ) ?>

<!-- Event Meta -->
<?php do_action( 'tribe_events_before_the_meta' ) ?>
<div class="tribe-events-event-meta <?php echo esc_attr( $has_venue . $has_venue_address ); ?>">

	<!-- Schedule & Recurrence Details -->
	<div class="time">
		<icon class="icon-calendar"></icon><?php echo tribe_events_event_schedule_details(); ?>
	</div>

	<?php if ( $venue_details ) : ?>
		<!-- Venue Display Info -->
		<div class="tribe-events-venue-details">
		<?php
			$address_delimiter = empty( $venue_address ) ? ' ' : ', ';

			// These details are already escaped in various ways earlier in the code.
			echo implode( $address_delimiter, $venue_details );

			if ( tribe_show_google_map_link() ) {
				echo tribe_get_map_link_html();
			}
		?>
		</div> <!-- .tribe-events-venue-details -->
	<?php endif; ?>

</div><!-- .tribe-events-event-meta -->

<?php if ( tribe_get_cost() ) : ?>
	<div class="tribe-events-event-cost">
		<span class="ticket-cost"><?php echo tribe_get_cost( null, true ); ?></span>
		<?php
		/** This action is documented in the-events-calendar/src/views/list/single-event.php */
		do_action( 'tribe_events_inside_cost' )
		?>
	</div>
<?php endif; ?>

<?php do_action( 'tribe_events_after_the_meta' ) ?>

<!-- Event Image -->
<?php echo tribe_event_featured_image( null, 'medium' ); ?>

<!-- Event Content -->
<?php do_action( 'tribe_events_before_the_content' ) ?>
<div class="short-cont">
	<?php
		//echo tribe_events_get_the_excerpt();
		$shortDesc	= get_field('event_short_description');
		echo $shortDesc;
	?>
</div>

<?php
//if content show button to learn more
$cont = get_the_content();
if($cont != ''){
?>
<div class="button-block left">
	<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="btn styled moreafter"><?php esc_html_e( 'Learn More', 'the-events-calendar' ) ?><icon class="icon-icon-arrow_right"></icon></a>
</div>
<?php
}

do_action( 'tribe_events_after_the_content' );
