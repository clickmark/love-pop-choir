<?php lovepopchoir_header(); ?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php love_pop_choir_schema_type(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
	
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	
<link href='<?php echo get_template_directory_uri(); ?>/fullcalendar-5.10.2/lib/main.css' rel='stylesheet' />
<script src='<?php echo get_template_directory_uri(); ?>/fullcalendar-5.10.2/lib/main.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
	
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	
<div class="container">

	<header class="py-3">
		<h3><a href="<?php echo get_home_url(); ?>">Love Pop Choir</a></h3>
	</header>

	<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>

	<section class="py-4">