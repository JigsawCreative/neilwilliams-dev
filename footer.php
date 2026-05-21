            </main>
            <footer id="footer" role="contentinfo">
                    <div id="footer-widgets">
                        <?php if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
                            <?php dynamic_sidebar( 'footer-widgets' ); ?>
                        <?php endif; ?>
                    </div>
            </footer>
        </div><!-- .barba-container -->
    </div><!-- #barba-wrapper -->
    <?php wp_footer(); ?>
    <div id="copyright">
        <small>&copy; <?php echo esc_html( date_i18n( __( 'Y', 'wp-doctor' ) ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?></small>
    </div>
    </body>
</html>