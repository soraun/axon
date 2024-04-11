<?php
global $image_folder;
$header_logo = get_field('logo','option');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <?php wp_head(); ?>
    <?php
    $codes_head = get_field('head_script','option');
    if ($codes_head != '') echo PHP_EOL.$codes_head.PHP_EOL;
    ?>
</head>
<body <?php body_class(); ?>>

<header class="sticky-header">

    <?php if ( wp_is_mobile() ) : ?>

        <!-- navbar Logo -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mybayby-top-nav-wrapper">
            <div class="container">
                <div class="d-flex justify-content-between align-items-baseline">
                    <button class="navbar-toggler" type="button" >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class=" collapse navbar-collapse mmobile" id="navbarNav">
                        <span class="close-menu"></span>
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'main-menu',
                            'menu_class' => 'navbar-nav',
                            'container'=>'ul',
                            'walker'=>'',
                            'link_after'=>'<span class="mobile-icon"></span>',
                        ));
                        ?>
                        <div class="mt-4">
<!--                            <div class="lang-switch">-->
<!--                                <a href="#">En</a>-->
<!--                            </div>-->

                            <div class="search-wrapper">
                                <form action="<?php echo get_home_url() ?>" class="search-form" method="get">
                                    <input id="search-text" type="search" name="s" placeholder="جستجو" autocomplete="off">
                                    <button type="submit" class="search-btn"></button>
                                    <input type="hidden" name="post_type" value="post">
                                    <div class="icons-wrapper">
                                        <div class="wrap">
                                            <i class="icon-close search-remove"></i>
                                        </div>
                                    </div>
                                </form>
                                <div class="search-results-box"></div>
                            </div>
                        </div>
                    </div>
                    <div class="logo-holder">
                        <a href="<?= get_home_url() ?>">
                            <img class="logo-image" src="<?= $image_folder ?>logo.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- navbar logo -->

        <!-- navbar menus-->
<!--        <nav class=" top-nav">-->
<!--            <div class="container">-->
<!--                <div class="top-nav-holder d-flex justify-content-between align-items-baseline">-->
<!--                   -->
<!--                </div>-->
<!--            </div>-->
<!--        </nav>-->
        <!-- navbar menus-->


    <?php else : ?>
        <!--<nav class="top-nav">
            <div class="container">
                <div class=" row align-items-center justify-content-between">
                    <div class="col-md-4 d-flex justify-content-start">
                        <ul>
                            <li><a href="#">En/Fa</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 d-flex justify-content-center">
                        <a href="<?= get_home_url() ?>">
                            <img src="<?= $image_folder ?>logo.svg" alt="">
                        </a>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <div class="search-wrapper">
                            <form action="<?php echo get_home_url() ?>" class="search-form" method="get">
                                <input id="search-text" type="search" name="s" placeholder="Search ..." autocomplete="off">
                                <button type="submit" class="search-btn"></button>
                                <input type="hidden" name="post_type" value="post">
                                <div class="icons-wrapper">
                                    <div class="wrap">
                                        <i class="icon-close search-remove"></i>
                                    </div>
                                </div>
                            </form>
                            <div class="search-results-box"></div>
                        </div>
                    </div>
                </div>
        </nav> -->

               <!-- navbar menus-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mybayby-top-nav-wrapper ">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="justify-content-between row collapse navbar-collapse" id="navbarNav">
                    <div class="col-md-2 d-flex justify-content-center">
                        <a href="<?= get_home_url() ?>">
                            <img class="mx-auto" style="width: 200px !important;" src="<?= $header_logo ?>" alt="لوگو">
                        </a>
                    </div>
                   <div class="col-md-8 d-flex align-items-center">
                       <?php
                       wp_nav_menu( array(
                           'theme_location' => 'main-menu',
                           'menu_class' => 'navbar-nav',
                           'container'=>'ul',
                           'walker'=>'',
                           'link_after'=>'<span class="mobile-icon"></span>',

                       ));
                       ?>
                   </div>
                    <div class="col-md-2 d-flex justify-content-evenly">
                        <a class="home-signin" href="">ورود</a>
                        <a class="home-signup" href="">ثبت نام</a>
                    </div>
                </div>
            </div>
        </nav><!-- navbar menus-->
    <?php endif; ?>

</header>


