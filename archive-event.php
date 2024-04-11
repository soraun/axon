<?php
get_header();
?>

<main class="event-archive-page">
    <div class="container">
        <div class="event-archive-page-title-wrapper">
            <h1>رویداد های پیشین</h1>
        </div>
        <div class="row justify-content-center justify-content-md-start">
            <?php
                if (have_posts()){
                    while (have_posts()){
                        the_post();
                        print event_card_generator($post->ID,"col-md-4 my-4 event-card-archive");
                    }
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
