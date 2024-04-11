<?php

function blog_carousel_generator($posts){
    global $regex;
     $result='<div class="owl-carousel owl-theme soran-carouse blog-carousels desktop-carousel scrollable-category row">';
     foreach ($posts as $post){

         $date=get_the_date("Y/m/d",$post->ID);
         $reading_time=get_field("reading_time",$post->ID);


        $result.='<div class="all-posts">';

         if ( wp_is_mobile() ) :
             $result.='
                <div>
                    <a href="'.get_the_permalink($post->ID).'" class="post-card  ">
                        <div class="article-inner">
                            <img class="image-holder img-fluid" src="'.get_the_post_thumbnail_url($post->ID).'" >
                        </div>
                    </a>
                    <a href="'.get_the_permalink($post->ID).'"><h4 class="post-title">'.get_the_title($post->ID).'</h4></a>
                </div>
                <div class="article-body-container" >
                    
                    <div class="post-meta-mobile">
                        <span class="d-flex align-items-center date-posted" id="date-posted">
                            '.$date.'
                        </span>
                        <span>|</span>
                        <span class="d-flex align-items-center reading-time" id="reading-time">';

                             if ($reading_time){
                                 $result.= $reading_time;
                             }else{
                                 $result.= round((prefix_wcount($post->ID)/1000)*8);
                             }
                            $result.=' دقیقه
                        </span>
                    </div>
                </div>';

        else :
            $result.='
                <div class="post-card px-3">
                    <div class="">
                        <div class="article-inner">
                            <img class="image-holder img-fluid" src="'.get_the_post_thumbnail_url($post->ID).'">

                        </div>
                    </div>
                </div>
                <div class="article-body-container  px-3" >
                                    <a href="'.get_the_permalink($post->ID).'"><h2 class="post-title">'.get_the_title($post->ID).'</h2></a> 
                           
                </div>';

            endif;

         $result.=' </div>';


     }
    $result.='</div>';
    return $result;

}





