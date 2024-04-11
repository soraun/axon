<?php
get_header();
global $regex;
$img_folder = get_stylesheet_directory_uri() . "/assets/images/";
$term = get_queried_object();

$cat_img = get_field('main_img', 'product_cat_' . $term->term_id);
$related_blogs = get_field("related_blogs", 'product_cat_' . $term->term_id);
$related_blog_title = get_field("related_blog_title", 'product_cat_' . $term->term_id);

?>
    <main class="product-category-page pt-5">
        <div class="container">
            <div class="row category-description">
                <div class="col-lg-6 col-12 order-lg-1 order-2">
                    <h1>محصولات <?= $term->name ?></h1>
                    <p><?= $term->description ?></p>
                </div>
                <div class="col-lg-6 col-12 order-lg-2 order-1">
                    <img class="w-100" src="<?= $cat_img ?>" alt="<?= $term->name ?>">
                </div>
            </div>
        </div>
        <div class="container product-category-wrapper">
            <div class="d-flex justify-content-center align-items-center product-wrap-mds">
                <?php
                if (have_posts()) {
                    $i=1;
                    while (have_posts()) {
                        the_post();
                        $product_thumbnail = get_the_post_thumbnail_url($post->ID);
                        $product_title = get_the_title($post->ID);
                        ?>
                        <div class="product-item" data-id="single_product_<?= $post->ID ?>">
                            <div class="product-item-img"
                                 style="background: url(<?= $product_thumbnail ?>) center no-repeat;">
                            </div>
                            <p><?= $product_title ?></p>
                        </div>
                        <?php
                        $i++;
                        if ($i==4){
                            ?>
            </div>
            <div class="d-flex justify-content-center align-items-center product-wrap-mds">
                                <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
        <div class="container" id="productItemWrapper">
            <?php
            if (have_posts()) {
                $j = 1;
                while (have_posts()) {
                    the_post();
                    $product_thumbnail = get_the_post_thumbnail_url($post->ID);
                    $product_title = get_the_title($post->ID);
                    $product_gallery = get_field("gallery", $post->ID);
                    $detail_img = get_field("detail_img", $post->ID);
                    $details = get_field("details", $post->ID);
                    $active_class = "";
                    $p_id = $_GET["p_id"];
                    if ($p_id) {
                        if ($p_id == $post->ID) {
                            $active_class = "active";
                        }
                    } else {
                        if ($j == 1) {
                            $active_class = "active";
                        }
                    }
                    ?>
                    <div class="single-product-detail <?= $active_class ?>" id="single_product_<?= $post->ID ?>">
                        <div class="row">
                            <div class="col-lg-6 col-12 order-1">
                                <div>
                                    <img class="w-100 product-single-img" src="<?= $product_gallery[0]; ?>"
                                         id="product_<?= $post->ID ?>_img" alt="">
                                </div>


                                <div class="owl-carousel owl-theme product-gallery-carousel">
                                    <?php
                                    foreach ($product_gallery as $item) {
                                        print '
                                <div class="item">
                                    <div class="gallery-item" data-src="' . $item . '" data-id="product_' . $post->ID . '_img" style="background: url(' . $item . ') center no-repeat;background-size: cover;"></div>
                                </div>
                                     ';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 order-2">
                                <h2><?= $product_title ?></h2>
                                <div class="mt-3">
                                    <?php
                                    the_content();
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-5 mt-3 order-md-3 order-4">
                                <?php
                                the_field("detail_content", $post->ID);
                                ?>
                            </div>
                            <div class="col-md-6 position-relative  mt-5  order-md-4 order-3">
                                <img src="<?= $detail_img; ?>" class="w-100 detail-img" alt="">
                                <?php
                                $i = 0;
                                foreach ($details as $detail) {
                                    print '
                                <div class="detail-desc-pin" data-id="product_' . $post->ID . '_' . $i . '" style="right:' . $detail["right"] . '%;top:' . $detail["top"] . '%; ">+</div>
                                <div class="detail-desc" id="product_' . $post->ID . '_' . $i . '" style="right:' . $detail["right"] . '%;top:calc(' . $detail["top"] . '% + 30px); ">
                                    <h6><span></span>' . $detail["title"] . '</h6>
                                    <p>' . $detail["description"] . '</p>
                                </div>
                                ';
                                    $i++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $j++;
                }

            }
            ?>
        </div>
        <?php
        if ($related_blogs) {
            ?>
            <div class="container category-page-related-blog">
                <h4 class="related_blog_title"><?= $related_blog_title ?></h4>

                <?php
                print blog_carousel_generator($related_blogs);
                ?>
            </div>
            <?php
        }
        ?>
    </main>
<?php
get_footer();
