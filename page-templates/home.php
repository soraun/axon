<?php
/* Template Name: Home page */
get_header();
$image_folder=get_stylesheet_directory_uri() . '/assets/images/';

?>
<?php soran_home_page_builder(); ?>

<?php
get_footer();