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
        var $info;
        if (textStatus === "success") {
          $info = $('#ajax-alert-info');

          $tr.fadeOut('slow', function () {
              $tr.remove();
              if ("tableEmpty" in responseText) {
                showAlertMessage($info, responseText['tableEmpty']);
                return;
              }
              showAlertMessage($info, 'Товар удален успешно');;
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
      $.getJSON('index.php', adId, function (responseText, textStatus) {
        if (textStatus === "success") {
          replaceFormValues(responseText);
        } else {
          throw new Error("Ошибка при ajax запросе");
        }
      });
    });
        
    $(document).on("submit", "#ads-form", function (event) {
      event.preventDefault();
      var $this = $(this),
        options = { 
          success: successFormSubmit,
          url:       'index.php',          
          type:      'post',        
          dataType:  'json',        
          resetForm: true        
        }; 
      $this.ajaxSubmit(options);
      
      function successFormSubmit(responseText, textStatus) {
        $("#ads-form").find('input[name="id"]').val('');
        var $rowForEdit, $alertContainer;
        if (textStatus === "success") {
          
          if(responseText['status'] === 'error') {
            $alertContainer = $('#ajax-alert-danger');
            showAlertMessage($alertContainer, 'Произошла ошибка при добавлении товара');        
            return;
          }
          
          $rowForEdit = $('tr.is-edit');
          $alertContainer = $('#ajax-alert-success');
          
          if ($rowForEdit.length) {
            $rowForEdit.replaceWith(responseText['row']);
            showAlertMessage($alertContainer, 'Товар изменен успешно');
          } else {
            $("#ads-table tbody").append(responseText['row']);
            showAlertMessage($alertContainer, 'Товар добавлен успешно');             
          }
        } else {
          throw new Error("Ошибка при ajax запросе");
        }      
      }
    });
    
    function replaceFormValues(formValues) {
      var $form = $('#ads-form');
      for(var key in formValues) {
        if (key === 'location_id' || key === 'category_id') {
          if(formValues[key] === '0') {
            $form.find('select[name="'+ key +'"]').val('');
            continue;
          }
          $form.find('select[name="'+ key +'"]').val(formValues[key]);
          continue;
        }
        else if (key === 'type') {
          $form.find('input[value="'+ formValues[key] +'"]').prop( "checked", true );
          continue;
        }
        else if (key === 'allow_mails') {
          if(formValues[key] === '0') {
          $form.find('input[name="'+ key +'"]').prop( "checked", false );
          continue; 
        }
          $form.find('input[name="'+ key +'"]').prop( "checked", true );
        } 
        else if (key === 'description') {
          $form.find('textarea[name="'+ key +'"]').val(formValues[key]);
          continue;
        }
        $form.find('input[name="'+ key +'"]').val(formValues[key]);
      }
    }

    function showAlertMessage(element, message) {
      element.text(message).fadeIn('slow', function () {
        var $this = $(this);
        setTimeout(function () {
          $this.fadeOut.call($this);
        }, 1000);
      });     
    }
    
  });
  
})(jQuery);