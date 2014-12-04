<?php get_header(); ?>
	<section class="Brigades">
		<div class="section-head">
			<ol class="breadcrumbs">
				<?php if(function_exists('bcn_display_list'))
				{
					bcn_display_list();
				}?>
			</ol>
			<h1 class="section-headline"><?php post_type_archive_title(); ?></h1>
		</div>

		<div class="Brigades-body row">
			<?php while ( have_posts() ) : the_post(); ?>
				<article class="Brigades-body-col">
					<figure class="Brigades-body-col-image">
						<?php
							$img = get_field('img');
							$size = 'mini';
							$img_mini = $img['sizes'][ $size ];
							$width = $img['sizes'][ $size . '-width' ];
							$height = $img['sizes'][ $size . '-height' ];
						?>
						<img src="<?php echo $img_mini ; ?>" width="<?php echo $width ; ?>" height="<?php echo $height ; ?>">
					</figure>
					<h1 class="Brigades-body-col-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				</article>
			<?php endwhile; ?>
	</div>

	</section>
	<!-- / .Brigades -->

<?php get_footer(); ?>