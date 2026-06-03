<?php

    // Template Name: Focus Page

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
                <?php the_content(); ?>
                <?php the_field('focus'); ?>
                <?php the_field('improvements'); ?>
                <?php the_field('direction'); ?>
            </div>
        </div>
    </div>

</article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>