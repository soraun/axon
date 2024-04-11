<?php
function soran_child_css() {
    wp_enqueue_style( 'persian-datepicker', get_stylesheet_directory_uri().'/assets/css/persian-datepicker.min.css'
    );
    wp_enqueue_style( 'child-style', get_stylesheet_uri()
    );
    wp_enqueue_style('flip', get_stylesheet_directory_uri() . '/assets/css/flip.min.css');
}
add_action( 'wp_enqueue_scripts', 'soran_child_css' ,99);


function soran_child_scripts(){

//    wp_enqueue_script(
//        'countdown',
//        get_stylesheet_directory_uri() . '/assets/js/jquery.countdown.min.js', time(), 'all'
//    );

    wp_enqueue_script(
        'persian-date',
        get_stylesheet_directory_uri() . '/assets/js/persian-date.min.js', time()
    );
    wp_enqueue_script(
        'persian-datepicker',
        get_stylesheet_directory_uri() . '/assets/js/persian-datepicker.min.js', time()
    );
    wp_enqueue_script(
        'flip',
        get_stylesheet_directory_uri() . '/assets/js/flip.min.js', time()
    );
    wp_enqueue_script(
        'childscripts',
        get_stylesheet_directory_uri() . '/assets/js/scripts.js', time(),123
    );



}
add_action('wp_footer', 'soran_child_scripts',11);



//post type
add_action('init', function() {
    register_post_type('product', [
        'label' => __('محصولات', 'soran'),
        'public' => true,
        'menu_position' => 5,
        'supports' => ['title', 'editor', 'thumbnail',],
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'product'],
//        'taxonomies' => ['product_category', 'product_category'],
        'labels' => [
            'singular_name' => __('محصول', 'soran'),
            'add_new_item' => __('افزودن محصول جدید', 'soran'),
            'new_item' => __('محصول جدید', 'soran'),
            'view_item' => __('مشاهده محصول', 'soran'),
            'not_found' => __('محصول یافت نشد', 'soran'),
            'not_found_in_trash' => __('محصولی یافت نشد', 'soran'),
            'all_items' => __('همه محصولات', 'soran'),
            'insert_into_item' => __('Insert into product', 'soran'),
            'add_new'=> __( 'افزودن محصول', 'text_domain' ),
            'rewrite' => array('slug' => 'category/%product%'),
        ],
    ]);

    register_taxonomy('product_cat','product', array(
        'hierarchical' =>true,
        'label'=> 'دسته محصولات',
        'Query_var'=>true,
        'rewire'=>true
    ));

    register_taxonomy('feature','product', array(
        'hierarchical' =>true,
        'label'=> 'ویژگی',
        'Query_var'=>true,
        'rewire'=>true
    ));

    function product_create_post_link( $post_link, $id = 0 ){
        $post = get_post($id);
        if ( is_object( $post ) ){
            $terms = wp_get_object_terms( $post->ID, 'product' );
        }
        return $post_link;
    }
    add_filter( 'post_type_link', 'product_create_post_link', 1, 3 );


});
$regex = <<<'END'
/
  (
    (?: [\x00-\x7F]                 # single-byte sequences   0xxxxxxx
    |   [\xC0-\xDF][\x80-\xBF]      # double-byte sequences   110xxxxx 10xxxxxx
    |   [\xE0-\xEF][\x80-\xBF]{2}   # triple-byte sequences   1110xxxx 10xxxxxx * 2
    |   [\xF0-\xF7][\x80-\xBF]{3}   # quadruple-byte sequence 11110xxx 10xxxxxx * 3 
    ){1,100}                        # ...one or more times
  )
| .                                 # anything else
/x
END;
global $regex;

$image_folder=get_stylesheet_directory_uri()."/assets/images/";
global $image_folder;

function wpb_custom_new_menu() {
    register_nav_menus(
        array(
            'main-menu' => __( 'منو اصلی' ),
            'footer-menu-1' => __( 'منو اول فوتر' ),
            'footer-menu-2' => __( 'منو دوم فوتر' )
        )
    );
}
add_action( 'init', 'wpb_custom_new_menu' );


