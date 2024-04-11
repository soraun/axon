<?php
//home page builder
if(!function_exists('soran_home_page_builder')){
    function soran_home_page_builder($exclude = array()){
        global $wp_query;
        $post_id = null;
        if ($wp_query->is_archive()){
            $term = get_queried_object();-
            $post_id = $term->taxonomy.'_'.$term->term_id;
        }
        $layouts = array('start','amar','about','ability','application','tab','blog','option','cta','property','seo','realtime','price');

        if( have_rows('layouts',$post_id)):
            while ( have_rows('layouts',$post_id) ) : the_row();

                foreach ($layouts as $layout){
                    if ($layout == get_row_layout() ){
                        get_template_part('template-parts/home/section',$layout);
                    }
                }
            endwhile;
        endif;
    }
}
