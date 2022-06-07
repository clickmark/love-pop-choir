<?php 
/**
* Terms - Terms
* 
* File contains the functions to create and manage individual terms
*/

add_action('acf/save_post', 'save_new_term', 20);

function save_new_term($post_id) {

	if( get_post_type($post_id) !== 'term' ) { 
		return; 
	}

	if( !is_admin() ) { return; }

	//check if auto populate dates true
	$auto_populate_dates = get_field('auto_populate_dates', $post_id);

	if($auto_populate_dates):

		/**************************
		 * Create session dates
		 **************************/

		$term_sessions = array();

		$from_date = get_field('choose_start_date');
		$end_date = get_field('choose_end_date');

		$session_dates_array = array();
		$date_pointer = $from_date;

		$loop_count = 1;

		while($date_pointer <= $end_date):

			$unix_date_pointer = strtotime($date_pointer);
			if($loop_count == 1):
				array_push($session_dates_array, $from_date);
			else: 
				array_push($session_dates_array, date('Ymd', $date));
			endif;
			$date = strtotime("+7 day", $unix_date_pointer);
			$date_pointer = date('Ymd', $date);

			$loop_count++;

		endwhile;

		$choir_object = get_field('choir');
		$choir_id = $choir_object->ID;
		$choir_title = $choir_object->post_title;
		$session_price = get_field('price');
		$session_participants = get_field('participants');
		$session_time = get_field('time');

		foreach($session_dates_array as $session_date):

			$session_id = session_exists($session_date, $choir_id);

			if($session_id == false):		
				$session_id = generate_session_date($session_date, $choir_id, $choir_title, $session_price, $session_participants, $session_time);
			endif;

			array_push($term_sessions, $session_id);

		endforeach;

		/**************************
		 * Generate custom title
		 **************************/		

		$custom_post_title = $choir_title . " [" . $from_date . ' - ' . $end_date . "]";

		$data = array(
			'ID' => $post_id,
			'post_title' => $custom_post_title,
		 );

		wp_update_post($data);

		/**************************
		 * Uncheck the auto populate dates
		 **************************/

		update_field('field_6253de0cfd4f4', false, $post_id);

		/**************************
		 * Update sessions array
		 **************************/

		update_field('field_624e7b5054ebd', $term_sessions, $post_id);


	endif;//auto populate dates

}

function session_exists($session_date, $choir_id){

	$args = array(
		'post_type' => 'session',
		'meta_key'		=> 'session_date',
		'meta_value'	=> $session_date,
	);

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) :

		while ( $the_query->have_posts() ) : $the_query->the_post();

			$session_id = get_the_ID();

			break;

		endwhile; wp_reset_postdata();

		return $session_id;

	else: 

		return false;

	endif;	

}

function generate_session_date($session_date, $choir_id, $choir_title, $session_price, $session_participants, $session_time){ 

	$new_session_date = date("d/m/Y", strtotime($session_date));	
	$session_title = $new_session_date . " " . $choir_title; 

	$postdate = date( 'Y-m-d', strtotime($session_date));
	$postdatetime = $postdate . ' 00:00:00';

	$new_session_data = array(
		'post_title'    => $session_title,
		'post_status'   => 'publish',
		'post_type' => 'session',
	   'post_date'     =>   $postdatetime,
	);
	$session_id = wp_insert_post($new_session_data); 

	update_field('field_624e7a4f15e5f', $session_date, $session_id);	
	update_field('field_624e7d3555614', $choir_id, $session_id);	
	update_field('field_624e7f1f0b3d8', $session_price, $session_id);	
	update_field('field_624e81327e354', $session_participants, $session_id);	
	update_field('field_624e7a6915e60', $session_time, $session_id);	

	return $session_id;

}