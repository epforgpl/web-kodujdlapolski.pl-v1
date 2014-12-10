<?php /* Template name: Kontakt */ ?>
<?php get_header(); ?>
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

		<article class="Page-body row">
		<?php if( have_rows('contact') ): ?>
            <div class="Page-body-contacts row">
                <?php the_row();  ?>
                <div class="contact-col">
                    <h3 class="contact-col-name"><?php the_sub_field('name'); ?></h3>
                    <span class="contact-col-position" ><?php the_sub_field('position'); ?></span>
                    <p class="contact-col-details">
                        tel. <?php the_sub_field('phone'); ?><br>
                        <a href="mailto:<?php the_sub_field('mail'); ?>" ><?php the_sub_field('mail'); ?></a>
                    </p>
                </div>
            </div>
			<div class="Page-body-contacts row">
			<?php while( have_rows('contact') ): the_row();  ?>
				<div class="contact-col">
					<h3 class="contact-col-name"><?php the_sub_field('name'); ?></h3>
					<span class="contact-col-position" ><?php the_sub_field('position'); ?></span>
					<p class="contact-col-details">
                        <?php if(has_sub_field('phone')): ?>
						tel. <?php the_sub_field('phone'); ?><br>
                        <?php endif; ?>
						<a href="mailto:<?php the_sub_field('mail'); ?>" ><?php the_sub_field('mail'); ?></a>
					</p>
				</div>
			<?php endwhile; ?>
			</div>
		<?php endif; wp_reset_postdata(); ?>
		<!-- / .Page-body -->
		</article>

		<?php get_sidebar(); ?>

	</section>
	<!-- / .page -->

<?php get_footer(); ?>

