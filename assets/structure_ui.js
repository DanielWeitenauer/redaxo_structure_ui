(function($){
$(document).on('ready pjax:success rex:ready',function() {

  $('.trigger_modal [data-modal]').click(function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    //var modal_id = $(this).attr('data-target');
    $.get(url, function(data) {
      $(data).modal();
    });
  });

  $('.openCategories').click(function(e){
    var $el = $(this),
        pjax = $el.data('pjax');
    if(!pjax)
      e.preventDefault();
  });
});

})(jQuery);