<?php get_header(); ?>
<?php the_post(); ?>
<section class="Brigade">
		<div class="section-head">
			<ol class="breadcrumbs">
				<?php if(function_exists('bcn_display_list'))
				{
					bcn_display_list();
				}?>
			</ol>
			<h1 class="section-headline">Brygada <?php the_title(); ?></h1>
		</div>

		<article class="Brigade-body row">
			<figure class="Brigade-body-header">
				<?php 
				$image = get_field('img');
				$url = $image['url'];
				$width = $image['width'];
				$height = $image['height']; ?>

				<img src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
			</figure>

			<?php if( have_rows('team') ): $i=0; ?>
				<section class="members">
					<h1 class="members-title">Członkowie brygady</h1>
						<?php while( have_rows('team') ): the_row();  ?>
							<?php if( ($i==0) || ($i==1) ){ ?>
							<div class="members row"> <?php } ?>
								<div class="member-col">
									<figure class="member-col-photo">
										<?php
											$img = get_sub_field('photo');
											$size = 'avatars';
											$img_post = $img['sizes'][ $size ];
											$width = $img['sizes'][ $size . '-width' ];
											$height = $img['sizes'][ $size . '-height' ];
										?>
										<img src="<?php echo $img_post ; ?>" width="<?php echo $width ; ?>" height="<?php echo $height ; ?>">
									</figure>
									<h2 class="member-col-title"><?php the_sub_field('name'); ?></h2>
									<span class="member-col-position"><?php the_sub_field('position'); ?></span>
								</div>
							<?php if($i==0){ ?>
							</div> <?php } ?>
					<?php $i++; endwhile; ?>


						<?php $email = get_field('email');
						if( !empty($email) ): ?>
						<div class="member-col member-col--add">
							<figure class="member-col-photo">
								<img src="<?php bloginfo('template_url'); ?>/images/image-add-brigade.jpg" width="" height="" alt="">
							</figure>
							<h2 class="member-col-title"><a class="open_ajax" href="<?php bloginfo('template_url'); ?>/framework/project-email.php?email=<?php echo $email ?>&pozycja=Brygada%20<?php the_title(); ?>">Dołącz <br>do brygady</a></h2>
						</div>
						<?php endif; ?>
					</div>
				</section>
			<?php endif; wp_reset_postdata(); ?>


			<?php
				$posts = get_field('projects');
				if( $posts ):
			?>
				<section class="projects-brigade row">
					<h1 class="projects-brigade-title">Projekty brygady</h1>
					<div>
					<?php foreach( $posts as $post): ?>
						<?php setup_postdata($post); ?>
						<div class="projects-brigade-col">
							<figure class="projects-brigade-col-image">
								<?php
									$img = get_field('img_header');
									$size = 'mini';
									$img_mini = $img['sizes'][ $size ];
									$width = $img['sizes'][ $size . '-width' ];
									$height = $img['sizes'][ $size . '-height' ];
								?>
								<img src="<?php echo $img_mini ; ?>" width="<?php echo $width ; ?>" height="<?php echo $height ; ?>">
							</figure>
							<h1 class="projects-brigade-col-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h1>
							<div class="projects-brigade-col-description">
								<?php global $more; $more = 0; the_content('', true); ?>
							</div>
						</div>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
					</div>
				</section>
			<?php endif; ?>
		</article>
		<?php

		$eventManager = new EventManager();
		$upcomingEvent = $eventManager->BrygadaEvent(get_the_title());

		?>
		<section class="sidebar" >
			<aside class="event">
				<div class="event-latest-in">
					<div class="event-latest-bottom">
						<?php if(!$eventManager->BrygadaHasEvents(get_the_title())): ?>
							<i class="event-latest-icon"></i>
							<h1 class="event-latest-title">
							Najbliższe spotkanie <span class="event-latest-title-date">Nie mamy nic zaplanowanego</span>
							</h1>
							<?php $email = get_field('email');
							if( !empty($email) ): ?>
								<a style="margin-top: 0" href="<?php bloginfo('template_url'); ?>/framework/events-email.php?email=<?php echo $email ?>&pozycja=Zaproponuj%20temat" class="btn btn--reversed open_ajax">Zaproponuj temat</a>
							<?php endif; ?>

						<?php else: ?>
							<i class="event-latest-icon"></i>
							<h1 class="event-latest-title">
							Najbliższe spotkanie <span class="event-latest-title-date"><?php echo date_i18n("j F", strtotime($upcomingEvent->eventStart)); ?></span>
							</h1>
							<a href="http://facebook.com/events/<?php echo $upcomingEvent->eventId; ?>" class="btn btn--reversed">Więcej</a>
						<?php endif; ?>
					</div>
				</div>
			</aside>

			<aside class="Projects-col Projects--add">
				<a href="http://forum.kodujdlapolski.pl/" target="_blank" class="Projects-add"><span>Masz pomysł na aplikację? <br>
				Zgłoś go! <i>&rsaquo;</i></span></a>
			</aside>
		</section><!-- / .sidebar -->

	</section>
	<!-- / .brygada -->

	<!-- Partners -->
	<?php include_once('framework/partners-template.php'); ?>

<?php get_footer(); ?>