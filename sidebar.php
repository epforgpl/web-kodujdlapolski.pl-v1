<section class="sidebar" >
	<h2 class="head-title-projects spacer"><span><a href="/projekty">Zobacz także</a></span></h2>
	<?php
		$args = array(
			'post_type' => 'projects',
			'orderby' => 'rand',
			'posts_per_page' => 1,
		);
		$q = new WP_Query($args);
	?>
	<?php if ($q->have_posts()): ?>
		<?php while ($q->have_posts()): $q->the_post() ?>
			<a href="<?php the_permalink() ?>"><figure class >
				<?php
						$img = get_field('img_header');
						$size = 'mini';
						$img_mini = $img['sizes'][ $size ];
						$width = $img['sizes'][ $size . '-width' ];
						$height = $img['sizes'][ $size . '-height' ];
				?>
				<img src="<?php echo $img_mini ; ?>" width="<?php echo $width ; ?>" height="<?php echo $height ; ?>">
			</figure>
			<h3 class="head-title"><?php the_title(); ?></h3></a>
			<div class="head-info">
				<?php global $more; $more = 0; the_content('', true); ?>
			</div>
		<?php endwhile; ?>
	<?php endif; wp_reset_postdata(); ?>

	<aside class="Projects-col Projects--add">
		<a href="http://forum.kodujdlapolski.pl/" class="Projects-add"><span>Masz pomysł na aplikację? <br>
		Zgłoś go! <i>&rsaquo;</i></span></a>
	</aside>
</section>
