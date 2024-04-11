<?php

$post_id = get_the_ID();

add_action( 'wp_ajax_load_search_results', 'load_search_results' );
add_action( 'wp_ajax_nopriv_load_search_results', 'load_search_results' );

function load_search_results() {
    $query =    $_POST['keyword'];
    $count ='3';
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        's' => $query,
        'posts_per_page' =>$count,
    );
    $search = new WP_Query( $args );
    ob_start();
    if ( $search->have_posts() ) :
        ?>
        <?php
        while ( $search->have_posts() ) : $search->the_post();
            ?>
            <div class="search-content">
                <a href="<?php echo get_permalink()?>" class="img-blog-wrap">
                    <?php echo get_the_post_thumbnail($post_id,'thumbnail')?>
                </a>
                <h3><a href="<?php echo get_permalink()?>"><?php echo get_the_title()?></a></h3>
            </div>
        <?php
        endwhile;
        wp_reset_query();
        $num_posts = $search->found_posts;
        if($num_posts>3){
            echo'<a href="'.get_bloginfo('url').'/?s='.esc_attr($query).' &post_type=post" class="button">مشاهده نتایج بیشتر</a>';
        };
    else :
        echo'<span class="no-result">';
        echo 'نتیجه ای یافت نشده است';
        echo'</span>';
    endif;
    $content = ob_get_clean();
    echo $content;
    die();

}