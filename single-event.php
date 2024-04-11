<?php
get_header();
?>
<main>
    <?php
    if (have_posts()){
        while (have_posts()){
            the_post();
            $event_status=get_field("event_status",$post->ID);
            if ($event_status==1){
                get_template_part('template-parts/events/event','finished');
            }else if ($event_status==0){
                get_template_part('template-parts/events/event','active');
            }else if ($event_status==2){
                get_template_part('template-parts/events/event','group');
            }else if ($event_status==3){
                get_template_part('template-parts/events/event','text');
            }
            ?>
            <?php
        }
    }

    ?>

</main>
    <div class="modal fade " id="eventVideoModal" tabindex="-1" aria-labelledby="eventVideoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="presenter-row mt-0 px-4">
                        <h5></h5>
                        <h6></h6>
                    </div>
                    <div class="modal-video-wrapper">
                        <video id="modalVideo" controls preload="none">
                            <source src="">
                        </video>
                    </div>
                    <div class="modal-iframe-wrapper" style="display: none;">

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();