<?php 
/**
* Free Trials - Free Trials
* 
* File contains the functions to handle the free trials and calendar dates
*/

function get_venue_id(){
	
	$free_trial_choir = get_field('choir');
	$free_trial_choir_id = $free_trial_choir->ID;
	
	return $free_trial_choir_id;
}

function get_venue_title(){
	
	$free_trial_choir = get_field('choir');
	$free_trial_choir_title = $free_trial_choir->post_title;
	
	return $free_trial_choir_title;
}

function free_trial_dates(){
	
$free_trial_choir_id = get_venue_id();
	
$args = array(
	'posts_per_page'	=> -1,
    'post_type' => 'session',
	//'post_status' => array( 'pending', 'draft', 'future' , 'publish' ),
	'post_status' => array( 'pending', 'draft', 'future' ),
	'meta_key'		=> 'choir',
	'meta_value'	=> $free_trial_choir_id,
);
	
$the_query = new WP_Query( $args ); ?>
 
<?php 
	
	$dates_array = array();
	
	if ( $the_query->have_posts() ) : 
	
		while ( $the_query->have_posts() ) : $the_query->the_post(); 
	
			$session_date = get_field('session_date');
			$session_time = get_field('session_time');

			$date = date_create($session_date);
			$session_date_formatted = date_format($date,"Y-m-d");
			$session_datetime_formatted = $session_date_formatted . "T" . $session_time . "+09:00";
		
			array_push($dates_array, $session_datetime_formatted);

		endwhile; 

		wp_reset_postdata();
	
	endif;
	
	return $dates_array;
	
	
}

function free_trial_exception_dates(){

	$free_trial_choir_id = get_venue_id();
	$free_trial_id = get_the_ID();
	$exception_dates_array = array();
	
	if( have_rows('free_trial_exception_dates', $free_trial_id) ):
	
		while( have_rows('free_trial_exception_dates', $free_trial_id) ) : the_row();
		

			$free_trial_session = get_sub_field('free_trial_exception_date');
			$free_trial_exception_date = $free_trial_session->post_date;
			$free_trial_exception_ID = $free_trial_session->ID;

			$session_time = get_field('session_time', $free_trial_exception_ID);

			$exception_date = date_create($free_trial_exception_date);
			$exception_date_formatted = date_format($exception_date,"Y-m-d");
			$exception_datetime_formatted = $exception_date_formatted . "T" . $session_time . "+09:00";

			array_push($exception_dates_array, $exception_datetime_formatted);

		endwhile;

	endif;

	return $exception_dates_array;

}

function free_trial_dates_minus_exception_dates(){

	$free_trial_dates = free_trial_dates();
	$free_trial_exception_dates = free_trial_exception_dates();

	$dates_minus_exception_dates = array_diff($free_trial_dates, $free_trial_exception_dates);

	return $dates_minus_exception_dates;

}

function free_trial_calendar(){ 
	
	$free_trial_choir_title = get_venue_title();
	$dates_array = free_trial_dates_minus_exception_dates(); 
	?>
	<script>
			document.addEventListener('DOMContentLoaded', function() {
			var calendarEl = document.getElementById('calendar');
			var calendar = new FullCalendar.Calendar(calendarEl, {
			  initialView: 'dayGridMonth',
				events: [
					<?php foreach($dates_array as $date_single): ?>
					{
						title: "<?php echo $free_trial_choir_title; ?>",
						start: "<?php echo $date_single; ?>",
						end: "<?php echo $date_single; ?>",
						color: 'brightblue',
						textColor: 'white',
						kind: 'event'
					},
					<?php endforeach; ?>
				],	
			});
			calendar.render();
		});
	</script>

	<div id='calendar'></div>

	<?php

}

function free_trial_single(){
	
	if(free_trial_dates()):
	
		free_trial_calendar();
	
	else: ?>
	
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  No free trial dates available for this choir venue.
		  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>

		<?php 
	endif;
	
}

function free_trial_venues(){
	
	$args = array(
		'post_type' => 'free-trial'
	);

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {
		?><div class="row"><?php
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			?>
			<div class="col-md-3">
				<a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
				<h5 class="pt-3">
					<a href="<?php echo get_permalink(); ?>">
						<?php echo get_the_title(); ?>
					</a>
				</h5>
			</div>
			<?php
		}
		?></div><?php
	} else {
		// no posts found
	}
	/* Restore original Post Data */
	wp_reset_postdata();
	
}