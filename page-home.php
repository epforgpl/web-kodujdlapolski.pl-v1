<?php /* Template name: Strona Główna */ ?>
<?php get_header(); ?>

	<header class="header">
	  <div class="header-title">
	    <p>Koduj Dla Polski to interdyscyplinarna społeczność poszukująca technologicznych rozwiązań społecznych problemów<br><a href="<?php the_field('join'); ?>"><strong>Dołącz do nas</strong></a></p>
	  </div> <!-- / .header-title -->

	<?php
		$fb_page_id = "537482459663806";

// get events for the past x years
$year_range = 1;

// automatically adjust date range
// human readable years
$since_date = date('Y-01-01', strtotime('-' . $year_range . ' years'));
$until_date = date('Y-m-d', strtotime('-1 day'));

// unix timestamp years
$since_unix_timestamp = strtotime($since_date);
$until_unix_timestamp = strtotime($until_date);

		$access_token = "866616866696364|eaWIIUQiT6vJefw1vlp20RD93Uo";

		$fields="id,name,description,location,venue,timezone,start_time,cover";

		$json_link = "https://graph.facebook.com/{$fb_page_id}/events/feed/?fields={$fields}&access_token={$access_token}&since={$since_unix_timestamp}&until={$until_unix_timestamp}";

		$json = file_get_contents($json_link);

		$obj = json_decode(preg_replace('/("\w+"):(\d+)/', '\\1:"\\2"', $json), true);

		$event_count = count($obj['data']);

		$eventManager = new EventManager();
		$upcomingEvent = $eventManager->OneEvent();

	?>

	    <div class="header-latest" <?php if(!$eventManager->haveEvents()) echo 'style="display: none;"'; ?>>
	      <div class="header-latest-in">
	         <div class="header-latest-bottom">
	           <i class="header-latest-icon"></i>
	          	<h1 class="header-latest-title">
		             Najbliższe spotkanie
		             <span class="header-latest-title-date"><?php echo date_i18n("j F", strtotime($upcomingEvent->eventStart)); ?></span>
		             <span class="header-latest-title-location"><?php echo $location; ?></span>
		           </h1>
				   <a href="http://facebook.com/events/<?php echo $upcomingEvent->eventId; ?>" class="btn btn--reversed">Więcej</a>
	         </div>
	      </div>
	      <a href="https://www.facebook.com/KodujDlaPolski/events" class="btn btn--reversed header-latest-btn">Zobacz kalendarz spotkań</a>
	    </div><!-- / .header-latest -->

	</header><!-- / .headers -->

	<table class="stats">
	<tr>
		<td>
            <a href="http://forum.kodujdlapolski.pl" target="_blank" style="color: #333333;">
			<div class="clearfix">
				<figure class="stats-image">
				<img src="<?php bloginfo('template_url'); ?>/images/icon-stats-registered.png" width="" height="" alt="">
				</figure>
				<div class="stats-info">
					<span class="stats-info-label">Ilość osób zarejestrowanych na forum</span>
					<strong class="stats-info-number"><?php the_field('count_user'); ?></strong>
				</div>
			</div>
            </a>
		</td>
		<td>
            <a href="http://forum.kodujdlapolski.pl/category/pomysly" target="_blank" style="color: #333333;">
			<div class="clearfix">
				<figure class="stats-image">
				<img src="<?php bloginfo('template_url'); ?>/images/icon-stats-ideas.png" width="" height="" alt="">
				</figure>
				<div class="stats-info">
					<span class="stats-info-label">Zgłoszone pomysły projektów</span>
					<strong class="stats-info-number"><?php
				$string = file_get_contents("http://forum.kodujdlapolski.pl/category/pomysly.json");
				$json_a = json_decode($string, true);

				echo count($json_a["topic_list"]["topics"])
				?></strong>
				</div>
			</div>
            </a>
		</td>
		<td>
            <a href="/brygady" style="color: #333333;">
			<div class="clearfix">
				<figure class="stats-image">
				<img src="<?php bloginfo('template_url'); ?>/images/icon-stats-teams.png" width="" height="" alt="">
				</figure>
				<div class="stats-info">
					<span class="stats-info-label"><br>
					Brygad</span>
					<strong class="stats-info-number"><?php $count_posts = wp_count_posts('brigades');
						echo $count_posts->publish; ?></strong>
				</div>
			</div>
            </a>
		</td>
		<td>
            <a href="/projekty" style="color: #333333;">
			<div class="clearfix">
				<figure class="stats-image">
				<img src="<?php bloginfo('template_url'); ?>/images/icon-stats-projects.png" width="" height="" alt="">
				</figure>
				<div class="stats-info">
					<span class="stats-info-label">Wspierane projekty</span>
					<strong class="stats-info-number"><?php $count_posts = wp_count_posts('projects');
						echo $count_posts->publish; ?></strong>
				</div>
			</div>
            </a>
		</td>
	</tr>
	</table>
	<!-- / .stats -->


	<?php if( have_rows('three_boxes') ): ?>
		<div class="threeBoxes row" id="dzialaj">
			<?php while( have_rows('three_boxes') ): the_row();  ?>
				  <article class="threeBoxes-col">
				    <div class="threeBoxes-in">
				      <figure class="threeBoxes-image">
				        <?php $img = get_sub_field('img'); ?>
						<img src="<?php echo $img['url']; ?>" width="<?php echo $img['width']; ?>" height="<?php echo $img['height']; ?>" alt="<?php echo $img['alt']; ?>">
				      </figure>
				      <div class="threeBoxes-description">
				        <h1 class="threeBoxes-title"><a href="<?php the_sub_field('url'); ?>"><?php the_sub_field('title'); ?></a></h1>
				       	<?php the_sub_field('desc'); ?>
				       	<a <?php if(get_sub_field('blank') ) echo 'target="_blank"'; ?> href="<?php the_sub_field('url'); ?>" class="btn btn--primary"><?php the_sub_field('btn'); ?></a>
				      </div>
				    </div>
				  </article>
			<?php endwhile; ?>
		</div>
	<?php endif; wp_reset_postdata();?>
	<!-- / .threeBoxes -->



	<?php
		$args = array(
			'post_type' => 'projects',
			'posts_per_page' => 5,
            'orderby' => 'rand'
		);
		$q = new WP_Query($args);
	?>

	<?php if ($q->have_posts()): ?>
		<h2 class="spacer"><span>Wspierane projekty</span></h2>
		<div class="homeProjects row">
			<?php while ($q->have_posts()): $q->the_post() ?>
				  <article class="homeProjects-col">
				    <figure class="homeProjects-image">
					<span class="helper"></span>
					    <?php
							$img = get_field('img_header');
							$size = 'thumbnail';
							$thumb = $img['sizes'][ $size ];
							$width = $img['sizes'][ $size . '-width' ];
							$height = $img['sizes'][ $size . '-height' ];
						?>
						<img src="<?php echo $thumb ; ?>" width="<?php echo $width ; ?>" height="<?php echo $height ; ?>">
				    </figure>
				    <h1 class="homeProjects-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				  </article>
			<?php endwhile; ?>

		  <article class="homeProjects-col homeProjects-col--add">
		    <a href="http://forum.kodujdlapolski.pl/" target="_blank" class="homeProjects-add"><span>Masz pomysł na aplikację? <br>Zgłoś go! <i>&rsaquo;</i></span></a>
		  </article>

		  <div class="homeProjects-bottom">
		    <a href="/projekty" class="btn btn--primary">Zobacz wszystkie</a>
		  </div>
		</div>
	<?php endif; wp_reset_postdata(); ?>
	<!-- / .homeProjects -->


	<!-- Partners -->
	<?php include_once('framework/partners-template.php'); ?>


<?php get_footer(); ?>

