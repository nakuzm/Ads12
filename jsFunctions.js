$(function () {
  $('[data-toggle="tooltip"]').tooltip();
  
  $('a.js-delete').click(function() {
    var tr = $(this).closest('tr');
    var id = tr.children('td:first').html();

    $(this).load('index.php?delete=' + id, function(responseText, textStatus){

      if (textStatus === "success") {
        tr.fadeOut('slow',function() {
            $(this).remove();
        });
      } else {
        throw new Error("Ошибка при удалении объявления на сервере");
      }

    });
    
  });
   
  
});

