<?php
$image_folder=get_stylesheet_directory_uri() . '/assets/images/';
?>
<div class="category-wrapper">
    <div class="container">
        <h1><?php
        if ( $args['active'] ) {
            $active_id=$args['active'];
        }
        if ($active_id==0){
            echo "همه مقالات";
        }else{
            $term=get_queried_object();
            echo $term->name;
        }
        ?></h1>
        <div class="d-flex align-items-center justify-content-start justify-content-md-center category-items-wrapper">
            <?php
            $categories=get_terms(array(
                'taxonomy' => 'category',
                'hide_empty' => false,
            ));

            foreach ($categories as $category){
                $active_class="";
                if ($active_id==$category->term_id){
                    $active_class="active";
                }
                $img = get_field("cat_img", 'category_' . $category->term_id);
                print '
                <a class="blog-category-item '.$active_class.'" href="'.get_term_link($category->term_id,"category").'" title="'.$category->name.'">
                    <div class="blog-category-img" style="background: url('.$img.') no-repeat center; background-size: cover;"></div>
                    <h5 class="text-center mt-4">'.$category->name.'</h5>
                </a>
                ';
            }
            $active_class="";
            if ($active_id==0){
                $active_class="active";
            }
            print '
                <a class="blog-category-item '.$active_class.'" href="'.get_page_link(353).'" title="آخرین مقالات ">
                    <div class="blog-category-img" style="background: url('.$image_folder.'last-blogs.png) no-repeat center; background-size: cover;"></div>
                    <h5 class="text-center mt-4">آخرین مقالات </h5>
                </a>
                ';
            ?>
        </div>
    </div>
</div>