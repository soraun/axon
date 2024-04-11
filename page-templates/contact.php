<?php get_header();
global $regex;
global $image_folder;
?>
<?php /* Template Name: Contact US */  ?>

<?php
$title = get_field('title');
?>

    <div class="title-faqs title-contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12 mx-auto">
                    <h1><?= get_the_title(); ?></h1>
                    <p class="mt-20"><?= get_field('subtitle') ?></p>
                    <div class=" mt-30 ">
                        <a class="primary-button btn " href="<?= get_field('faq_link') ?>"><?= get_field('faq_btn') ?></a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--
    <section class="teams-section">
        <div class="team-holder container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-12 mx-auto">
                        <div class="owl-carousel owl-theme team-carousels soran-carouse">
                            <?php while (have_rows('team_member')): the_row(); ?>
                                <?php
                                $name= get_sub_field('name');
                                $position= get_sub_field('position');
                                $text= get_sub_field('text');
                                $email= get_sub_field('email');
                                $team_face = get_sub_field('img');
                                $thumbnail_alt = get_post_meta ( $team_face, '_wp_attachment_image_alt', true );
                                if ($thumbnail_alt){}else{
                                    $thumbnail_alt=$title;
                                }
                                ?>
                                <div class="team-card">
                                    <div class="row">
                                        <div class="team-image-holder col-sm-12 col-xs-12 col-md-6">
                                            <img class="img-fluid" src="<?= $team_face ?>" alt="<?= $thumbnail_alt ?>">
                                        </div>
                                        <div class="team-body col-sm-12 col-xs-12 col-md-6">
                                            <div class="titles-team d-flex justify-content-start">
                                                <h3>معرفی اعضای تیم</h3>
                                                <h4><?= $name ?></h4>
                                                <span>•</span>
                                                <h4><?= $position ?></h4>
                                            </div>
                                            <p> <?= $text ?> </p>

                                            <a class="email-hoder" href="<?= $email ?>"><?= $email ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    -->
    <!--Contact Form section-->
    <section class="contact-form-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12 mx-auto">
                    <div class="form-title-holder">
                        <?= get_field('form_title') ?>
                    </div>
                    <div class="form-fields">
                        <form action="" id="contactForm">
                            <div class="form-details">
                                <div class="input-box">
                                    <span class="details">نام و نام خانوادگی</span>
                                    <input name="name" type="text" placeholder="اسم خود را وارد کنید ..." required>
                                </div>
                                <div class="input-box">
                                    <span class="details">ایمیل</span>
                                    <input name="email" id="email" type="text" placeholder="ایمیل خود را وارد کنید" required>
                                </div>
                                <div class="input-box">
                                    <span class="details">شماره تماس</span>
                                    <input name="phone" id="mobile" type="text" placeholder="شماره تماس خود را وارد کنید" required>
                                </div>
                                <div class="input-box">
                                    <span class="details">موضوع پیام</span>
                                    <input name="subject" type="text" placeholder="موضوع پیام خود را انتخاب کنید" required>
                                </div>
                                <div class="input-box-textarea">
                                    <span class="details">توضیحات اضافه</span>
                                    <textarea placeholder="توضیحات خود را وارد کنید..." name="text" id=""></textarea>
                                </div>
                            </div>
                            <div class="form-submit">
                                <!--                        <input type="submit" value="ثبت اطلاعات">-->
                                <button type="submit" id="contact_botton">ثبت اطلاعات</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--Contact Form section-->



<?php
get_footer();
?>