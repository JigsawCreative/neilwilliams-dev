<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <!-- HERO -->
    <header class="post-hero">

        <div class="container">

            <h1 class="post-title"><?php the_title(); ?></h1>

            <div class="post-meta">
                <span><?php echo get_the_date(); ?></span>
                <span>•</span>
                <span><?php the_author(); ?></span>
            </div>

        </div>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-hero-image">
                <?php the_post_thumbnail('full'); ?>
            </div>
        <?php endif; ?>

    </header>

    <!-- CONTENT -->
    <article class="post-content container">

        <?php the_content(); ?>

    </article>

    <!-- MID CTA / INFO STRIP -->
    <section class="post-cta">
        <div class="container">
            <p>Interested in something similar? Get in touch for bespoke options.</p>
            <a href="/contact" class="btn">Contact Us</a>
        </div>
    </section>

    <!-- RELATED POSTS -->
    <section class="related-posts container">
        <h2>Related Posts</h2>

        <?php
        $related = new WP_Query([
            'posts_per_page' => 3,
            'post__not_in' => [get_the_ID()]
        ]);

        if ($related->have_posts()) :
            while ($related->have_posts()) : $related->the_post(); ?>
                
                <a class="related-card" href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>

            <?php endwhile;
            wp_reset_postdata();
        endif;
        ?>

    </section>

    <!-- COMMENTS -->
    <?php if ( comments_open() ) : ?>
        <section class="comments container">
            <?php comments_template(); ?>
        </section>
    <?php endif; ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>