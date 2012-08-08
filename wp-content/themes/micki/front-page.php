<?php get_header(); ?>

			<div id='fullContent'>
				<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
						<h2><?php get_tagline(); ?></h2>
						<?php the_content(); ?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
			<div id='main'>
				<div id='mainLeft'>
					<div id='slideshow'>
						<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js'></script>
						<script type='text/javascript' src='<?php bloginfo('template_directory');?>/js/micki_slideshow.js'></script>
						<?php 
							$count = 0;
							global $post;
							$args = array('post_parent' => get_the_ID(),
								'post_type' => 'attachment',
								'post_mime_type' =>'image',
								'order' => 'ASC',
								'orderby' => 'menu_order',
								'numberposts' => 4,
							);
							
							$attachments = get_children($args);
				    		foreach ( $attachments as $attachment_id => $attachment ) {
				    			$count++;
								$attributes = wp_get_attachment_image_src( $attachment_id, 'micki_main' );
								$url = get_post_meta($attachment_id, 'micki_photo_url', $single = true);
								echo "<div id='slide" . $count . "' class='slide'>";
								echo "<a href='" . $url . "'>";
								echo "<img src='" . $attributes[0] . "' alt='Slideshow Image'/></a>";
								echo "<div class='caption'></div>";
								echo "<h4 class='white'>" . $attachment->post_title . "</h4>";
								echo "<p class='white'>" . $attachment->post_excerpt . $attachment->micki_photo_url . "</p>";
								echo "</div>";
				    		}
							$count = 0;
							foreach ( $attachments as $attachment_id => $attachment ) {
								$count++;
								$attributes = wp_get_attachment_image_src( $attachment_id, 'micki_thmb' );
								echo "<img id='thumb" . $count ."' class='thumb' src='" . $attributes[0]
									. "' alt='thumb' onclick='micki_ss.forcedSwitch(" . $count . ")'/>";
							}
						?>
					</div>
				</div>
				<div id='mainRight'>
					<?php 
						query_posts( 'post_type=micki_right_box&order=ASC' );
						$num_posts = $wp_query->post_count;
						$current_post = 0; 
					?>
					<?php while (have_posts()) : the_post(); ?>
						<?php
							$current_post++;
							if($current_post != $num_posts) {
								echo "<div class='rightBox'>";
							} else {
								echo "<div class='rightBox marginOff'>";														
							}
						?>
						<h3><?php the_title(); ?></h3>
						<?php the_content(); ?>
						</div>
					<?php endwhile; ?>
				</div>
				<div class='clearBoth'></div>
			</div>
			<div id='promos'>
				<?php 
					query_posts( 'post_type=micki_bottom_box&order=ASC&posts_per_page=2' );
					$num_posts = $wp_query->post_count;
				?>
				<?php while (have_posts()) : the_post(); ?>
					<div class='promoBox'>
						<h3><?php the_title(); ?></h3>
						<?php the_content(); ?>
					</div>
				<?php endwhile; ?>
				<div class='promoBox marginOff'>
					<h3>Connect</h3>
					<a href='<?php echo FACEBOOK_URL;?>'><img src='<?php bloginfo('template_directory');?>/images/facebook-icon.png'/></a>
					<a href='<?php echo TWITTER_URL;?>'><img src='<?php bloginfo('template_directory');?>/images/twitter-icon.png'/></a>
				</div>
				<div class='promoBox mission'>
					<p>The mission of Circle K is to develop leaders with a lifelong commitment to service.</p>
				</div>
				<div class='clearLeft'></div>
			</div>

<?php get_footer(); ?>


