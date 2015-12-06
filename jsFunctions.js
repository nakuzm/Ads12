(function ($) {
  
  $('[data-toggle="tooltip"]').tooltip();
  
  var $table = $('#tableAdsOutput');
  $table.on('click', 'a.js-btn', function (event) {
    event.preventDefault();
    var $target = $(event.target).closest('.js-btn'),
      $tr = $target.closest('tr'),
      id = $tr.children('td:first').html(),
      adId = {id: id};
    if ($target.hasClass('js-delete')) {
      $.getJSON('index.php?action=delete', adId, function (responseText, textStatus) {
        if (textStatus === "success") {

          var $info = $('#ajax-alert-info');

          $tr.fadeOut('slow', function () {
              $tr.remove();
              if ("tableEmpty" in responseText) {
                $info.text(responseText['tableEmpty']).fadeIn('slow', function () {
                  var $this = $(this);
                  setTimeout(function () {
                    $this.fadeOut.call($this, 'slow');
                  }, 5000);
                });            
              }
          });
        } else {
          throw new Error("Ошибка при ajax запросе");
        }
      }); 
    } else {
      $.get('index.php?action=edit', adId , function( data ) {
        $('body').html(data);
      });
    }
  });
  
  $("#ads-form").submit(function ( event ) {
    event.preventDefault();
    var $this = $(this);
    $.post( "index.php", $this.serialize(), function ( data ) {
      $( "body" ).html( data );
    });
  });
  
  
})(jQuery);

