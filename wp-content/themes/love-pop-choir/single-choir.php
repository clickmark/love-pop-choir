<?php get_header(); ?>

<h3><?php the_title(); ?></h3>
<p>Join Singing Mums – Harrogate for their first half term of the 2022 New Year.</p>
<hr><br>

<?php if(is_user_logged_in()): ?>
<h5 class="mb-4"><u>Choose terms</u></h5>
	
	<?php
	$featured_posts = get_field('terms');
	if( $featured_posts ): ?>

		<ul>
		<?php foreach( $featured_posts as $post ):
			
			setup_postdata($post); ?>
			
			<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="defaultCheck<?php echo get_the_ID(); ?>">
			  <label class="form-check-label" for="defaultCheck<?php echo get_the_ID(); ?>">
				<?php the_title(); ?>
			  </label>
			</div>
			
		<?php endforeach; ?>
		</ul>

		<?php wp_reset_postdata(); ?>

	<?php else: ?>
	<strong class="text-danger">No terms currently available in this choir</strong>
	<?php endif; ?>

<?php else: ?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Login to proceed</strong> In order to proceed you need to login or register for an account.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php endif; ?>

<?php get_footer(); ?>