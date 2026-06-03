<?php

// Register footer widget area
add_action('widgets_init', function() {
    register_sidebar([
        'name'          => __('Footer Widgets', 'wpdoctor'),
        'id'            => 'footer-widgets',
        'description'   => __('Widgets in this area will be shown in the footer.', 'wpdoctor'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
});

add_action( 'after_setup_theme', 'nw_theme_setup' );
function nw_theme_setup() {
load_theme_textdomain( 'nw_theme', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array( 'search-form', 'navigation-widgets' ) );
add_theme_support( 'appearance-tools' );
add_theme_support( 'woocommerce' );
global $content_width;
if ( !isset( $content_width ) ) { $content_width = 1920; }
register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'nw_theme' ) ) );
}
add_action( 'admin_init', 'nw_theme_notice_dismissed' );
function nw_theme_notice_dismissed() {
$user_id = get_current_user_id();
if ( isset( $_GET['dismiss'] ) )
add_user_meta( $user_id, 'nw_theme_notice_dismissed_11', 'true', true );
}
add_action( 'wp_enqueue_scripts', 'nw_theme_enqueue' );
function nw_theme_enqueue() {
wp_enqueue_style( 'nw_theme-style', get_stylesheet_uri() );
}
add_action( 'wp_footer', 'nw_theme_footer' );
function nw_theme_footer() {
?>
<script>
document.addEventListener('DOMContentLoaded', function () {
var deviceAgent = navigator.userAgent.toLowerCase();
var html = document.documentElement;
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
html.classList.add('ios', 'mobile');
}
if (deviceAgent.match(/(android)/)) {
html.classList.add('android', 'mobile');
}
if (navigator.userAgent.search('MSIE') >= 0) {
html.classList.add('ie');
}
else if (navigator.userAgent.search('Chrome') >= 0) {
html.classList.add('chrome');
}
else if (navigator.userAgent.search('Firefox') >= 0) {
html.classList.add('firefox');
}
else if (navigator.userAgent.search('Safari') >= 0 && navigator.userAgent.search('Chrome') < 0) {
html.classList.add('safari');
}
else if (navigator.userAgent.search('Opera') >= 0) {
html.classList.add('opera');
}
});
</script>
<?php
}
add_filter( 'document_title_separator', 'nw_theme_document_title_separator' );
function nw_theme_document_title_separator( $sep ) {
$sep = esc_html( '|' );
return $sep;
}
add_filter( 'the_title', 'nw_theme_title' );
function nw_theme_title( $title ) {
if ( $title == '' ) {
} else {
return wp_kses_post( $title );
}
}
function nw_theme_schema_type() {
$schema = 'https://schema.org/';
if ( is_single() ) {
$type = "Article";
} elseif ( is_author() ) {
$type = 'ProfilePage';
} elseif ( is_search() ) {
$type = 'SearchResultsPage';
} else {
$type = 'WebPage';
}
echo 'itemscope itemtype="' . esc_url( $schema ) . esc_attr( $type ) . '"';
}
function nw_theme_read_more_link() {
if ( !is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'nw_theme' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'excerpt_more', 'nw_theme_excerpt_read_more_link' );
function nw_theme_excerpt_read_more_link( $more ) {
if ( !is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">' . sprintf( __( '...%s', 'nw_theme' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'big_image_size_threshold', '__return_false' );
add_filter( 'intermediate_image_sizes_advanced', 'nw_theme_image_insert_override' );
function nw_theme_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
unset( $sizes['1536x1536'] );
unset( $sizes['2048x2048'] );
return $sizes;
}
add_action( 'widgets_init', 'nw_theme_widgets_init' );
function nw_theme_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'nw_theme' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'wp_head', 'nw_theme_pingback_header' );
function nw_theme_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'nw_theme_enqueue_comment_reply_script' );
function nw_theme_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function nw_theme_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url( comment_author_link() ); ?></li>
<?php
}

