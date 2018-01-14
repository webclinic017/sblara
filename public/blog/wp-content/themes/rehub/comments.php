<div id="comments" class="clearfix">
<?php if(rehub_option('rehub_widget_comments') && comments_open()) : ?><?php echo htmlspecialchars_decode( stripslashes(rehub_kses(rehub_option('rehub_widget_comments')))); ?><div style="margin-bottom:15px; clear:both"></div><?php endif; ?>
<?php if(rehub_option('rehub_disable_comments') != '1') :?>
    <div class="post-comments">
        <?php 
            if ( comments_open() ) :
            echo "<div class='title_comments'>";
            comments_number(__('No Comments','rehub_framework'), __('1 Comment','rehub_framework'), '% ' . __('Comments','rehub_framework') );
            echo "</div>";
            endif;
            echo "<ol class='commentlist'>";
                wp_list_comments(array(
                    'avatar_size'   => 50,
                    'max_depth'     => 4,
                    'style'         => 'ul',
                    'callback'      => 'rehub_framework_comments',
                    'type'          => 'all'
                ));
            echo "</ol>";
            echo "<div id='comments_pagination'>";
                paginate_comments_links(array('prev_text' => '&laquo;', 'next_text' => '&raquo;'));
            echo "</div>";
            $custom_comment_field = '<textarea id="comment" name="comment" cols="30" rows="10" aria-required="true"></textarea>';
            $commenter = wp_get_current_commenter();
            comment_form(array(
                'comment_field'         => $custom_comment_field,
                'comment_notes_after'   => '',
                'logged_in_as'          => '',
                'comment_notes_before'  => '',
                'title_reply'           => __('Leave a reply', 'rehub_framework'),
                'cancel_reply_link'     => __('Cancel reply', 'rehub_framework'),
                'label_submit'          => __('Post comment', 'rehub_framework'),
                'fields' => apply_filters( 'comment_form_default_fields', array(

                    'author' =>
                        '<div class="usr_re"><input id="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" name="author" placeholder="'.__('Name', 'rehub_framework').'"></div>',

                    'email' =>
                        '<div class="email_re"><input id="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" name="email" placeholder="'.__('E-mail', 'rehub_framework').'"></div>',

                    'url' =>
                        '<div class="site_re end"><input id="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'" name="url" placeholder="'.__('Website', 'rehub_framework').'"></div><div class="clearfix"></div>',
                )
              ),
            ));
         ?>
    </div> <!-- end comments div -->
<?php endif;?>    
</div>