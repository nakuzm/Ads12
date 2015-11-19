(function ($) {
  
  $('[data-toggle="tooltip"]').tooltip();
  
  var $table = $('#tableAdsOutput');
  $table.on('click','a.js-delete',function(event) {
    var $tr = $(event.target).closest('tr');
    var id = $tr.children('td:first').html();

    $('#ajax-container').load('ajax.php?delete=' + id, function(responseText, textStatus){

      if (textStatus === "success") {
        $tr.fadeOut('slow',function() {
            $tr.remove();
        });
      } else {
        throw new Error("Ошибка при удалении объявления на сервере");
      }

    });
    
  });
   
})(jQuery);

