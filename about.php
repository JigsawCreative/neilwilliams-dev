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
                        <?php nw_the_media('hero'); ?>
                    </div>
                    <p class="gallery-scroll-hint" aria-hidden="true">Swipe for more<span>→</span></p>
                </section>
                <?php the_field('freddie'); ?>
                <section class="image-gallery-section travel-section">
                    <h2>Travel</h2>
                    <div class="image-gallery travel-images">
                        <?php nw_the_media('gallery'); ?>
                    </div>
                    <p class="gallery-scroll-hint" aria-hidden="true">Swipe for more<span>→</span></p>
                </section>
                <?php the_field('travel'); ?>
            </div>
            </div>
        </div>
    </div>

</article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>