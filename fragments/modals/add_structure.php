<?php
  $addon = $this->getVar('addon');
  $function = $this->getVar('function');
  $form_data = $this->getVar('form_data',[]);
  $Meta = $this->getVar('meta','');
  $Extended = $this->getVar('extended','');
?><form action="<?php echo rex_url::currentBackendPage();?>" method="post">
  <fieldset>
    <legend>Allgemein (<?php echo $function;?>)</legend>
    <dl class="rex-form-group form-group">
        <dt><label for="rex_modal_cat_name">Name</label></dt>
        <dd>
            <input class="form-control" id="rex_modal_cat_name" type="text" name="Name" value="<?php echo (!empty($form_data)?$form_data->getName():'');?>" >
        </dd>
    </dl>

    <dl class="rex-form-group form-group">
        <dt><label for="rex_modal_cat_priority">Prio</label></dt>
        <dd>
            <input class="form-control" id="rex_modal_cat_priority" type="number" name="priority" value="<?php echo (!empty($form_data)?$form_data->getValue('priority'):'');?>" />
        </dd>
    </dl>
  </fieldset>
  
  <?php if(!empty($Meta)) {?>
  <fieldset>
    <legend>Meta-Informationen</legend>
    <?php echo $Meta;?>
  </fieldset>
  <?php }?>
  
  <?php if(!empty($Extended)) {?>
  <fieldset>
    <legend>Weiteres</legend>
    <?php echo $Extended;?>
  </fieldset>
  <?php }?>


  <div class="modal-footer">
    <input type="submit" class="btn btn-default" data-dismiss="modal" value="Save">
  </div>
</form>