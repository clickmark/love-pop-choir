<?php 
/**
* Free Trials - Free Trials
* 
* File contains the functions to handle the free trials and calendar dates
*/

function free_trial_dates(){
	
$free_trial_choir = get_field('choir');
$free_trial_choir_id = $free_trial_choir->ID;
$free_trial_choir_title = $free_trial_choir->post_title;
	
$args = array(
	'posts_per_page'	=> -1,
    'post_type' => 'session',
	'post_status' => array( 'pending', 'draft', 'future' , 'publish' ),
	'meta_key'		=> 'choir',
	'meta_value'	=> $free_trial_choir_id,
);
	
$the_query = new WP_Query( $args ); ?>
 
<?php 
	
	if ( $the_query->have_posts() ) : 
	
		$dates_array = array();

		while ( $the_query->have_posts() ) : $the_query->the_post(); 
	
			$session_date = get_field('session_date');
			$session_time = get_field('session_time');

			$date = date_create($session_date);
			$session_date_formatted = date_format($date,"Y-m-d");
			$session_datetime_formatted = $session_date_formatted . "T" . $session_time . "+09:00";
		
			array_push($dates_array, $session_datetime_formatted);

		endwhile; 

		wp_reset_postdata();
	
	endif; ?>
	
	<script>
		
		console.log(moment().add(12, 'days').format());
		
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
						kind: 'party',
						state: 'hh'
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