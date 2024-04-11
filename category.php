<?php
/* Template Name: Blog page */
get_header();
$image_folder=get_stylesheet_directory_uri() . '/assets/images/';

?>
    <main class="blog-page-archive-category">
        <?php
        $category=get_queried_object();
        get_template_part('template-parts/blog/section','category',array(
                'active'=>$category->term_id
            )
        );
        ?>
        <div class="container">
            <div class="row justify-content-center justify-content-md-start">
                <?php
                if (have_posts()){
                    while (have_posts()){
                        the_post();
                        print blog_post_card_generator($post,"col-10 col-md-4 my-4");
                    }
                }else{
                    ?>
                    <p class="mb-5 text-center">محتوایی یافت نشد.</p>
                    <?php
                }
                ?>
            </div>

            <?php
            $prev_link = get_previous_posts_link();
            $next_link = get_next_posts_link();
            // as suggested in comments
            if ($prev_link || $next_link) {
                ?>
                <div class="pagination">
                    <?php
                    global $wp_query;
                    $max = $wp_query->max_num_pages;
                    echo paginate_links([
                        'mid_size' => 3,
                        'prev_next' => true,
                        'type'     => 'list',
                        'prev_text'     => '<',
                        'next_text'     => '>',
                    ]);
                    ?>
                </div>
                <?php
            }
            ?>
        </div>

    </main>
<?php
get_footer();