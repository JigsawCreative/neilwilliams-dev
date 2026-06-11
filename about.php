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
                <?php the_field('freddie'); ?>
                <h2>Travel</h2>
                <section class="travel-section">
                    <h2>Our favourite places</h2>
                    <div class="travel-images">
                        <div class="travel-image" data-x="-250" data-y="-120" data-r="-12">
                            <img src="/wp-content/themes/neilwilliams/temp/fred.jpeg" alt="Image 1">
                        </div>
                        <div class="travel-image" data-x="280" data-y="-80" data-r="10">
                            <img src="/wp-content/themes/neilwilliams/temp/sorrento.jpeg" alt="Image 2">
                        </div>
                        <div class="travel-image" data-x="-180" data-y="200" data-r="-8">
                            <img src="/wp-content/themes/neilwilliams/temp/fred2.jpeg" alt="Image 3">
                        </div>
                        <div class="travel-image" data-x="220" data-y="180" data-r="14">
                            <img src="/wp-content/themes/neilwilliams/temp/fred.jpeg" alt="Image 4">
                        </div>
                        <div class="travel-image" data-x="0" data-y="-220" data-r="3">
                            <img src="/wp-content/themes/neilwilliams/temp/fred2.jpeg" alt="Image 5">
                        </div>
                    </div>
                    <div class="travel-plane">Plane SVG to go here</div>
                </section>
                <?php the_field('travel'); ?>
            </div>
            </div>
        </div>
    </div>

</article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>