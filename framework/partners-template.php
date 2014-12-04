<?php
	$posts = get_field('partners');
	if( $posts ):
?>


		<h2 class="spacer"><span>Partnerzy</span></h2>
		<div class="homePartners row">
			<?php foreach( $posts as $post): ?>
			<?php setup_postdata($post); ?>
				<?php if( have_rows('partners') ): ?>
					<?php while( have_rows('partners') ): the_row();  ?>
						<figure class="homePartners-image">
							<?php $img = get_sub_field('logo'); ?>
							<a target="_blank" href="<?php the_sub_field('url'); ?>"><img src="<?php echo $img['url']; ?>" width="<?php echo $img['width']; ?>" height="<?php echo $img['height']; ?>" alt="<?php echo $img['alt']; ?>"></a>
						</figure>
					<?php endwhile; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php wp_reset_postdata(); ?>
		</div>


<?php /*else: ?>

	<?php $rows = get_field('partners', 54); ?>

		<?php if($rows): ?>
			<h2 class="spacer"><span>Partnerzy</span></h2>
			<div class="homePartners row">
				<?php foreach($rows as $row): ?>
					<figure class="homePartners-image">
						<?php $img = $row['logo']; ?>
						<a target="_blank" href="<?php echo $row['url']; ?>"><img src="<?php echo $img['url']; ?>" width="<?php echo $img['width']; ?>" height="<?php echo $img['height']; ?>" alt="<?php echo $img['alt']; ?>"></a>
					</figure>
				<?php endforeach; ?>
			</div>
		<?php endif; wp_reset_postdata(); ?>


<?php */ endif; ?>