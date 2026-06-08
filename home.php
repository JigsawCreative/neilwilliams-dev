<?php get_header(); ?>

<div class="container">

    <div class="page-header">
        <h1 class="page-title">Writing<span class="dot">.</span></h1>
    </div>

    <div class="blog-main blog-list">

        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('blog-listing'); ?>>

                    <!-- LEFT: DATE -->
                    <div class="blog-date">
                        <span class="day"><?php echo get_the_date('d'); ?></span>
                        <span class="month"><?php echo get_the_date('M Y'); ?></span>
                    </div>

                    <!-- RIGHT: TEXT ONLY -->
                    <div class="blog-content">

                        <h3 class="entry-title">
                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                <?php the_title(); ?>
                            </a>
                        </h3>

                        <div class="entry-excerpt">
                            <?php the_excerpt(); ?>
                        </div>

                    </div>

                </article>

                <!-- DIVIDER -->
                <div class="blog-divider"></div>

            <?php endwhile; ?>

            <div class="pagination">
                <?php the_posts_pagination(); ?>
            </div>

        <?php else : ?>

            <p><?php esc_html_e( 'No posts found.', 'neilwilliams' ); ?></p>

        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>