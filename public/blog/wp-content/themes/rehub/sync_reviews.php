<?php

	/* Template Name: User reviews corrector */

?>
<?php get_header(); ?>
<div class="content"><div class="main-side page clearfix full_width">
<article class="post">       
    <?php $temp = $wp_query; $wp_query = null; ?>
    <?php $args = array( 
        'post_type' => 'post',
        'posts_per_page' => 30, 
   		'meta_key' => 'rehub_framework_post_type',
        'paged' => $paged,
        'meta_value' => 'review',
    );
    ?> 
    <?php $wp_query = new WP_Query($args); if($wp_query->have_posts()): while($wp_query->have_posts()): $wp_query->the_post(); ?>
    <?php delete_post_meta($post->ID, 'post_user_raitings'); delete_post_meta($post->ID, 'post_user_average');?>                
    <p>Post : <?php the_title(); echo '; id : '; echo $post->ID ?> - done!</p>
    <ul>
    <?php 
    	$comments = get_comments(array(
			'post_id' => $post->ID,
			'status' => 'approve' )
    	);
	    foreach($comments as $comment) {
	    	echo '<li>';
			$comment_id = $comment->comment_ID; 
			$comment_post_id = $post->ID; // Получаем идентификатор комментария из объекта комментария
			$postUserRaitingsArray = get_post_meta($comment_post_id, 'post_user_raitings', false); // Получаем массив значений рейтинга из произвольного поля записи
			$postUserRaitings = $postUserRaitingsArray[0];
			$commentRaitingsArray = get_comment_meta($comment_id, 'user_criteria', false); // Получаем массив пользовательских оценок из произвольного поля комментария
			$commentRaitings = $commentRaitingsArray[0];
			$postData = array(); // Создаем массив хранения данных
			$postCriteriaAverage = $postAverage = '';
			for($i = 0; $i < count($commentRaitings); $i++) {
				$postData['criteria'][$i]['name'] = $commentRaitings[$i]['name'];
				if(isset($postUserRaitings['criteria'][$i])) {
					$count = (int) $postUserRaitings['criteria'][$i]['count'] + 1;
					$total = (float) $commentRaitings[$i]['value'] + (float) $postUserRaitings['criteria'][$i]['value'];
					$postData['criteria'][$i]['count'] = $count;
					$postData['criteria'][$i]['value'] = $total;
					$postData['criteria'][$i]['average'] = bcdiv($total, $count, 1);
				}
				else {
					$postData['criteria'][$i]['count'] = 1;
					$postData['criteria'][$i]['value'] = (float) $commentRaitings[$i]['value'];
					$postData['criteria'][$i]['average'] = (float) $commentRaitings[$i]['value'];
				};
				$postCriteriaAverage += $postData['criteria'][$i]['average'];
			};
			if(isset($commentRaitings) && count($commentRaitings) > 0) {
				$postAverage = bcdiv($postCriteriaAverage, count($commentRaitings), 1);
				update_post_meta($comment_post_id, 'post_user_raitings', $postData);
				update_post_meta($comment_post_id, 'post_user_average', $postAverage);
				update_comment_meta($comment_id, 'counted', 1); // Устанавливаем флаг учета значений пользовательской оценки в произвольное поле комментария
			}
			//echo $postCriteriaAverage;
			//echo '---';
			//echo $postAverage;
			echo 'comment '.$comment_id.' - ok!</li>';		
	    	echo '</li>';
	    }
	?>
	</ul>
                                                  
    <?php endwhile; ?>
    <?php else : ?>		
        <div class="heading"><h5><?php _e('Sorry. No posts in this category yet', 'rehub_framework'); ?></h5></div>				   
    <?php endif; ?>
    <div class="pagination"><?php rehub_pagination();?></div>
    <?php $wp_query = null; $wp_query = $temp;  // Reset ?>
    <?php wp_reset_query(); ?>
</article></div></div>
<?php get_footer(); ?>