function blog_post_card_generator($post,$class=""){
    global $regex;

    $date=get_the_date("Y/m/d",$post->ID);
    $reading_time=get_field("reading_time",$post->ID);


    $result='<div class="all-posts blog-card '.$class.'">';

    if ( wp_is_mobile() ) :
        $result.='
                <div>
                    <a href="'.get_the_permalink($post->ID).'" class="post-card  ">
                        <div class="article-inner">
                            <img class="image-holder img-fluid" src="'.get_the_post_thumbnail_url($post->ID).'" >
                        </div>
                    </a>
                    <a href="'.get_the_permalink($post->ID).'"><h4 class="post-title">'.get_the_title($post->ID).'</h4></a>
                </div>
                <div class="article-body-container" >
                    
                    <div class="post-meta-mobile">
                        <span class="d-flex align-items-center date-posted" id="date-posted">
                            '.$date.'
                        </span>
                        <span>|</span>
                        <span class="d-flex align-items-center reading-time" id="reading-time">';

        if ($reading_time){
            $result.= $reading_time;
        }else{
            $result.= round((prefix_wcount($post->ID)/1000)*8);
        }
        $result.=' دقیقه
                        </span>
                    </div>
                </div>';

    else :
        $result.='
                <div class="post-card px-3">
                    <div class="">
                        <div class="article-inner">
                            <img class="image-holder img-fluid" src="'.get_the_post_thumbnail_url($post->ID).'">
                            <a href="'.get_the_permalink($post->ID).'" class="cover w-100">
                                <div class="post-meta">
                                    <span class="d-flex align-items-center reading-time" id="reading-time">';

        if ($reading_time){
            $result.= $reading_time;
        }else{
            $result.= round((prefix_wcount($post->ID)/1000)*8);
        }

        $result.=' دقیقه
                                        </span>
                                        <span class="d-flex align-items-center date-posted" id="date-posted">';
        $result.= $date;
        $result.='
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <a href="'.get_the_permalink($post->ID).'"><h2 class="post-title">'.get_the_title($post->ID).'</h2></a>
                </div>
                <div class="article-body-container  px-3" >
                    <p>'.get_the_excerpt($post->ID).'</p>
                    <a href="'.get_the_permalink($post->ID).'"><div class="blog-link">ادامه مطلب ></div></a>
                </div>';

    endif;

    $result.=' </div>';

    return $result;

}
function archive_products_card($post_id,$class=""){
    $category=get_the_terms($post_id,"product_cat");
    $permalink=get_term_link($category[0]->term_id)."?p_id=".$post_id;
    $title=get_the_title($post_id);
    $second_thumb=get_field("second_thumbnail",$post_id);
    $third_thumbnail=get_field("third_thumbnail",$post_id);
    if ($third_thumbnail){}else{
        $third_thumbnail=$second_thumb;
    }


    $result='<a href="'.$permalink.'" class="col-md-4 col-6 product-archive-card '.$class.'" title="'.$title.'">
        <div class="product-archive-card-image-wrapper">
            <img class="w-100 second-thumb" src="'.$second_thumb.'" alt="'.$title.'">
            <img class="w-100 third-thumb" src="'.$third_thumbnail.'" alt="'.$title.'">
        </div>
        <div>
            <p class="product-title-card text-center">'.$title.'</p>
        </div>
    </a>';
    return $result;

}
function event_carousel_generator($events){
    global $regex;
    $result="";
    $result.='<div class="owl-carousel owl-theme event-carousel soran-carouse desktop-carousel scrollable-category">';

    foreach ($events as $event){
        $result.= event_card_generator($event);
    }

    $result.='</div>';
    return $result;
}
function event_card_generator($event,$class=''){
    global $regex;
    $link=get_the_permalink($event->ID);
    $thumbnail_id=get_post_thumbnail_id($event->ID);
    $title=get_the_title($event->ID);
    if(get_the_excerpt($event)){
        $events_list = get_the_excerpt($event);
    }else{
        $events_list  = get_post_field("post_content",$event);
    }

    $thumbnail_alt = get_post_meta ( $thumbnail_id, '_wp_attachment_image_alt', true );
    if ($thumbnail_alt){}else{
        $thumbnail_alt=$title;
    }
    $events_excerpt=preg_replace($regex, "$1", substr(wp_strip_all_tags(strip_shortcodes($events_list)),0,180));

    $result=' 
                                                         
                <div class="upcoming-event-item '.$class.'">
                    <a href="'.get_the_permalink($event).'" class="events-wrapper-over-click"> 
                        <div class="event-card">
                                <img src="'.wp_get_attachment_url($thumbnail_id).'" alt="'.$thumbnail_alt.'">
                            <div class="event_image_overlay image_event_overlay--primary">
                                <div class="event__title">
                                    <p class="event-description">
                                        '.$events_excerpt.'
                                    </p>                               
                                    <span class="tertiary-btn mb-3">
                                    اطلاعات بیشتر   
                                    </span>
                                </div>
                            </div>         
                        </div>
                    </a> 
                    <a class="d-flex justify-content-center events-title" href="'.$link.'" title="'.$title.'">
                        '.$title.'
                    </a>
                </div>
                ';
    return $result;
}

