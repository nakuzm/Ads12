<form  method="post" class="form-horizontal" role="form" id="ads-form">
  
  <div class="form-wrap">

    <input type="hidden" class="form-control" value="{$ads_single->getId()}" name="id" id="fld_id">

    <div class="form-group">
      <div class="col-lg-offset-3 col-lg-9 col-md-offset-3 col-md-9">
        {html_radios name="type" labels="class='radio-inline bold'" options=$ads_radios selected=$ads_single->getType()}
      </div>
    </div>

    <div class="form-group">
      <label for="fld_seller_name" class="col-lg-3 col-md-3 flb-left">Ваше имя</label>
      <div class="col-lg-9 col-md-9">
        <input type="text" class="form-control" value="{$ads_single->getSellerName()}" name="seller_name" id="fld_seller_name">
      </div>
    </div>

    <div class="form-group"> 
      <label for="fld_email" class="col-lg-3 col-md-3 flb-left">Электронная почта</label>
      <div class="col-lg-9 col-md-9">
        <input type="text" class="form-control" value="{$ads_single->getEmail()}" name="email" id="fld_email">
      </div>
    </div>

    <div class="form-group">
      <div class="col-lg-offset-3 col-lg-9 col-md-offset-3 col-md-9">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="allow_mails" value="1" {if $ads_single->getAllowMails()}checked="checked"{/if}/>
            Я не хочу получать вопросы по объявлению по e-mail
          </label>
        </div>
      </div>
    </div>

    <div class="form-group"> 
      <label for="fld_phone" class="col-lg-3 col-md-3 flb-left">Номер телефона</label> 
      <div class="col-lg-9 col-md-9">
        <input type="text" class="form-control" value="{$ads_single->getPhone()}" name="phone" id="fld_phone">
      </div>
    </div>

    <div class="form-group"> 
      <label for="region" class="col-lg-3 col-md-3 flb-left">Город</label> 

      <div class="col-lg-9 col-md-9">
        <select title="Выберите Ваш город" name="location_id" id="region" class="form-control"> 
          <option value="">-- Выберите город --</option>
          {html_options options=$city selected=$ads_single->getLocationId()}
        </select>
      </div> 
    </div> 

    <div class="form-group"> 
      <label for="fld_category_id" class="col-lg-3 col-md-3 flb-left">Категория</label> 

      <div class="col-lg-9 col-md-9">

        <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-control"> 
          <option value="">-- Выберите категорию --</option>
          {html_options options=$category selected=$ads_single->getCategoryId()}
        </select> 

      </div>
    </div>

    <div class="form-group"> 
      <label for="fld_title" class="col-lg-3 col-md-3 flb-left">Название объявления</label> 
      <div class="col-lg-9 col-md-9">
        <input type="text" class="form-control" value="{$ads_single->getTitle()}" name="title" id="fld_title"> 
      </div>
    </div>

    <div class="form-group"> 
      <label for="fld_description" class="col-lg-3 col-md-3 flb-left">Описание объявления</label> 
      <div class="col-lg-9 col-md-9">
        <textarea class="form-control" rows="3" name="description" id="fld_description">{$ads_single->getDescription()}</textarea>
      </div>
    </div>

    <div class="form-group"> 
      <label for="fld_price" class="col-lg-3 col-md-3 flb-left">Цена</label>
      <div class="col-lg-3 col-md-3">
        <div class="input-group">
          <input type="text" class="form-control" value="{$ads_single->getPrice()}" name="price" id="fld_price">
          <div class="input-group-addon">руб.</div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-lg-offset-3 col-lg-9 col-md-offset-3 col-md-9">
        <input class="btn btn-default" type="submit" value="{$ads_btn_value|default:"Отправить"}" name="main_form_submit"> 
      </div>
    </div>

  </div>
</form>