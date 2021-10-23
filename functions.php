<?php
add_action( 'after_setup_theme', 'richardwhiteley_setup' );
function richardwhiteley_setup() {
    load_theme_textdomain( 'richardwhiteley', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form' ) );
    global $content_width;
    if ( ! isset( $content_width ) ) { $content_width = 1920; }
    register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'richardwhiteley' ) ) );

    add_image_size( 'wide-thumbnail', 600, 300, true );
}
add_action( 'admin_notices', 'richardwhiteley_admin_notice' );
function richardwhiteley_admin_notice() {
$user_id = get_current_user_id();
if ( !get_user_meta( $user_id, 'richardwhiteley_notice_dismissed_2' ) && current_user_can( 'manage_options' ) )
echo '<div class="notice notice-info"><p>' . __( '<big><strong>richardwhiteley Users</strong>:</big> <a href="?notice-dismiss" class="alignright">Dismiss</a> <a href="https://github.com/tidythemes/richardwhiteley/issues/23" class="button-primary" target="_blank">Important Announcement!</a> <a href="https://calmestghost.com/donate" class="button-primary" target="_blank">Make a Donation</a>', 'richardwhiteley' ) . '</p></div>';
}
add_action( 'admin_init', 'richardwhiteley_notice_dismissed' );
function richardwhiteley_notice_dismissed() {
$user_id = get_current_user_id();
if ( isset( $_GET['notice-dismiss'] ) )
add_user_meta( $user_id, 'richardwhiteley_notice_dismissed_2', 'true', true );
}
add_action( 'wp_enqueue_scripts', 'richardwhiteley_load_scripts' );
function richardwhiteley_load_scripts() {
wp_enqueue_style( 'richardwhiteley-style', get_stylesheet_uri() );
wp_enqueue_script( 'jquery' );
}
add_action( 'wp_footer', 'richardwhiteley_footer_scripts' );
function richardwhiteley_footer_scripts() {
?>
<script>
jQuery(document).ready(function ($) {
var deviceAgent = navigator.userAgent.toLowerCase();
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
$("html").addClass("ios");
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
if ( !function_exists( 'richardwhiteley_wp_body_open' ) ) {
function richardwhiteley_wp_body_open() {
do_action( 'wp_body_open' );
}
}
add_action( 'wp_body_open', 'richardwhiteley_skip_link', 5 );
function richardwhiteley_skip_link() {
echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'richardwhiteley' ) . '</a>';
}
add_filter( 'document_title_separator', 'richardwhiteley_document_title_separator' );
function richardwhiteley_document_title_separator( $sep ) {
$sep = '|';
return $sep;
}
add_filter( 'the_title', 'richardwhiteley_title' );
function richardwhiteley_title( $title ) {
if ( $title == '' ) {
return '...';
} else {
return $title;
}
}
add_filter( 'the_content_more_link', 'richardwhiteley_read_more_link' );
function richardwhiteley_read_more_link() {
if ( ! is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">...</a>';
}
}
add_filter( 'excerpt_more', 'richardwhiteley_excerpt_read_more_link' );
function richardwhiteley_excerpt_read_more_link( $more ) {
if ( ! is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">...</a>';
}
}
add_filter( 'intermediate_image_sizes_advanced', 'richardwhiteley_image_insert_override' );
function richardwhiteley_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
return $sizes;
}
add_action( 'widgets_init', 'richardwhiteley_widgets_init' );
function richardwhiteley_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'richardwhiteley' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'wp_head', 'richardwhiteley_pingback_header' );
function richardwhiteley_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'richardwhiteley_enqueue_comment_reply_script' );
function richardwhiteley_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function richardwhiteley_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter( 'get_comments_number', 'richardwhiteley_comment_count', 0 );
function richardwhiteley_comment_count( $count ) {
if ( ! is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

add_filter( 'image_size_names_choose', 'richardwhiteley_custom_sizes' );
 
function richardwhiteley_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'wide-thumbnail' => __( 'Wide Thumbnail' ),
    ) );
}

function richardwhiteley_allowed_block_types( $allowed_block_types ) {
    return array(
       'core/heading',
       'core/paragraph',
       'core/gallery',
       'core/image',
       'core/columns',
       'core/column'
    );
}
add_filter( 'allowed_block_types', 'richardwhiteley_allowed_block_types');




// function move_header_into_article_body($content) {
//     if ('post' != get_post_type()) {
//         return $content;
//     }

//     echo 'post';
//     // $pattern ="/<img(.*?)class=\"(.*?)\"(.*?)>/i";
//     // $replacement = '<img$1class="$2 newclass newclasstwo"$3>';
 
//     // $content = preg_replace($pattern, $replacement, $content);
 
//     // $pattern ="/<p(.*?)class=\"(.*?)\"(.*?)>/i";
//     // $replacement = '<p$1class="$2 newclass newclasstwo"$3>';
 
//     // $content = preg_replace($pattern, $replacement, $content);
 
//     $re = "/(<header>)(.*)(<\/header>)/";

//     // $re = "/(<header>((?:(?!<\\/header>).)*)<\\/title>\\s*<content>)((?:(?!<\\/content>).)*)/";
//     // $str = "<xml>\n <item>\n <title>Title 1</title>\n <content>Text 1</content>\n </item>\n <item>\n <title>Title 2</title>\n <content>Text 2</content>\n </item>\n</xml>";
//     $subst = "$1$2 $3";


//     // $re = "/(<title>((?:(?!<\\/title>).)*)<\\/title>\\s*<content>)((?:(?!<\\/content>).)*)/";
//     // $str = "<xml>\n <item>\n <title>Title 1</title>\n <content>Text 1</content>\n </item>\n <item>\n <title>Title 2</title>\n <content>Text 2</content>\n </item>\n</xml>";
//     // $subst = "$1$2 $3";

//     $result = preg_replace($re, $subst, $str);
 
//     return $content;
//  }
//  add_filter('the_content', 'move_header_into_article_body',11);