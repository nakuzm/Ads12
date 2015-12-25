{*Индексный шаблон*}
{include file='header.tpl'}

<div class="container">
  
  <div class="row">
    <div class="col-sm-6 alert-wrap">
      <div id="ajax-alert-success" class="alert alert-success" role="alert"></div>
      <div id="ajax-alert-info" class="alert alert-info" role="alert"></div>
      <div id="ajax-alert-danger" class="alert alert-danger" role="alert"></div>
    </div>
  </div>
  
  {include file='table.tpl'}
  
  <div id="form-wrap">
    {include file='form.tpl'} 
  </div>  
</div>

{include file='footer.tpl'}


