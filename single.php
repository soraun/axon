<?php
get_header();
$image_folder=get_stylesheet_directory_uri() . '/assets/images/';
global $regex;
gt_set_post_view();
?>
<input type="hidden" id="shortlink" value="<?php echo wp_get_shortlink(); ?>">
<div class="faq-container">
    <div class="container z-2 mt-lg-5 mt-20">
        <div class="row">
            <article>
                <?php
                if (have_posts()){
                while (have_posts()){
                the_post();
                $title=get_the_title($post->ID);
                $cats=get_the_terms($post->ID,"category");

                $thumbnail_id=get_post_thumbnail_id($post->ID);
                $thumbnail_alt = get_post_meta ( $thumbnail_id, '_wp_attachment_image_alt', true );
                if ($thumbnail_alt){}else{
                    $thumbnail_alt=$title;
                }
                $thumbnail_url = get_the_post_thumbnail_url($post->ID);
                $primary_term_id = yoast_get_primary_term_id( 'category',$post->ID);
                if ($primary_term_id){
                    $primary_cat = get_term($primary_term_id,"category");
                }else{
                    $terms=get_the_terms($post->ID,"category");
                    $primary_cat=$terms[0];
                }
                $permalink=get_the_permalink($post->ID);
                $date=get_the_date("j F Y",$post->ID);
                $tags=get_the_tags($post->ID);
                $reading_time=get_field("reading_time",$post->ID);
                ?>



                <div class="single-top-wrapper">
                    <div class="col-sm-12 col-xs-12 col-md-6 post-meta-wrapper">
                        <h1 class="post-title-entry"><?= $title ?></h1>
                        <span>دسته بندی:</span>
                        <a href="<?= get_term_link($primary_cat->term_id,'category') ?>" title="<?= $primary_cat->name ?>" class="single-category"><?= $primary_cat->name ?></a>
                        <div class="short-content"> <?php the_excerpt(); ?> </div>
                        <?php if ( wp_is_mobile() ) : ?>
                        <?php else : ?>
                            <div class="post-meta-holder">
                                <div class="post-reading-time col-md-10 d-flex justify-content-start">
                                    <p  class="post-time-holder d-flex align-items-center">
                                        <span>تاریخ انتشار: </span>
                                        <?= $date ?>
                                    </p>

                                    <p class="time-read-holder d-flex align-items-center ">
                                        <?php
                                        if ($reading_time){
                                            print $reading_time;
                                        }else{
                                            print round((prefix_wcount($post->ID)/1000)*8);
                                        }
                                        ?>
                                        <span> دقیقه مطالعه</span>
                                    </p>
                                </div>

                                <div class="post-share-icon col-md-2 d-flex justify-content-end">
                                    <div class="share-wrapper">
                                        <a class="share-link" href="#" title="" target="_self" data-title="<?= $title ?>" data-url="<?= $permalink ?>">
                                            <span class="share-icon"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-md-6 post-thumbnail-wrapper">
                        <img src="<?= $thumbnail_url ?>" class="w-100" alt="<?= $thumbnail_alt ?>">

                        <?php if ( wp_is_mobile() ) : ?>
                            <div class="post-meta-holder">
                                <div class="post-reading-time col-md-10 d-flex justify-content-start">
                                    <p  class="post-time-holder d-flex align-items-center">
                                        <span>تاریخ انتشار: </span>
                                        <?= $date ?>
                                    </p>

                                    <p class="time-read-holder d-flex align-items-center ">
                                        <?php
                                        if ($reading_time){
                                            print $reading_time;
                                        }else{
                                            print round((prefix_wcount($post->ID)/1000)*8);
                                        }
                                        ?>
                                        <span> دقیقه مطالعه</span>
                                    </p>
                                </div>

                                <div class="post-share-icon col-md-2 d-flex justify-content-end">
                                    <div class="share-wrapper">
                                        <a class="share-link" href="#" title="" target="_self" data-title="<?= $title ?>" data-url="<?= $permalink ?>">
                                            <span class="share-icon"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="content-body mt-60">
                    <div class="faq-content-bg"></div>
            <div class="container">
                <div class="row">
                    <?php
                    $headings=get_headings(get_the_content());
                    $col_class="col-md-12";

                    if ($headings){
                        $col_class="col-md-9";
                        ?>

                        <div class="col-md-3 container sticky-wrapper">
                            <div class="sticky-menu-content ">
                                <span class="sticky-menu-title">آنچه در این مقاله خواهید خواند</span>
                                <?php
                                echo do_shortcode("[TOC]");

                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="<?= $col_class ?> content-wrapper editor-content">
                        <?php the_content(); ?>
                        <?php
                        if ($tags){
                            ?>
                            <div class="tag-wrapper">
                                <h6>برچسب ها:</h6>
                                <div class="d-flex flex-wrap">
                                    <?php
                                    foreach ($tags as $tag){
                                        print '<a href="'.get_tag_link($tag->term_id).'" title="'.$tag->name.'">'.$tag->name.'</a>';
                                    }
                                    ?>
                                </div>
                            </div>

                            <?php
                        }
                        ?>
                    </div>

                </div>
        </div>

        <?php
        }
        }
        ?>
        </article>
    </div>

    <div class="comment-section">
        <div class="container">
            <?php
            comments_template();
            ?>
        </div>
    </div>
</div>
</div>

<?php
get_footer();
?>
