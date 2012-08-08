<?php get_header(); ?>
		<div id='page'>
				<div id='pageNav'>
					<?php 
						if($post->post_parent){
							$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
					  	}else{
					  		$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
					  	}
						if ($children) { 
							echo '<ul>';
							echo $children; 
							echo '</ul>';
						}
					?>
					<div id='quote'>
						<?php 
							query_posts( 'post_type=micki_quote&orderby=rand&posts_per_page=1' );
							the_post();
						?>
						<?php the_content(); ?>
						<div class='alignRight'><strong><i><?php the_title(); ?></i></strong></div>
					</div>
				</div>
				<div id='pageContent'>
					<?php wp_reset_query(); ?>
					<?php the_post(); ?>						
					<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
				</div>
				<div class='clearLeft'></div>
			</div>
<?php get_footer(); ?>


