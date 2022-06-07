<?php 
/**
* Choirs - Choirs
* 
* File contains the functions to create and manage individual Choirs
*/

function choir_venues(){
	
	$args = array(
		'post_type' => 'choir'
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