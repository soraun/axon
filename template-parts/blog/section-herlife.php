<?php
$herlife_items=get_field("herlife_items","option");
$herlife_btns=get_field("herlife_btns","option");
?>

<section class="section-wrap section-base section-feature2 <?= $args['class']; ?>" id="feature2">
    <div class="container">
        <div class="row mx-auto">
            <div class="col-lg-9 col-md-8 col-12 mx-auto mb-lg-5 mb-2 order-md-1 order-2">
                <div class="row mx-auto feature-row">
                    <div class="col-lg-8 feature-col">
                        <div class="feature-wrap fadeInRight wow">
                            <div>
                                <?php
                                $j=0;
                                $i=1;
                                foreach($herlife_items as $item){
                                    $title= $item['title'];
                                    ?>
                                    <div class="feature-content editor-content main-content "  id="item_<?php echo $i?>">
                                        <h4><?php echo $item['title']?></h4>
                                        <p class="mt-4"><?php echo $item['desc']?></p>
                                    </div>

                                    <?php
                                    $j=+0.2;
                                    $i++;
                                }
                                ?>
                                <div class="d-flex align-items-center mt-md-5 mt-3">
                                    <?php
                                    if ($herlife_btns){
                                        foreach ($herlife_btns as $herlife_btn){
                                            ?>
                                            <a href="<?= $herlife_btn["link"] ?>" class="btn w-100 <?= $herlife_btn["type"] ?>"><?= $herlife_btn["text"] ?></a>
                                            <?php
                                        }
                                    }

                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12 mx-auto order-md-2 order-1  fadeInLeft wow ">
                <div class="herlife-owl-wrapper">
                    <div class="owl-carousel feature-owl" >
                        <?php
                        $j=0;
                        $i=1;
                        foreach($herlife_items as $item){
                            $title= $item['title'];
                            $thumbnail_id=get_post_thumbnail_id($item['img']);
                            $thumbnail_alt = get_post_meta ( $thumbnail_id, '_wp_attachment_image_alt', true );
                            if ($thumbnail_alt){}else{
                                $thumbnail_alt=$title;
                            }
                            ?>
                            <div class="feature-img "  data-id="item_<?php echo $i?>">
                                <img src="<?= wp_get_attachment_url($item['img']) ?>" class="w-100" alt="<?= $thumbnail_alt ?>">
                            </div>
                            <?php
                            $j=+0.2;
                            $i++;
                        }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>