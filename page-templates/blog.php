<?php
/* Template Name: Blog page */
get_header();
$image_folder=get_stylesheet_directory_uri() . '/assets/images/';
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
    'paged' => $paged,
    'post_type' => 'post',
    'posts_per_page' => 9,
);

$posts = new WP_Query($args);

?>
<main class="blog-page-archive-category">
    <?php
    get_template_part('template-parts/blog/section','category',array(
        'active'=>0
        )
    );
    ?>
    <div class="container">
        <div class="row justify-content-center justify-content-md-start">
            <?php
            if ($posts->have_posts()){
                while ($posts->have_posts()){
                    $posts->the_post();
                    print blog_post_card_generator($post,"col-10 col-md-4 my-4");
                }
            }else{
                ?>
                <p>محتوایی یافت نشد.</p>
                <?php
            }
            ?>
        </div>
        <?php
        $prev_link = get_previous_posts_link();
        $next_link = get_next_posts_link();
        // as suggested in comments
            ?>
            <div class="pagination">
                <?php

                echo paginate_links([
                    'mid_size' => 3,
                    'prev_next' => true,
                    'type'     => 'list',
                    'prev_text'     => '<',
                    'next_text'     => '>',
                    'total' => $posts->max_num_pages,

                ]);
                ?>
            </div>
            <?php

        ?>
            <?php
            get_template_part('template-parts/blog/section','herlife',array(
                    'class'=>'herlife-bg-2'
                )
            );
            ?>

    </div>

</main>
<?php
get_footer();