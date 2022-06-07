<?php
add_action( 'after_setup_theme', 'love_pop_choir_setup' );
function love_pop_choir_setup() {
load_theme_textdomain( 'love_pop_choir', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array( 'search-form', 'navigation-widgets' ) );
add_theme_support( 'woocommerce' );
global $content_width;
if ( !isset( $content_width ) ) { $content_width = 1920; }
register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'love_pop_choir' ) ) );
}
add_action( 'admin_notices', 'love_pop_choir_admin_notice' );
function love_pop_choir_admin_notice() {
$user_id = get_current_user_id();
if ( !get_user_meta( $user_id, 'love_pop_choir_notice_dismissed_5' ) && current_user_can( 'manage_options' ) )
echo '<div class="notice notice-info"><p>' . __( '<big><strong>love_pop_choir</strong>:</big> Help keep the project alive! <a href="?notice-dismiss" class="alignright">Dismiss</a> <a href="https://calmestghost.com/donate" class="button-primary" target="_blank">Make a Donation</a>', 'love_pop_choir' ) . '</p></div>';
}
add_action( 'admin_init', 'love_pop_choir_notice_dismissed' );
function love_pop_choir_notice_dismissed() {
$user_id = get_current_user_id();
if ( isset( $_GET['notice-dismiss'] ) )
add_user_meta( $user_id, 'love_pop_choir_notice_dismissed_5', 'true', true );
}
add_action( 'wp_enqueue_scripts', 'love_pop_choir_enqueue' );
function love_pop_choir_enqueue() {
wp_enqueue_style( 'love_pop_choir-style', get_stylesheet_uri() );
wp_enqueue_script( 'jquery' );
}
add_action( 'wp_footer', 'love_pop_choir_footer' );
function love_pop_choir_footer() {
?>
<script>
jQuery(document).ready(function($) {
var deviceAgent = navigator.userAgent.toLowerCase();
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
$("html").addClass("ios");
$("html").addClass("mobile");
}
if (deviceAgent.match(/(Android)/)) {
$("html").addClass("android");
$("html").addClass("mobile");
}
if (navigator.userAgent.search("MSIE") >= 0) {
$("html").addClass("ie");
}
else if (navigator.userAgent.search("Chrome") >= 0) {
$("html").addClass("chrome");
}
else if (navigator.userAgent.search("Firefox") >= 0) {
$("html").addClass("firefox");
}
else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
$("html").addClass("safari");
}
else if (navigator.userAgent.search("Opera") >= 0) {
$("html").addClass("opera");
}
});
</script>
<?php
}
add_filter( 'document_title_separator', 'love_pop_choir_document_title_separator' );
function love_pop_choir_document_title_separator( $sep ) {
$sep = '|';
return $sep;
}
add_filter( 'the_title', 'love_pop_choir_title' );
function love_pop_choir_title( $title ) {
if ( $title == '' ) {
return '...';
} else {
return $title;
}
}
function love_pop_choir_schema_type() {
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
echo 'itemscope itemtype="' . $schema . $type . '"';
}
add_filter( 'nav_menu_link_attributes', 'love_pop_choir_schema_url', 10 );
function love_pop_choir_schema_url( $atts ) {
$atts['itemprop'] = 'url';
return $atts;
}
if ( !function_exists( 'love_pop_choir_wp_body_open' ) ) {
function love_pop_choir_wp_body_open() {
do_action( 'wp_body_open' );
}
}
add_action( 'wp_body_open', 'love_pop_choir_skip_link', 5 );
function love_pop_choir_skip_link() {
echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'love_pop_choir' ) . '</a>';
}
add_filter( 'the_content_more_link', 'love_pop_choir_read_more_link' );
function love_pop_choir_read_more_link() {
if ( !is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'love_pop_choir' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'excerpt_more', 'love_pop_choir_excerpt_read_more_link' );
function love_pop_choir_excerpt_read_more_link( $more ) {
if ( !is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">' . sprintf( __( '...%s', 'love_pop_choir' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'big_image_size_threshold', '__return_false' );
add_filter( 'intermediate_image_sizes_advanced', 'love_pop_choir_image_insert_override' );
function love_pop_choir_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
unset( $sizes['1536x1536'] );
unset( $sizes['2048x2048'] );
return $sizes;
}
add_action( 'widgets_init', 'love_pop_choir_widgets_init' );
function love_pop_choir_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'love_pop_choir' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'wp_head', 'love_pop_choir_pingback_header' );
function love_pop_choir_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'love_pop_choir_enqueue_comment_reply_script' );
function love_pop_choir_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function love_pop_choir_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url( comment_author_link() ); ?></li>
<?php
}
add_filter( 'get_comments_number', 'love_pop_choir_comment_count', 0 );
function love_pop_choir_comment_count( $count ) {
if ( !is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}