function upComingEvent($event=null){

    if ($event){
        $active_event=$event;
    }else{
        $active_event = get_field('active_event','option');
    }
    $title = get_field('title_timer',$active_event);
    $desc = get_field('desc_timer',$active_event);
    $event_status = get_field('event_status',$active_event);
    $event_time = new DateTime( get_field('event_time',$active_event));
    $event_date_jalali=explode("-",$event_time->format('Y-m-d'));
    $event_date_georgian=jalali_to_gregorian($event_date_jalali[0],$event_date_jalali[1],$event_date_jalali[2]);
    $event_date_georgian=implode("-",$event_date_georgian);
    $event_date_georgian=$event_date_georgian." ".$event_time->format('H:i:s');
    $date_2 = new DateTime($event_date_georgian,new DateTimeZone('Asia/Tehran'));

    echo'<section class="mt-60">';
        if ($active_event){
            if (has_excerpt($active_event)){
                $active_event_excerpt=get_the_excerpt($active_event);
            }else{
                $active_event_excerpt=get_post_field("post_content",$active_event);
            }
            $active_event_title=get_the_title($active_event);
            $active_event_img=get_the_post_thumbnail_url($active_event);

            if(wp_is_mobile()){
                $logo = get_field('mobile_logo',$active_event);
            }else{
                $logo= get_field('desktop_logo',$active_event);
            }
            echo'<div class="container">';
                echo'<div class="upcoming-event">';
                    echo' <input type="hidden" id="time_event" value="'.$date_2->format('Y.m.d.H.i.s').'">';
                    echo'<div class="row">';
                        echo'<div class="col-md-6">';
                        if(wp_is_mobile()){
                            echo'<div class="upcoming-title">';
                            echo     wp_get_attachment_image($logo,'full');
                            echo '</div>';
                        }
                        echo'<img src="'.$active_event_img.'" class="w-100" alt="pattern background">';
                        echo'</div>';
                        echo'<div class="col-md-6">';
                        if(!wp_is_mobile()){
                            echo'<div class="upcoming-title">';
                            echo     wp_get_attachment_image($logo,'full');
                            echo '</div>';
                        }
                        echo'<P>'.$active_event_excerpt.'</P>';
                        if($event_status == 0){
                            echo'<div class="countDown-wrap">
                                    <div class="title-countDown-wrap">
                                        <div class="title-countDown">'.$title.'</div>
                                        <p class="desc-countDown">'.$desc.'</p>
                                    </div>
                                    <div class="countDown-timer">
                                         <div class="tick" data-did-init="handleTickInit">
                                            <div data-repeat="true" data-layout="horizontal center fit" data-transform="preset(d, h, m, s) -> delay">
                                                <div class="tick-group">
                                                    <div data-key="value" data-repeat="true" data-transform="pad(00) -> split -> delay">
                                                        <span data-view="flip"></span>
                                                    </div>
                                                    <span data-key="label" data-view="text" class="tick-label"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            }
                            echo'<div class="upcoming-btn d-flex justify-content-center mt-30">';
                                if ($event_status == 0){
                                    echo' <div class="btn-wrap"><a href="#"  id="registerModal" data-id="'.$active_event->ID.'" class="btn primary-button w-100" title="ثبت نام در رویداد">ثبت نام در رویداد</a>';
                                    echo' <a href="'.get_the_permalink($active_event).'" class="btn secondary-button w-100" title="اطلاعات بیشتر">اطلاعات بیشتر</a></div>';
                                }else{
                                    echo' <a href="'.get_the_permalink($active_event).'" class="btn secondary-button w-100" title="اطلاعات بیشتر">اطلاعات بیشتر</a>';
                                }
                            echo'</div>';
                        echo'</div>';
                    echo'</div>';
                echo'</div>';
            echo'</div>';
    }
    echo'</section>';
}
if (!function_exists('soran_pagination')){
    function soran_pagination($query = null){
        $args = array(
            'type' => 'list',
            'prev_text' => "<i class='icon-arrow-left'></i>" ,
            'next_text' => "<i class='icon-arrow-right'></i>" ,
        );
        if ($query != '') $args['total'] = $query->max_num_pages;
        echo paginate_links($args);
    }
}
//vending request
//reuest post type
/* Create Post type  */

/**
 * Request export.
 */
add_action('admin_footer', 'company_request_export_button');
function company_request_export_button(){
    $screen = get_current_screen();
    if($screen->id == "edit-request"){
        ?>
        <script type="text/javascript">
            jQuery(document).ready( function($){
                jQuery('.tablenav.top .clear, .tablenav.bottom .clear').before('<form action="#" method="POST" id="request-export-form"> <input type="hidden" name="request-export-csv" id="request-export-csv" value="1"/> <input type="submit" class="button button-primary" value="خروجی csv"/> </form>');
            });
        </script>
        <?php
    }
}

add_action('admin_init', 'company_request_export_action');
function company_request_export_action(){
    if(isset($_POST['request-export-csv'])){
        if(current_user_can('manage_options')){

            $csv_fields = array();
            $csv_fields[] = 'تعداد';
            $csv_fields[] = 'ایمیل';

            $output_filename = 'request_export_'.date('YmdHis').'.csv';
            $output_handle = @fopen( 'php://output', 'w' );

            header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
            header( 'Content-Description: File Transfer' );
            header( 'Content-type: text/csv' );
            header( 'Content-type: text/csv; charset=utf-8' );
            header( 'Content-Encoding: UTF-8');
            header('Content-Transfer-Encoding: binary');
            header( 'Content-Disposition: attachment; filename=' . $output_filename );
            header( 'Expires: 0' );
            header( 'Pragma: public' );
            echo "\xEF\xBB\xBF"; // UTF-8 BOM
            // Insert header row
            fputcsv( $output_handle, $csv_fields );


            $args = array();
            $args['post_type'] = 'request';
            $args['posts_per_page'] = -1;
            $requests = new WP_Query( $args );
            if($requests->have_posts()): while($requests->have_posts()): $requests->the_post();
                $leadArray = array();

                $email = get_post_meta(get_the_ID(),'email',true);

                $leadArray[] = get_the_title();
                $leadArray[] = esc_html($email);

                fputcsv($output_handle, $leadArray);
            endwhile; endif; wp_reset_postdata();

            fclose( $output_handle );
            die();
        }
    }
}


