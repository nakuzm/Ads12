(function ($) {
  $( document ).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();

    var $table = $('#tableAdsOutput');
    $table.on('click', 'a.js-delete', function (event) {
      event.preventDefault();
      var $target = $(event.target).closest('.js-delete'),
        $tr = $target.closest('tr'),
        id = $tr.children('td:first').html(),
        adId = {
          id: id,
          action: 'delete'
        };

      $.getJSON('index.php', adId, function (responseText, textStatus) {
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
    });

    $table.on('click', 'a.js-edit', function (event) {
      event.preventDefault();
      var $target = $(event.target).closest('.js-edit'),
        $tr = $target.closest('tr'),
        id = $tr.children('td:first').html(),
        adId = {
          id: id,
          action: 'edit'
        };
      $tr.addClass('is-edit');
      $.get('index.php', adId, function (responseText, textStatus) {
        if (textStatus === "success") {
          $('#form-wrap').html(responseText);    
        } else {
          throw new Error("Ошибка при ajax запросе");
        }
      });
    });
    
    $(document).on("submit", "#ads-form", function (event) {
      event.preventDefault();
      var $this = $(this);
      $.post('index.php', $this.serialize(), function (responseText, textStatus) {
        if (textStatus === "success") {
          var $rowForEdit = $('tr.is-edit');
          if ($rowForEdit.length) {
            $rowForEdit.replaceWith(responseText);
          } else {
            $("#ads-table tbody").append(responseText);
          }
        } else {
          throw new Error("Ошибка при ajax запросе");
        }
      });
      var adId = {action: 'clear'};
      $.get('index.php', adId, function (responseText, textStatus) {
        if (textStatus === "success") {
          $('#form-wrap').html(responseText);
        } else {
          throw new Error("Ошибка при ajax запросе");
        }
      });
    });  
  });
  
})(jQuery);