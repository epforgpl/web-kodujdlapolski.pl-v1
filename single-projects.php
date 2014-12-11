<?php get_header(); ?>
<?php the_post(); ?>
<section class="Project">
		<div class="section-head">
			<ol class="breadcrumbs">
				<?php if(function_exists('bcn_display_list'))
				{
					bcn_display_list();
				}?>
			</ol>
			<h1 class="section-headline"><?php the_title(); ?></h1>
		</div>

		<article class="Project-body row">
			<figure class="Project-body-header">
				<?php 
				$image = get_field('img_header');
				$url = $image['url'];
				$width = $image['width'];
				$height = $image['height']; ?>

				<img src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
			</figure>
			<article class="Project-body-description row">
				<i>
					<?php
						global $more;
						$more = 0;
						the_content("");
						$more = 1;
					?>
				</i>
				<?php the_content('',true); ?>
				<?php while ( have_rows('linki') ) : the_row(); ?>
					<a href="<?php the_sub_field('link'); ?>" target="_blank" class="Project-body-description-link"><?php the_sub_field('title'); ?> <i>&rsaquo;</i></a>
				<?php endwhile; ?>
			</article>
			<?php if( have_rows('team') ): ?>
			<section class="Team row">
				<h1 class="Team-title">Team</h1>
				<?php while( have_rows('team') ): the_row();  ?>
					<div class="Team-row">
						<figure class="Team-row-photo">
							<?php
								$img = get_sub_field('photo');
								$size = 'avatars';
								$img_post = $img['sizes'][ $size ];
								$width = $img['sizes'][ $size . '-width' ];
								$height = $img['sizes'][ $size . '-height' ];
							?>
							<img src="<?php echo $img_post ; ?>" width="<?php echo $width ; ?>" height="<?php echo $height ; ?>">
						</figure>
						<h2 class="Team-row-title"><?php the_sub_field('name'); ?></h2>
						<span class="Team-row-position"><?php the_sub_field('position'); ?></span>
					</div>
				<?php endwhile; ?>
			<?php endif; wp_reset_postdata(); ?>

				<?php if( have_rows('lookingfor') ): ?>
					<?php while( have_rows('lookingfor') ): the_row();  ?>
						<div class="Team-row Team-row--add">
							<figure class="Team-row-photo">
								<img src="<?php bloginfo('template_url'); ?>/images/image-add-brigade.jpg" width="" height="" alt="">
							</figure>
							<h2 class="Team-row-title"><a class="open_ajax" href="<?php bloginfo('template_url'); ?>/framework/project-email.php?id=<?php echo $post->ID; ?>&pozycja=<?php echo urlencode(get_sub_field('pozycja')); ?>">Dołącz jako <br><?php the_sub_field('pozycja'); ?></a></h2>
						</div>
					<?php endwhile; ?>
			<?php endif; wp_reset_postdata(); ?>

			</section>


		</article>
		<?php get_sidebar(); ?>

	</section>
	<!-- / .Projects -->

	<!-- Partners -->
	<?php include_once('framework/partners-template.php'); ?>

<?php get_footer(); ?>