<?php get_header(); ?>
<?php the_post(); ?>
<section class="Page">
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
				<?php the_post_thumbnail( 'post' ); ?>
			</figure>
			<article style="padding-top: 20px;">
				<?php the_content(); ?>
			</article>
		</article>

		<?php get_sidebar(); ?>

	</section>
	<!-- / .page -->
	
	<!-- Partners -->
	<?php if(the_slug()=='o-nas') include_once('framework/partners-template.php'); ?>


<?php get_footer(); ?>