function gt_set_post_view() {
    $key = 'post_views_count';
    $post_id = get_the_ID();
    $count = (int) get_post_meta( $post_id, $key, true );
    $count++;
    update_post_meta( $post_id, $key, $count );
}

function gt_get_post_view() {
    $count = get_post_meta( get_the_ID(), 'post_views_count', true );
    return "$count ";
}
function gt_posts_column_views( $columns ) {
    $columns['post_views'] = 'Views';
    return $columns;
}
function gt_posts_custom_column_views( $column ) {
    if ( $column === 'post_views') {
        echo gt_get_post_view();
    }
}
add_filter( 'manage_posts_columns', 'gt_posts_column_views' );
add_action( 'manage_posts_custom_column', 'gt_posts_custom_column_views' );

//Start Events Card Generator


//End Events Card Generator

function theme_archive_card_generator($post_id,$classes){
    global $regex;

    $title=get_the_title($post_id);
    $thumbnail_id=get_post_thumbnail_id($post_id);
    $thumbnail_alt = get_post_meta ( $thumbnail_id, '_wp_attachment_image_alt', true );
    if ($thumbnail_alt){}else{
        $thumbnail_alt=$title;
    }
    $thumbnail_url = get_the_post_thumbnail_url($post_id);
    $primary_term_id = yoast_get_primary_term_id( 'category',$post_id);
    if ($primary_term_id){
        $primary_cat = get_term($primary_term_id,"category");
    }else{
        $terms=get_the_terms($post_id,"category");
        $primary_cat=$terms[0];
    }
    $permalink=get_the_permalink($post_id);
    $date=get_the_date("j F Y",$post_id);


    $result='
    <div class="'.$classes.' blog-archive-card">
        <div class="image-wrapper">
            <a href="'.$permalink.'" title="'.$title.'" class="image-holder" style="background: url('.$thumbnail_url.') no-repeat center;background-size: cover">
            </a>
            <p class="card-category">'.$primary_cat->name.'</p>
        </div>
        <h2><a href="'.$permalink.'" title="'.$title.'" >'.$title.'</a></h2>
        
        <p>
            '.preg_replace($regex, "$1", substr(wp_strip_all_tags(strip_shortcodes(get_post_field("post_content",$post_id))),0,150)).'...
        </p>
        <p class="s-text">'.$date.'</p>
    </div>
    ';
    return $result;
}



function prefix_wcount($post_id){
    ob_start();
    print get_post_field('post_content', $post_id);;
    $content = ob_get_clean();
    $size=sizeof(explode(" ", $content));
    return $size;
}
// You can call the function as you like
if (!function_exists('mb_str_word_count'))
{
    function mb_str_word_count($string, $format = 0, $charlist = '[]') {
        mb_internal_encoding( 'UTF-8');
        mb_regex_encoding( 'UTF-8');

        $words = mb_split('[^\x{0600}-\x{06FF}]', $string);
        switch ($format) {
            case 0:
                return count($words);
                break;
            case 1:
            case 2:
                return $words;
                break;
            default:
                return $words;
                break;
        }
    };
}
add_filter( 'excerpt_length', function(){
    return 30;
} );
add_filter('excerpt_more', function($more) {
    return '...';
});


add_action('init', function() {
    register_post_type('newsletter', [
        'label' => __('خبرنامه', 'txtdomain'),
        'public' => true,
        'menu_position' => 10,
        'menu_icon' => 'dashicons-schedule',
        'supports' => ['title'],
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'newsletter'],
    ]);
});


//contact form
function create_posttype() {

    register_post_type( 'formentry',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'فرم ها' ),
                'singular_name' => __( 'form entry' )
            ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'formentry'),
            'show_in_rest' => true,

        )
    );
}
add_action( 'init', 'create_posttype' );



