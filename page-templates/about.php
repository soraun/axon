<?php get_header();
global $regex;
global $image_folder;
$show_upcomingEvent = get_field('show_upcomingEvent');
$content_about = get_field('about_content');
 /* Template Name: About US */
?>

<!--About header section start-->
<?php if(wp_is_mobile()){?>
    <section class="about-header">
        <div class="container">
            <div class="row">
                <div class="about-body">
                    <h1><?= get_the_title(); ?></h1>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
         <div class="about-description-top mt-20"><?= get_field('about_header_text') ?></div>
    </div>
<?php
}else{?>
<section class="about-header">
    <div class="container">
        <div class="row">
        <div style="display: flex; justify-content: center">
            <div class="about-body d-flex justify-content-center flex-column" style="width: 60%">
                <h1 class="start-tagline"><?= get_the_title(); ?></h1>
                <p><?= get_field('about_exc') ?></p>
                <div class="mt-20"><?= get_field('about_header_text') ?></div>
            </div>
            <div class="about-body-image d-flex justify-content-center align-items-center" style="width: 40%">
                <img style="width: 60%" src="<?= get_field('about_us_img'); ?>" alt="درباره ما">
            </div>
        </div>
        </div>
    </div>
</section>
<?php }?>
<!--About header section End-->

<!--<About Section Start-->
<?php if($content_about){
    $i = 1;

    foreach ($content_about as $item){
        if($i%2==0){
            $order = 'flex-row-reverse';
        }else{
            $order = 'flex-row';
        }
        echo '<section class="csr-section about-section-content">
                <div class="container">
                    <div class="row '.$order.'">
                        <div class="csr-cover col-sm-12 col-xs-12 col-md-6 text-center">
                            <img style="width: auto; height: 350px;" src="'.$item['content_img'].'" alt=" ">
                        </div>
                        <div class="csr-body col-sm-12 col-xs-12 col-md-6">
                            <h2>'.$item['content_title'].'</h2>
                            <div class="mt-20">'.$item['content_text'].'</div>';
                        echo'</div>
                    </div>
                </div>
            </section>';
        $i++;
    }
}?>
<!--<About Section End-->



    <section class="container-fluid mt-70">
        <div class="container">
            <div class="col-12 d-flex flex-column align-items-start btn-title-wrapper">

            </div>

            <div class="mt-40 delay02 owl-carousel owl-theme article-carousel">
                <?php while (have_rows('certificates')): the_row(); ?>
                    <?php
                    $img = get_sub_field('certificate_img');
                    $thumbnail_alt = get_post_meta ( $img, '_wp_attachment_image_alt', true );
                    ?>
                    <div class="certificate-box">
                            <img class="img-fluid" src="<?= $img ?>" alt="<?=   $thumbnail_alt ?>">
                            <span><?= get_sub_field('certificate_name') ?></span>
                    </div>
                <?php endwhile;?>
            </div>
        </div>
    </section>



<!--<About CTA Section Start-->
<section class="mt-40 mb-5">
    <div class=" container">
        <div class="support-section ">
            <div class="row">
                <div class="support-title col-sm-12 col-xs-12 col-md-6">
                    <h2><?= get_field('help_title') ?></h2>
                </div>
                <div class="support-btns col-sm-12 col-xs-12 col-md-6">
                    <a class="primary-button" href="<?= get_field('about_contact_url') ?>"><?= get_field('about_contact_btn') ?></a>
                    <a class="secondary-button" href="<?= get_field('about_faq_url') ?>"><?= get_field('about_faq_btn') ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--<About CTA Section End-->


<?php
get_footer();
?>