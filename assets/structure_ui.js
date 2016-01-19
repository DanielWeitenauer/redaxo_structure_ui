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
});

})(jQuery);