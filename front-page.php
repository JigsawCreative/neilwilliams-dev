<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <div class="container">
        <div class="page-content">
            <header class="page-header">
                <h1 class="page-title">Turning complex problems into practical software<span class="dot">.</span></h1>
            </header>
            
            <div class="page-body">
                <?php the_field('introduction'); ?>
                <!-- <div class="tech-icons">
                    <img src="https://neilwilliams.dev/wp-content/themes/neilwilliams/assets/icons/PHP.svg" alt="PHP logo">
                    <img src="https://neilwilliams.dev/wp-content/themes/neilwilliams/assets/icons/WordPress.svg" alt="WordPress logo">
                    <img src="https://neilwilliams.dev/wp-content/themes/neilwilliams/assets/icons/HTML5.svg" alt="HTML5 logo">
                    <img src="https://neilwilliams.dev/wp-content/themes/neilwilliams/assets/icons/CSS3.svg" alt="CSS3 logo">
                    <img src="https://neilwilliams.dev/wp-content/themes/neilwilliams/assets/icons/Laravel.svg" alt="Laravel logo">
                    <img src="https://neilwilliams.dev/wp-content/themes/neilwilliams/assets/icons/MySQL.svg" alt="MySQL logo">
                    <img src="https://neilwilliams.dev/wp-content/themes/neilwilliams/assets/icons/JavaScript.svg" alt="JavaScript logo">
                    <img src="https://neilwilliams.dev/wp-content/themes/neilwilliams/assets/icons/nodejs.svg" alt="Node.js logo">
                    <img src="https://neilwilliams.dev/wp-content/themes/neilwilliams/assets/icons/React.svg" alt="React logo">
                    <img src="https://neilwilliams.dev/wp-content/themes/neilwilliams/assets/icons/Gulp.svg" alt="Gulp logo">
                    <img src="https://neilwilliams.dev/wp-content/themes/neilwilliams/assets/icons/WooCommerce.svg" alt="WooCommerce logo">
                </div> -->
                <?php the_field('engineering_work'); ?>
                <?php the_field('writing'); ?>
            </div>
        </div>
    </div>

    <div class="reveal-layer">
        <div class="reveal-content"></div>
    </div>

</article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>