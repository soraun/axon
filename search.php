<?php
get_header();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
$query =$_GET['s'] ;
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    's' => $query,
    'paged' => $paged,
);

$search = new WP_Query( $args );
if ( $search->have_posts() ) {
?>
<main>
    <div class="container">
        <div class="title-section title-contact mt-4">
            <h2 class="page-title mx-auto ">
                <?php printf(esc_html__( 'نتایج جستجو  "%s"', 'mylady' ),'<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>');?>
            </h2>
        </div>
        <div class="container">
            <div class="row">
                <?php
                // Start the Loop.
                while ( $search->have_posts() ) : $search->the_post();
                    print blog_post_card_generator($post,"col-md-4 my-4");

                endwhile;
                wp_reset_query();

                } else {
                    echo'<span class="not-found">';
                   ?>
                    <div class="lady-alert lady-danger my-5">
                        <p>مقاله ای با فیلتر مورد نظر شما یافت نشد</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn primary-button mt-3"  href="<?php get_home_url()?>/blog">مشاهده همه مقالات</a>
                        </div>
                    </div>
                <?php
                    echo'</span>';
                }
                echo'<div class="col-12 mx-auto">';
                echo soran_pagination();
                echo'</div>';
                ?>
            </div>
        </div>
    </div>

</main>
<?php
get_footer();
?>
