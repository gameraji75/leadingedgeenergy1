<?php if ($args3->have_posts()) :
		 ?>
			<div class="card-deck">
				<?php while ($args3->have_posts()) : $args3->the_post(); 
				global $post; ?>
				<div class="card border-0 bg-transparent">
					<?php if(has_post_thumbnail()) { ?>
					<a href="<?php echo esc_url(get_permalink()) ?>"><img width="300" height="300" src="<?php echo  get_the_post_thumbnail_url($post->ID, "recent_posts_thumb_et") ?>" class="" alt="" title="" ></a>
					<?php } ?>
					<div class="card-body px-0">
						<a href="<?php echo esc_url(get_permalink()) ?>"><h6 class="card-title text-primary"><?php echo  get_the_title() ?></h6></a>
						<p class="card-text"><small class="text-muted"><?php echo get_the_author() ?> | 
						<?php foreach( (get_the_category()) as $category ) { ?>
						<a href="<?php echo esc_url( get_category_link( $category->term_id ) ) ?>"><?php echo $category->name ?></a>
						<?php } ?>
						</small></p>
						<p class="card-text"><?php echo get_the_excerpt() ?></p>
					</div>
				</div>
				<?php if ( ( $args3->current_post + 1 && $args3->current_post + 1 != $args3->post_count ) % 2 === 0 ) { ?>
				<div class="w-100 d-none d-sm-block d-md-none"></div>
				<?php }
				endwhile; ?>
			</div>
	<?php wp_reset_query();  // Restore global post data stomped by the_post().
	endif;