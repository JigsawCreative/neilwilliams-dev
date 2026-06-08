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