(function($){
  $(function(){
    // Mobile menu toggle
    $('.menu-toggle').on('click', function(){
      $('.main-menu').toggleClass('open');
      $(this).attr('aria-expanded', $('.main-menu').hasClass('open'));
    });

    // Contact form submit (AJAX)
    $('#aw-contact-form').on('submit', function(e){
      e.preventDefault();
      var $form = $(this);
      var data = {
        action: 'aw_contact',
        nonce: aw_ajax.nonce,
        name: $.trim( $('#aw-name').val() ),
        email: $.trim( $('#aw-email').val() ),
        message: $.trim( $('#aw-message').val() )
      };
      var $result = $form.find('.form-result');
      $result.text('');
      $.post( aw_ajax.ajax_url, data, function(res){
        if ( res.success ) {
          $result.text( res.data.message );
          $form[0].reset();
        } else {
          $result.text( res.data.message || 'حدث خطأ.' );
        }
      }, 'json' ).fail(function(){
        $result.text('تعذر الاتصال بالخادم.');
      });
    });
  });
})(jQuery);