//sign up event form
function signupEvent(){
    echo'<div class="modal fade"  id="eventSignUp" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="title-request">
                            <h5>ثبت نام در وبینار</h5>
                            <i class="icon-close"></i>
                        </div>
                        <form action="post" id="formEventSignup">
                             <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="field-col">
                                            <label for="name">نام و نام خانوادگی</label>
                                            <input type="text" id="name" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="field-col">
                                            <label for="phone">شماره تماس</label>
                                             <input type="text" id="phone" name="phone" required> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="field-col">
                                            <label for="brithdate">تاریخ تولد</label>
                                             <input type="text" id="brithdate" name="brithdate" required> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="field-col">
                                            <label for="city">شهر</label>
                                             <input type="text" id="city" name="city"> 
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="field-col">
                                            <div class="button-vending">
                                                <input class="primary-button" type="submit" id="eventSignUp_submission" value="ثبت اطلاعات">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>';
}



function mail_generator($title,$message){
    $mail='
    <!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Mylady</title>
    <style>
      /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      
      /*All the styling goes here*/
      
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; 
      }

      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; 
        direction: rtl;
        text-align: right;
      }

      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; 
      }

      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */

      .body {
        background-color: #f6f6f6;
        width: 100%; 
      }

      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px; 
      }

      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        margin: 0 auto;
        max-width: 580px;
        padding: 10px; 
      }

      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%; 
      }

      .wrapper {
        box-sizing: border-box;
        padding: 20px; 
      }

      .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
      }

      .footer {
        clear: both;
        margin-top: 10px;
        text-align: center;
        width: 100%; 
      }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; 
      }

      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        margin-bottom: 30px; 
      }

      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; 
      }

      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        margin-bottom: 15px; 
      }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; 
      }

      a {
        color: #3498db;
        text-decoration: underline; 
      }

      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; 
      }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; 
      }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; 
      }

      .btn-primary table td {
        background-color: #3498db; 
      }

      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; 
      }

      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; 
      }

      .first {
        margin-top: 0; 
      }

      .align-center {
        text-align: center; 
      }

      .align-right {
        text-align: right; 
      }

      .align-left {
        text-align: left; 
      }

      .clear {
        clear: both; 
      }

      .mt0 {
        margin-top: 0; 
      }

      .mb0 {
        margin-bottom: 0; 
      }

      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; 
      }

      .powered-by a {
        text-decoration: none; 
      }

      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        margin: 20px 0; 
      }

      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table.body h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; 
        }
        table.body p,
        table.body ul,
        table.body ol,
        table.body td,
        table.body span,
        table.body a {
          font-size: 16px !important; 
        }
        table.body .wrapper,
        table.body .article {
          padding: 10px !important; 
        }
        table.body .content {
          padding: 0 !important; 
        }
        table.body .container {
          padding: 0 !important;
          width: 100% !important; 
        }
        table.body .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important; 
        }
        table.body .btn table {
          width: 100% !important; 
        }
        table.body .btn a {
          width: 100% !important; 
        }
        table.body .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important; 
        }
      }

      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; 
        }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; 
        }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; 
        }
        #MessageViewBody a {
          color: inherit;
          text-decoration: none;
          font-size: inherit;
          font-family: inherit;
          font-weight: inherit;
          line-height: inherit;
        }
        .btn-primary table td:hover {
          background-color: #34495e !important; 
        }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important; 
        } 
      }

    </style>
  </head>
  <body>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">

            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <p>'.$title.'</p>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" >
                          <tbody>
                            <tr>
                              <td align="left">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                  <tbody>
                                    '.$message.'
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- END CENTERED WHITE CONTAINER -->

            <!-- START FOOTER -->

            <!-- END FOOTER -->

          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
    ';
    return $mail;
}