<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <div class="container">
        <div class="page-content">
            <header class="page-header">
                <h1 class="page-title"><?php the_title(); ?><span class="dot">.</span></h1>
            </header>
            
            <div class="page-body">
                <?php the_field('introduction'); ?>
                <?php the_field('approach'); ?>
                <div class="tech-icons">
                    <img src="https://neilwilliams.local/wp-content/themes/neilwilliams/assets/icons/php.svg" alt="PHP logo">
                    <img src="https://neilwilliams.local/wp-content/themes/neilwilliams/assets/icons/wordpress.svg" alt="WordPress logo">
                    <img src="https://neilwilliams.local/wp-content/themes/neilwilliams/assets/icons/html5.svg" alt="HTML5 logo">
                    <img src="https://neilwilliams.local/wp-content/themes/neilwilliams/assets/icons/css3.svg" alt="CSS3 logo">
                    <img src="https://neilwilliams.local/wp-content/themes/neilwilliams/assets/icons/laravel.svg" alt="Laravel logo">
                    <img src="https://neilwilliams.local/wp-content/themes/neilwilliams/assets/icons/mysql.svg" alt="MySQL logo">
                    <img src="https://neilwilliams.local/wp-content/themes/neilwilliams/assets/icons/javascript.svg" alt="JavaScript logo">
                    <img src="https://neilwilliams.local/wp-content/themes/neilwilliams/assets/icons/nodejs.svg" alt="Node.js logo">
                    <img src="https://neilwilliams.local/wp-content/themes/neilwilliams/assets/icons/react.svg" alt="React logo">
                    <img src="https://neilwilliams.local/wp-content/themes/neilwilliams/assets/icons/gulp.svg" alt="Gulp logo">
                    <img src="https://neilwilliams.local/wp-content/themes/neilwilliams/assets/icons/woocommerce.svg" alt="WooCommerce logo">
                </div>
                <?php the_field('tech_&_tools'); ?>
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