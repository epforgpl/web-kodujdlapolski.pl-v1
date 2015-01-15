<?php /* Template name: O nas */ ?>
<?php get_header(); ?>
<?php the_post(); ?>
    <section class="Page">
        <div class="section-head">
            <ol class="breadcrumbs">
                <?php if (function_exists('bcn_display_list')) {
                    bcn_display_list();
                } ?>
            </ol>
            <h1 class="section-headline"><?php the_title(); ?></h1>
        </div>

        <article class="Project-body row">
            <div class="col-xs-12 col-md-6">
                <?php the_post_thumbnail('medium'); ?>
            </div>
            <?php the_content('', true); ?>

        </article>

        <?php get_sidebar(); ?>

    </section>
    <!-- / .page -->

    <!-- Partners -->
<?php if (the_slug() == 'o-nas') include_once('framework/partners-template.php'); ?>

<?php get_footer(); ?>