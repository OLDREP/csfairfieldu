<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 */
get_header(); ?>

<div id="primary" class="content-area">
    <div  class="site-page">
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
            // Include the page content template.
            get_template_part( 'template-parts/content', 'page' );
            // End of the loop.
        endwhile;
        ?>
    </div>
</div>

<?php get_footer(); ?>