<?php get_header(); ?>
	<section class="projects">
		<div class="section-head">
			<ol class="breadcrumbs">
				<?php if(function_exists('bcn_display_list'))
				{
					bcn_display_list();
				}?>
			</ol>
			<h1 class="section-headline">Partnerzy</h1>
		</div>

		<article class="Page-body row">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="Page-body-row clearfix">
					<?php if( have_rows('partners') ): ?>
						<?php if(get_field('show_partners') ): ?>
						<h3 class="head-title"><?php the_title(); ?></h3>
						<div class="Page-body-row-images">
						<?php while( have_rows('partners') ): the_row();  ?>
							<?php 
								$img = get_sub_field('logo');
						
								$size = 'partners';
								$alt = $img['alt'];
								$url = $img['url'];
							
								$thumb  = $img['sizes'][ $size ];
								$width  = $img['sizes'][ $size . '-width' ];
								$height = $img['sizes'][ $size . '-height' ];
								
								if ($thumb != ""):
							?>
							<figure><a target="_blank" href="<?php the_sub_field('url'); ?>"><img src="<?php echo $thumb; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo $alt; ?>"></a></figure>
								<?php endif; ?>
						<?php endwhile; ?>
						</div>
						<?php endif; ?>	
					<?php endif; ?>	
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</article>

		<?php get_sidebar(); ?>

	</section>

<?php get_footer(); ?>