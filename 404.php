<?php
get_header();

$text=get_field('text_404','option');
$img=get_field('img_404','option');
?>
<main>
    <div class="bg-404" style="background-image: url(<?php echo wp_get_attachment_image_url($img,'full')?>)"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 mx-auto mb-5">
                    <div class="content-404">
                        <span class="font-404">404</span>
                        <p><?php echo $text?></p>
                        <a href="<?php echo get_home_url(); ?>" class="btn primary-button" ><?= esc_html(' صفحه اصلی') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php get_footer();?>