add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {

    // loop
    foreach( $items as &$item ) {

        // vars
        $mega_menu_img = get_field('mega_menu_img', $item);


        // append img
        if( $mega_menu_img ) {
            $title=$item->title;
            $item->title = '
            <div class="mega-menu-item " style="width: auto !important;">
                <img src="'.$mega_menu_img.'" alt="">
                <p>'.$title.'</p>
            </div>';

        }

    }


    // return
    return $items;

}
add_theme_support( 'title-tag' );


//Table of contents
function get_toc($content) {
    // get headlines
    $headings = get_headings($content);
    // parse toc
    ob_start();
    echo "<div class='table-of-contents'>";
    parse_toc($headings, 0, 0);
    echo "</div>";
    return ob_get_clean();
}
function parse_toc($headings, $index, $recursive_counter) {
    // prevent errors
    if($recursive_counter > 60 || !count($headings)) return;
    // get all needed elements
    $last_element = $index > 0 ? $headings[$index - 1] : NULL;
    $current_element = $headings[$index];
    $next_element = NULL;
    if($index < count($headings) && isset($headings[$index + 1])) {
        $next_element = $headings[$index + 1];
    }
    // end recursive calls
    if($current_element == NULL) return;
    // get all needed variables
    $tag = intval($headings[$index]["tag"]);
    $id = $headings[$index]["id"];
    $classes = isset($headings[$index]["classes"]) ? $headings[$index]["classes"] : array();
    $name = $headings[$index]["name"];
    // element not in toc
    if(isset($current_element["classes"]) && $current_element["classes"] && in_array("nitoc", $current_element["classes"])) {
        parse_toc($headings, $index + 1, $recursive_counter + 1);
        return;
    }
    // parse toc begin or toc subpart begin
    if($last_element == NULL || $last_element["tag"] < $tag) echo "<ul class='content-lists'>";
    // build li class
    $li_classes = "";
    if(isset($current_element["classes"]) && $current_element["classes"] && in_array("toc-bold", $current_element["classes"])) $li_classes = " class='bold'";
    // parse line begin
    echo "<li" . $li_classes .">";
    // only parse name, when li is not bold
    if(isset($current_element["classes"]) && $current_element["classes"] && in_array("toc-bold", $current_element["classes"])) {
        echo $name;
    } else {
        echo "<a href='#" . $id . "'>" . $name . "</a>";
    }
    if($next_element && intval($next_element["tag"]) > $tag) {
        parse_toc($headings, $index + 1, $recursive_counter + 1);
    }
    // parse line end
    echo "</li>";
    // parse next line
    if($next_element && intval($next_element["tag"]) == $tag) {
        parse_toc($headings, $index + 1, $recursive_counter + 1);
    }
    // parse toc end or toc subpart end
    if ($next_element == NULL || ($next_element && $next_element["tag"] < $tag)) {
        echo "</ul>";
        if ($next_element && $tag - intval($next_element["tag"]) >= 2) {
            echo "</li></ul>";
        }
    }
    // parse top subpart
    if($next_element != NULL && $next_element["tag"] < $tag) {
        parse_toc($headings, $index + 1, $recursive_counter + 1);
    }
}
function get_headings($content) {
    $headings = array();
    preg_match_all("/<h([1-6])(.*)>(.*)<\/h[1-6]>/", $content, $matches);

    for($i = 0; $i < count($matches[1]); $i++) {
        $headings[$i]["tag"] = $matches[1][$i];
        // get id
        $att_string = $matches[2][$i];
        preg_match("/id=\"([^\"]*)\"/", $att_string , $id_matches);
        $headings[$i]["id"] = $id_matches[1];
        // get classes
        $att_string = $matches[2][$i];
        preg_match_all("/class=\"([^\"]*)\"/", $att_string , $class_matches);
        for($j = 0; $j < count($class_matches[1]); $j++) {
            $headings[$i]["classes"] = explode(" ", $class_matches[1][$j]);
        }
        $headings[$i]["name"] = $matches[3][$i];
    }
    return $headings;
}
function toc_shortcode() {
    return get_toc(auto_id_headings(get_the_content()));
}
add_shortcode('TOC', 'toc_shortcode');


