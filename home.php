<?php get_header(); ?>

<div class="container">
    <div class="page-header">
        <h1 class="page-title">Writing<span class="dot">.</span></h1>
    </div>
    <div class="blog-main">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('blog_card-article'); ?>>
                    <div class="blog_card">
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                            echo '<span class="post-category"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></span>';
                        }
                        ?>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium', array( 'class' => 'blog_card-thumbnail' ) ); ?>
                            </a>
                        <?php endif; ?>
                        <div class="blog_card-body">
                            <header class="entry-header">
                                <h4 class="entry-title">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                </h4>
                            </header>
                        <div class="entry-summary">
                            <a class="read-more" href="<?php the_permalink(); ?>">Read More &raquo;</a>
                        </div>
                    </div>
                </article>
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
