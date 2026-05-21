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
                <?php
                    $events = get_field('career_timeline_events');
                    if ($events):
                ?>
                    <!-- <div class="career-timeline">
                        <div class="timeline-item">
                            <div class="timeline-date"><?php echo esc_html($events['pink_blog_links_date']); ?></div>
                            <div class="timeline-content">
                            <h3><?php echo esc_html($events['pink_blog_links_title']); ?></h3>
                            <p><?php echo esc_html($events['pink_blog_links_desc']); ?></p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-date"><?php echo esc_html($events['first_theme_build_date']); ?></div>
                            <div class="timeline-content">
                            <div class="timeline-content-img">
                                <?php inline_svg('wordpress.svg', true); ?>
                            </div>
                            <h3><?php echo esc_html($events['first_theme_build_title']); ?></h3>
                            <p><?php echo esc_html($events['first_theme_build_desc']); ?></p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-date"><?php echo esc_html($events['first_ecommerce_build_date']); ?></div>
                            <div class="timeline-content">
                            <h3><?php echo esc_html($events['first_ecommerce_build_title']); ?></h3>
                            <p><?php echo esc_html($events['first_ecommerce_build_desc']); ?></p>
                            </div>
                        </div>
                    </div> -->
                <?php endif; ?>
                <?php the_field('freddie'); ?>
                <h2>Travel</h2>
                <div class="image-grid">
                    <div class="image-wrapper">
                        <img src="/wp-content/themes/neilwilliams/temp/fred.jpeg" alt="Image 1">
                        <div class="mask"></div>
                    </div>
                    <div class="image-wrapper">
                        <img src="/wp-content/themes/neilwilliams/temp/sorrento.jpeg" alt="Image 2">
                        <div class="mask"></div>
                    </div>
                    <div class="image-wrapper">
                        <img src="/wp-content/themes/neilwilliams/temp/fred2.jpeg" alt="Image 3">
                        <div class="mask"></div>
                    </div>
                </div>
                <?php the_field('travel'); ?>
            </div>
        </div>
    </div>

</article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>