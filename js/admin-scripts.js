(function($) {
    $(function(){     

        if ( $('#page_template').val() == 'page-templates/portfolio.php' ) {
                $('#duena-portfolio-page').css('display', 'block');
            } else {
                $('#duena-portfolio-page').css('display', 'none');
            }

        $('#page_template').on( 'change', function(event) {
            if ( $(this).val() == 'page-templates/portfolio.php' ) {
                $('#duena-portfolio-page').css('display', 'block');
            } else {
                $('#duena-portfolio-page').css('display', 'none');
            }
        });

    });
})(jQuery);