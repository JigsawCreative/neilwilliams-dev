<?php

    // Template Name: Contact Page

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
                <div class="contact-page-content">
                    <div class="contact-text">
                        <?php the_field('contact_text'); ?>
                        <p>Or contact me on <a href="https://www.linkedin.com/in/neilwilliamsdev" target="_blank">LinkedIn</a>.</p>
                    </div>
                    <div class="contact-form"><?php echo do_shortcode('[contact-form-7 id="c649ebb" title="Get In Touch"]'); ?></div>
                </div>
            </div>
        </div>
    </div>

</article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>