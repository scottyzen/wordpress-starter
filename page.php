<?php get_header(); ?>
<h4>page</h4>
<main>
    <!-- Page content -->
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile;
endif; ?>

</main>
<?php get_footer(); ?>