function enqueue_theme_scripts() {

    // Enqueue theme styles
    wp_enqueue_style( 'theme-styles-min', get_template_directory_uri() . '/assets/css/style.min.css' );

    // Enqueue Barba.js and GSAP
    wp_enqueue_script('barba-js', 'https://unpkg.com/@barba/core', [], null, true);
    wp_enqueue_script('gsap-js', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', [], null, true);
    wp_enqueue_script('gsap-scroll-trigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', ['gsap-js'], null, true);
    wp_enqueue_script('gsap-motion-path', 'https://cdn.jsdelivr.net/npm/gsap@3/dist/MotionPathPlugin.min.js', ['gsap-js'], null, true);

    // Enqueue minified theme scripts that handle page transitions and menu (all pages)
    wp_enqueue_script('theme-scripts-min', get_template_directory_uri() . '/assets/js/scripts.min.js', ['barba-js'], null, true);

    //Enqueue font awesome
    //wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', [], null);

}
add_action('wp_enqueue_scripts', 'enqueue_theme_scripts');

add_filter('script_loader_tag', 'nw_theme_defer_scripts', 10, 3);

/**
 * Defer loading of specific scripts
 *
 * @param string $tag The script tag.
 * @param string $handle The script handle.
 * @param string $src The script source URL.
 * @return string Modified script tag.
 */
function nw_theme_defer_scripts($tag, $handle, $src) {
    $deferred_handles = array(
        'barba-js',
        'gsap-js',
        'gsap-scroll-trigger',
        'gsap-motion-path',
        'theme-scripts-min',
    );

    if ( in_array( $handle, $deferred_handles, true ) ) {
        return '<script src="' . esc_url( $src ) . '" defer></script>' . "\n";
    }

    return $tag;
}

// Build an array of all post/page URLs and their transition_colours for Barba transitions
function generate_colours_object() {
    // Only run on the front end
    if (is_admin()) return;

    $colours = array();

    // Get all published posts and pages
    $args = array(
        'post_type' => array('post', 'page'),
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'fields' => 'ids',
    );
    $all_posts = get_posts($args);

    foreach ($all_posts as $post_id) {
        $url = wp_make_link_relative(get_permalink($post_id));
        // Remove trailing slash except for home page
        if ($url !== '/' && substr($url, -1) === '/') {
            $url = rtrim($url, '/');
        }
        $colour = get_field('transition_colour', $post_id);
        if ($colour) {
            $colours[$url] = $colour;
        }
    }

    // Localize PHP data to JS for use in page transitions
    wp_localize_script('theme-scripts-min', 'PageColours', array('colours' => $colours));
}

add_action('wp_enqueue_scripts', 'generate_colours_object');

function nw_page_has_cf7_form() {
    if ( ! is_singular() ) {
        return false;
    }

    $post = get_queried_object();

    if ( ! $post instanceof WP_Post ) {
        return false;
    }

    if ( has_shortcode( $post->post_content, 'contact-form-7' ) ) {
        return true;
    }

    if ( function_exists( 'has_block' ) && has_block( 'contact-form-7/contact-form', $post ) ) {
        return true;
    }

    return false;
}

add_action( 'wp_enqueue_scripts', 'nw_conditional_cf7_assets', 100 );
function nw_conditional_cf7_assets() {
    if ( nw_page_has_cf7_form() ) {
        return;
    }

    wp_dequeue_script( 'contact-form-7' );
    wp_dequeue_script( 'swv' );
    wp_dequeue_style( 'contact-form-7' );
    wp_dequeue_style( 'contact-form-7-rtl' );
}

// Inline SVG safely from theme folder
function inline_svg($filename, $classes = '', $echo = true) {
    
    $upload_dir = wp_get_upload_dir(); // gets array with 'basedir' and 'baseurl'

    $file_path = $upload_dir['basedir'] . '/' . $filename; // full filesystem path

    if (!file_exists($file_path)) {
        return '';
    }

    $svg = file_get_contents($file_path);

    // Add classes to the root <svg> element if provided
    if ($classes) {
        // Add class attribute to <svg ...> (preserve existing attributes)
        $svg = preg_replace(
            '/<svg(\s+[^>]*)?>/i',
            '<svg$1 class="' . esc_attr($classes) . '">',
            $svg,
            1
        );
    }

    // Optional: strip scripts or sanitize if not using Safe SVG plugin

    if ($echo) {
        echo $svg;
    } else {
        return $svg;
    }
}