<?php
add_action('wp_ajax_add_news_letter', 'add_news_letter');
add_action('wp_ajax_nopriv_add_news_letter', 'add_news_letter');
if (!function_exists('add_news_letter')):
function add_news_letter() {
    $news_post = array(
    'post_title'    => $_POST['mail'],
    'post_type' => 'newsletter'
    );

    wp_insert_post( $news_post );
    $message=$_POST['mail'];
    $email_message=mail_generator("خبرنامه مای لیدی",$message);
    $to=get_field("news_mail","option");
    if ($to){
        $subject = "خبرنامه مای لیدی";
        $body = $email_message;
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail( $to, $subject, $body, $headers );
    }

    print json_encode(array("status" => true));
    exit();
}
endif;

add_action('wp_ajax_filter_product', 'filter_product');
add_action('wp_ajax_nopriv_filter_product', 'filter_product');
if (!function_exists('filter_product')):
function filter_product() {
    $terms=$_POST['terms'];
    $terms_array=array();
    foreach ($terms as $term){
        $this_term = get_term($term, 'feature');
        if ($terms_array[$this_term->parent]){

        }else{
            $terms_array[$this_term->parent]=array();
        }
        array_push($terms_array[$this_term->parent],$term);
    }
    $query_array=[
        'relation' => 'AND'
    ];
    foreach ($terms_array as $parent_term=>$child_term){
        $this_query=[
            'taxonomy'=>'feature',
            'terms' => $child_term,
            'field' => 'term_id',
            'operator' => 'IN',
        ];
        array_push($query_array,$this_query);
    }
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 20,
        'tax_query'=>$query_array
    );
    $products = new WP_Query($args);
    $result="";
    if ($products->have_posts()){
        while ($products->have_posts()){
            $products->the_post();
            $result.= archive_products_card($post->ID);
        }
    }else{
        $result.="<div class='lady-alert lady-danger'>
                        <p>محصولی با فیلتر مورد نظر شما یافت نشد</p>
                        <div class='d-flex justify-content-center'>
                        <button class='btn w-100 primary-button remove-filter'>مشاهده همه محصولات</button>
                        </div>
                   </div>";
    }
    print json_encode(array("status" => true,'result'=>$result));
    exit();
}
endif;

//contact form entry
add_action('wp_ajax_add_form_entry', 'add_form_entry');
add_action('wp_ajax_nopriv_add_form_entry', 'add_form_entry');
if (!function_exists('add_form_entry')):
    function add_form_entry()
    {
        $datas = $_POST['data'];
        $form = $_POST['form'];
        $entries = array();
        $i = 0;
        $message="";
        foreach ($datas as $data) {
            $message.='
                <tr>
                  <td><p>'.$data["name"].' : '.$data["value"].'</p></td>
                </tr>
                ';
            $entries[$i] = array();
            $entries[$i]["field"] = $data["name"];
            $entries[$i]["value"] = $data["value"];
            $i++;
        }
        $form_entry = wp_insert_post(array(
            'post_title' => "contact" . " - " . date("Y/m/d"),
            'post_type' => 'formentry'
        ));
        update_field("entries", $entries, $form_entry);
        update_field("viewed", 0, $form_entry);

        $email_message=mail_generator("فرم تماس مای لیدی",$message);
        $to=get_field("contact_mail","option");
        if ($to){
            $subject ="فرم تماس مای لیدی";
            $body = $email_message;
            $headers = array('Content-Type: text/html; charset=UTF-8');
            wp_mail( $to, $subject, $body, $headers );
        }

        print json_encode(array("status" => true, "message" => "ثبت اطلاعات شما با موفقیت انجام شد!"));
        exit();
    }
endif;

// ajax request
add_action('wp_ajax_request_submission', 'request_submission');
add_action('wp_ajax_nopriv_request_submission', 'request_submission');
function request_submission(){
    $datas =$_POST["data"];
    $mobile = $_POST['mobile'];
    $name= $_POST['name'];
    $my_post = array(
        'post_title'    => $name."-".$mobile,
        'post_status'   => 'draft',
        'post_author'   => 1,
        'post_type'     => 'request', //name of post type
    );
    $post_id = wp_insert_post( $my_post );
    $message="";
    foreach ($datas as $data){
        update_field($data["name"],$data["value"],$post_id);
        $message.='
        <tr>
          <td><p>'.$data["name"].' : '.$data["value"].'</p></td>
        </tr>
        ';
    }
    $email_message=mail_generator("درخواست وندینگ ماشین",$message);
    $to=get_field("vending_request_mail","option");
    if ($to){
        $subject = "درخواست وندینگ ماشین";
        $body = $email_message;
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail( $to, $subject, $body, $headers );
    }

    header( "Content-Type: application/json" );
    print json_encode(array("status" => true, "message" => "ثبت اطلاعات شما با موفقیت انجام شد!",'name'=>$datas));
    die();
}

// ajax signup event
add_action('wp_ajax_event_submission', 'event_submission');
add_action('wp_ajax_nopriv_event_submission', 'event_submission');
function event_submission(){
    $datas=$_POST["data"];
    $mobile = $_POST['mobile'];
    $name= $_POST['name'];
    $my_post = array(
        'post_title'    => $name."-".$mobile,
        'post_status'   => 'draft',
        'post_type'     => 'signup',
    );
    $post_id = wp_insert_post( $my_post );
    foreach ($datas as $data){
        update_field($data["name"],$data["value"],$post_id);
    }
    header( "Content-Type: application/json" );
    print json_encode(array("status" => true, "message" => "ثبت اطلاعات شما با موفقیت انجام شد!"));
    die();

}