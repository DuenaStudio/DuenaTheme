jQuery(function() {
	jQuery(window).scroll(function() {
		if(jQuery(this).scrollTop() != 0) {
			jQuery('#toTop').fadeIn();	
		} else {
			jQuery('#toTop').fadeOut();
		}
	});
 
	jQuery('#toTop').click(function() {
		jQuery('body,html').animate({scrollTop:0},800);
	});	
	jQuery(".post_format_image a").append('<span class="hover_overlay"><i class="fa fa-search-plus"></i></span>');
	jQuery(".post_format_image a").magnificPopup({
		type: 'image',
		removalDelay: 500, //delay removal by X to allow out-animation
		callbacks: {
		    beforeOpen: function() {
		      // just a hack that adds mfp-anim class to markup 
		       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
		       this.st.mainClass = this.st.el.attr('data-effect');
		    }
		}
	});
	jQuery(".lightbox_img").append('<span class="hover_overlay"><i class="fa fa-search-plus"></i></span>');
	jQuery(".lightbox_img").magnificPopup({
		type: 'image',
		removalDelay: 500, //delay removal by X to allow out-animation
		callbacks: {
		    beforeOpen: function() {
		      // just a hack that adds mfp-anim class to markup 
		       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
		       this.st.mainClass = this.st.el.attr('data-effect');
		    }
		}
	});
	jQuery(".format_image_wrap a").magnificPopup({
		type: 'image',
		removalDelay: 500, //delay removal by X to allow out-animation
		callbacks: {
		    beforeOpen: function() {
		      // just a hack that adds mfp-anim class to markup 
		       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
		       this.st.mainClass = this.st.el.attr('data-effect');
		    }
		}
	});

	jQuery(".lightbox_img").hover(
		function(){
			jQuery(this).find('.hover_overlay').stop().animate({opacity:0.6}, 400)
			jQuery(this).find('.fa.fa-search-plus').stop().animate({opacity: 0.3, fontSize:61, marginTop:-6, marginLeft:-23 }, 400)
		},
		function(){
			jQuery(this).find('.hover_overlay').stop().animate({opacity:0}, 400)
			jQuery(this).find('.fa.fa-search-plus').stop().animate({opacity: 0, fontSize:800, marginTop:-200, marginLeft:-300 }, 400)
		}
	)

});