(function($){$(function(){
  var $vnpEl = $('.tl_vnp_elements');

  if($vnpEl.length) {
    $vnpEl.find('.icona-question').each(function() {
      var $el = $(this);

      $el.click(function(e) {
        var $desc = $(this).find('.vnp_attribute_description'),
            $close = $desc.find('.close');

        $('.vnp_attribute_description').removeClass('active');

        $desc.click(function(e) {
          e.preventDefault();
          e.stopPropagation();
        });

        $desc.addClass('active');

        if(!$close.length) {
          var Template = $('<div class="vnp_close_description icon-cross"></div>');
          Template.prependTo($desc);
          Template.click(function() {
            $(this).closest('.vnp_attribute_description').removeClass('active');
          });
        }
      });
    });
  }
});})(jQuery);