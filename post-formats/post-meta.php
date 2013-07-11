
<?php $format = get_post_format(); ?>
<span class="post_type_label <?php echo esc_attr( $format ); ?>"></span>
<?php if ( 'false' != of_get_option('post_meta')) { ?>
<span class="post_date"><time datetime="<?php the_time('Y-m-d\TH:i:s'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time></span>
	<!-- Post Meta -->
	<?php  
		if ('aside' == $format) {
	?>
	<div class="post_meta aside">
		<?php if ( get_the_category() ) {?><span class="post_category"><?php the_category(' ') ?></span><?php } ?>
		<span class="post_comment"><i class="icon-comments"></i><?php comments_popup_link('No comments', '1 comment', '% comments', 'comments-link', 'Comments are closed'); ?></span>
		<span class="post_author"><i class="icon-user"></i><?php the_author_posts_link() ?></span>
		<div class="clear"></div>
	</div>
	<?php
		} elseif ('chat' == $format) {
	?>
	<div class="post_meta chat">
		<?php if ( get_the_category() ) {?><span class="post_category"><?php the_category(' ') ?></span><?php } ?>
		<span class="post_comment"><i class="icon-comments"></i><?php comments_popup_link('No comments', '1 comment', '% comments', 'comments-link', 'Comments are closed'); ?></span>
		<span class="post_author"><i class="icon-user"></i><?php the_author_posts_link() ?></span>
		<div class="clear"></div>
	</div>
	<?php
		} elseif ('link' == $format) {
	?>
	<div class="post_meta link">
		<?php if ( get_the_category() ) {?><span class="post_category"><?php the_category(' ') ?></span><?php } ?>
		<?php if ( !is_singular() ) { ?>
		<span class="post_permalink"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e('Permalink to:', 'duena');?> <?php the_title(); ?>"><i class="icon-link"></i><?php _e('Permalink', 'duena') ?></a></span>
		<?php } ?>
		<span class="post_author"><i class="icon-user"></i><?php the_author_posts_link() ?></span>
		<div class="clear"></div>
	</div>
	<?php
		} elseif ('quote' == $format) {
	?>
	<div class="post_meta quote">
		<?php if ( get_the_category() ) {?><span class="post_category"><?php the_category(' ') ?></span><?php } ?>
		<?php if ( !is_singular() ) { ?>
		<span class="post_permalink"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e('Permalink to:', 'duena');?> <?php the_title(); ?>"><i class="icon-link"></i><?php _e('Permalink', 'duena') ?></a></span>
		<?php } ?>
		<span class="post_comment"><i class="icon-comments"></i><?php comments_popup_link('No comments', '1 comment', '% comments', 'comments-link', 'Comments are closed'); ?></span>
		<span class="post_author"><i class="icon-user"></i><?php the_author_posts_link() ?></span>
		<div class="clear"></div>
	</div>
	<?php
		} elseif ('status' == $format) {
	?>
	<div class="post_meta status">
		<?php if ( get_the_category() ) {?><span class="post_category"><?php the_category(' ') ?></span><?php } ?>
		<?php if ( !is_singular() ) { ?>
		<span class="post_permalink"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e('Permalink to:', 'duena');?> <?php the_title(); ?>"><i class="icon-link"></i><?php _e('Permalink', 'duena') ?></a></span>
		<?php } ?>
		<span class="post_comment"><i class="icon-comments"></i><?php comments_popup_link('No comments', '1 comment', '% comments', 'comments-link', 'Comments are closed'); ?></span>
		<span class="post_author"><i class="icon-user"></i><?php the_author_posts_link() ?></span>
		<div class="clear"></div>
	</div>
	<?php 	
		} else {
	?>
	<div class="post_meta default">
		<?php if ( get_the_category() ) {?><span class="post_category"><?php the_category(' ') ?></span><?php } ?>
		<span class="post_comment"><i class="icon-comments"></i><?php comments_popup_link('No comments', '1 comment', '% comments', 'comments-link', 'Comments are closed'); ?></span>
		<span class="post_author"><i class="icon-user"></i><?php the_author_posts_link() ?></span>
		<div class="clear"></div>
	</div>
	<?php } ?>
	<!--// Post Meta -->
<?php } ?>
<?php if ( (is_single()) && ("false" != esc_attr( (of_get_option('post_share')) )) ) {?>
	<!-- Social bookmarks -->
	<div class="social_bookmark">
		<span class="facebook">
			<div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-font="arial"></div>
		</span>
		<span class="twitter">
			<?php $twit_url = 'https://twitter.com/share'; ?>
			<a href="<?php echo esc_url( $twit_url ); ?>" class="twitter-share-button">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</span>
		<span class="gplus">
			<g:plusone size='medium'></g:plusone>
		</span>
		<?php 
			if ( has_post_thumbnail() ) {
				$img_url = wp_get_attachment_url( get_post_thumbnail_id() );
			} else {

			}
		?>
		<span class="pinterest">
			<a href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" ><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>		
		</span>

		<!-- Facebook -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<!-- Google+ -->
		<script type="text/javascript">
	      window.___gcfg = {
	        lang: 'en-US'
	      };

	      (function() {
	        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	        po.src = 'https://apis.google.com/js/plusone.js';
	        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	      })();
	    </script>

	    <!-- Pinterest -->
	    <script type="text/javascript">
		(function(d){
		  var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
		  p.type = 'text/javascript';
		  p.async = true;
		  p.src = '//assets.pinterest.com/js/pinit.js';
		  f.parentNode.insertBefore(p, f);
		}(document));
		</script>
	</div>
	<!--// Social bookmarks -->
<?php } ?>