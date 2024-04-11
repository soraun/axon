<?php

if ( post_password_required() ) {
    return;
}

$soran_one_comment_count = get_comments_number();
?>
<div class="col-lg-9 col-12 commentlist-wrapper">
    <ul class="commentlist">
        <?php wp_list_comments( 'type=comment&callback=better_commets' ); ?>
    </ul>
</div>
<div id="commentform-wrapper" class="comments-area default-max-width <?php echo get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?>">
    <div class="row">
        <div class="col-lg-9 col-12 form-comment-col">
            <?php if ( ! comments_open() ) : ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'soran' ); ?></p>
            <?php endif; ?>

            <?php
            $commenter = wp_get_current_commenter();
            $req = get_option( 'require_name_email' );
            $aria_req = ( $req ? " aria-required='true'" : '' );
            $fields =  array(
                'author' => '<p class="comment-form-author form-details">' . '<label for="author">' . __( 'Name' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
                'email'  => '<p class="comment-form-email form-details"><label for="email">' . __( 'Email' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '</label><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
            );
            $comments_args = array(
                'fields' =>  $fields
            );
            comment_form($comments_args);
            ?>
            <!-- .comments-title -->
        </div>
    </div>
    <!-- .comment-list -->
</div><!-- #comments -->