<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<?php if (is_front_page()) { ?>
			<title><?php bloginfo('name'); ?></title>
		<?php } else { ?>
			<title><?php bloginfo('name'); ?> | <?php the_title(); ?></title>
		<?php } ?>
		<link rel='stylesheet' href='<?php bloginfo('stylesheet_url');?>' type='text/css'/>
		<link rel='icon' type='image/ico' href='<?php bloginfo('template_directory');?>/images/favicon.ico'/>
		<?php wp_head(); ?>
	</head>
	<body>
		<div id='wrapper'>
			<div id='header'>
 			</div>
			<div id='nav'>
					<ul>
						<?php wp_list_pages('title_li=&depth=1'); ?>
					</ul>
					<div class='clearLeft'></div>
			</div>