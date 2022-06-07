<?php 
/**
* Free Trials - Free Trials
* 
* File contains the functions to handle the free trials and calendar dates
*/

function free_trial_dates(){ ?>

<script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
			events: [
     
      {
        title: "Trial Date",
        start: moment().subtract(2, 'days').format(),
        end: moment().subtract(2, 'days').add(3, 'hours').format(),
        color: 'brightblue',
        textColor: 'white',
        kind: 'party',
        state: 'hh'
      },
	{
        title: "Trial Date",
        start: moment().subtract(2, 'days').format(),
        end: moment().subtract(2, 'days').add(3, 'hours').format(),
        color: 'brightblue',
        textColor: 'white',
        kind: 'party',
        state: 'hh'
      },
		{
        title: "Trial Date",
        start: moment().add(7, 'days').format(),
        end: moment().add(7, 'days').add(3, 'hours').format(),
        color: 'brightblue',
        textColor: 'white',
        kind: 'party',
        state: 'hh'
      },
		{
        title: "Trial Date",
        start: moment().add(12, 'days').format(),
        end: moment().add(12, 'days').add(3, 'hours').format(),
        color: 'brightblue',
        textColor: 'white',
        kind: 'party',
        state: 'hh'
      },
				
				{
        title: "Trial Date",
        start: moment().add(9, 'days').format(),
        end: moment().add(9, 'days').add(3, 'hours').format(),
        color: 'brightblue',
        textColor: 'white',
        kind: 'party',
        state: 'hh'
      },
      {
        title: "Trial Date",
        start: moment().format(),
        end: moment().add(3, 'hours').format(),
        color: 'brightblue',
        textColor: 'white',
        kind: 'party',
        state: 'sh'
      },
      {
        title: "Trial Date",
        start: moment().add(1, 'days').format(),
        end: moment().add(1, 'days').add(3, 'hours').format(),
        color: 'red',
        textColor: 'white',
        kind: 'concert',
        state: 'sh'
      },
      {
        title: "Trial Date",
        start: moment().subtract(3, 'days').format(),
        end: moment().subtract(3, 'days').add(3, 'hours').format(),
        color: 'red',
        textColor: 'white',
        kind: 'concert',
        state: 'hh'
      },
    ],
			
		});
        calendar.render();
      });

    </script>

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