<?php

    // Template Name: About Page

    get_header(); 
    
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <div class="container">
        <div class="page-content">
            <header class="page-header">
                <h1 class="page-title"><?php the_title(); ?><span class="dot">.</span></h1>
            </header>
            <div class="page-body">
                <?php the_field('introduction'); ?>
                <section class="image-gallery-section travel-section">
                    <h2>Freddie</h2>
                    <div class="image-gallery travel-images">
                        <img src="/wp-content/themes/neilwilliams/temp/fred.jpeg" alt="Gallery image 1">
                        <img src="/wp-content/themes/neilwilliams/temp/sorrento.jpeg" alt="Gallery image 2">
                        <img src="/wp-content/themes/neilwilliams/temp/fred2.jpeg" alt="Gallery image 3">
                        <img src="/wp-content/themes/neilwilliams/temp/fred.jpeg" alt="Gallery image 4">
                        <img src="/wp-content/themes/neilwilliams/temp/fred2.jpeg" alt="Gallery image 5">
                    </div>
                </section>
                <?php the_field('freddie'); ?>
                <section class="image-gallery-section travel-section">
                    <h2>Travel</h2>
                    <div class="image-gallery travel-images">
                        <img src="/wp-content/themes/neilwilliams/temp/fred.jpeg" alt="Gallery image 1">
                        <img src="/wp-content/themes/neilwilliams/temp/sorrento.jpeg" alt="Gallery image 2">
                        <img src="/wp-content/themes/neilwilliams/temp/fred2.jpeg" alt="Gallery image 3">
                        <img src="/wp-content/themes/neilwilliams/temp/fred.jpeg" alt="Gallery image 4">
                        <img src="/wp-content/themes/neilwilliams/temp/fred2.jpeg" alt="Gallery image 5">
                    </div>
                </section>
                <?php the_field('travel'); ?>
            </div>
            </div>
        </div>
    </div>

</article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>