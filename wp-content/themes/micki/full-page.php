<?php /* Template Name: Full Page */ ?>

<?php get_header(); ?>
	<div id='page'>
		<div id='fullContent'>
			<?php the_post(); ?>
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</div>
	</div>
<?php get_footer(); ?>