function auto_id_headings( $content ) {
//    $content = preg_replace_callback('/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i', function( $matches ) {
//        if(!stripos($matches[0], 'id=')) {
//            $matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title( $matches[3] ) . '">' . $matches[3] . $matches[4];
//        }
//        return $matches[0];
//    }, $content);
    $content = preg_replace_callback("/\<h([1-6])\>(.*?)\<\/h([1-6])\>/", function ($matches) {
        static $i = 1;
        $hTag = $matches[1];
        $title = $matches[2];
        return '<h' . $hTag . ' id="section-' . $i++ . '">' . $title . '</h' . $hTag . '>';
    }, $content);
    return $content;
}
add_filter('the_content', 'auto_id_headings');

/**
 * FAQ without category Schema Function
 **/

if (!function_exists('faq_schema')) {

    function faq_schema($term = null) {
        $faqs = get_field('faqs');
//        if ($term != null){
//            $faqs = get_field('faqs',$term);
//        }
        if ($faqs != null) {

            $count_faq = count($faqs);

            echo'<script type="application/ld+json">

			{

			  "@context": "https://schema.org",

			  "@type": "FAQPage",

			  "mainEntity": [';

            $i = 0;

            foreach ($faqs as $key => $val) {
                $i++;
                echo'{

				"@type": "Question",

				"name": "'.$val['question'].'",

				"acceptedAnswer": {

				  "@type": "Answer",

				  "text": "'.str_replace('"', '\'', strip_tags(trim($val['answer']), '<a><p><ul><li><b><ol>')).'"
				}
			  } ';

                if ($i != $count_faq) echo ',';
            }
            echo']
			}
            </script>';

        }

    }

}
if( ! function_exists( 'better_commets' ) ):
    function better_commets($comment, $args, $depth) {
        $additional_comment_classes = '';

        if ( user_can( $comment->user_id, 'administrator' ) ) {
            $additional_comment_classes = "class='byadmin'";
        }
        ?>
    <li <?php echo $additional_comment_classes; ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment_container">
            <div class="head-comment comment-author-wrapper">
                <span class="name_comment"><i class="icon-user"></i><?php comment_author(); ?></span>
                <span class="time_comment"><i class="icon-calender"></i><?php echo get_comment_date('Y/m/d'); ?></span>
            </div>
            <div class="comment-content">
                <div class="editor-content">
                    <?php echo comment_text(); ?>
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                        <em class="comment-awaiting-moderation waiting_pm"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
                    <?php endif; ?>
                </div>
                <div class="buttom-comment">
                    <?php comment_reply_link(array_merge( $args, array('reply_text' => "  پاسخ<i class='icon-reply'></i>", 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
            </div>
        </div>

        <?php
    }
endif;

/**
 * Move Textarea Comment to End of Form
 **/
function wpb_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );
/**
 * Enqueue JS Ajax Form Comment
 **/
function mytheme_enqueue_comment_reply(){
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_comment_reply');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
/**
 * Convert Input Submit To Button Submit
 **/
function awesome_comment_form_submit_button($button) {
    $button = "<button id='submit' class='button'>ثبت نظر</button>";
    return $button;
}
add_filter('comment_form_submit_button', 'awesome_comment_form_submit_button');

add_filter('gform_submit_button', 'form_submit_button', 10, 2);
function form_submit_button($button, $form){
    return "<button class='button gform_button' id='gform_submit_button_{$form['id']}'><span>" . $form['button']['text'] . "</span></button>";
}
/**
 * Remove Comment Cookies
 **/
remove_action( 'set_comment_cookies', 'wp_set_comment_cookies' );
function ocean_custom_comment_title( $defaults ){
    $defaults['title_reply'] = __('نظر خود را ثبت کنید', 'oceanwp');
    return $defaults;
}
add_filter('comment_form_defaults', 'ocean_custom_comment_title', 20);




