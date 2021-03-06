<?php get_header(); 
query_posts($query_string . '&showposts=-1'); 
?>
    <section class="Page">
        <div class="section-head">
            <ol class="breadcrumbs">
                <?php if (function_exists('bcn_display_list')) {
                    bcn_display_list();
                } ?>
            </ol>
            <h1 class="section-headline"><?php post_type_archive_title(); ?></h1>
        </div>

        <div class="Projects-body row">

            <?php while (have_posts()) : the_post(); ?>
                <article class="Projects-col">
                    <a href="<?php the_permalink(); ?>">
                        <figure class="Projects-image">
                            <?php
                            $img = get_field('img_header');
                            $size = 'mini';
                            $img_mini = $img['sizes'][$size];
                            $width = $img['sizes'][$size . '-width'];
                            $height = $img['sizes'][$size . '-height'];
                            ?>
                            <span class="helper"></span><img src="<?php echo $img_mini; ?>"
                                                             width="<?php echo $width; ?>"
                                                             height="<?php echo $height; ?>">
                        </figure>
                        <h1 class="Projects-title"><?php the_title(); ?></h1>
                    </a>

                    <p class="Projects-description"><?php the_content('', true); ?></p>
                </article><!-- / .Projects-col -->
            <?php endwhile; ?>
            <article class="Projects-col Projects-col--add">
                <a href="http://forum.kodujdlapolski.pl/t/jak-dodawac-nowe-pomysly/899" class="Projects-add"><span>Masz pomysł na aplikację? <br>
				Zgłoś go! <i>&rsaquo;</i></span></a>
            </article>
            <!-- / .Projects-col -->
        </div>
    </section>
    <!-- / .projects -->

<?php get_footer(); ?>
