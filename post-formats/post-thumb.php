<?php if(!is_singular()) : ?>
	<?php if ( has_post_thumbnail() ) {	?>
		<?php if ( ( '' == of_get_option('post_image_size') ) || ('normal' == of_get_option('post_image_size')) ) {	?>
			<figure class="featured-thumbnail thumbnail"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e('Permalink to:', 'duena');?> <?php the_title(); ?>"><?php the_post_thumbnail(); ?></a></figure>
		<?php } ?>
	<?php }	?>
<?php else :?>
	<?php 
		$hide_th = 0;
		global $multipage, $numpages, $page;
		if ($multipage && (1 < $page) ) {
			$hide_th = 1;
		}

		if ( has_post_thumbnail() && ( 1 != $hide_th  ) ) {	?>
		<?php if ( ( '' == of_get_option('single_image_size') ) || ('normal' == of_get_option('single_image_size')) ) {	?>
			<figure class="featured-thumbnail thumbnail"><?php the_post_thumbnail(); ?></figure>
		<?php } ?>
	<?php }	?>
<?php endif; ?>