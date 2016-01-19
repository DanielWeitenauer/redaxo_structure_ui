<?php
  $addon = $this->getVar('addon');
  $clang = $this->getVar('clang');
  $function = $this->getVar('function');
  $form_data = $this->getVar('form_data',[]);
  $Meta = $this->getVar('meta','');
  $Extended = $this->getVar('extended','');
  $Type = $this->getVar('type','');
  $PID = $this->getVar('pid');
  $strType =  ($Type === 'cat'?'category':'article');
?><form action="<?php echo rex_url::currentBackendPage();?>" method="post">
  <fieldset>
    <legend>Allgemein</legend>
    <input type="hidden" name="rex-api-call" value="<?php echo $strType;?>_add">
    <input type="hidden" name="parent-category-id" value="<?php echo $PID;?>">
    <input type="hidden" name="pid" value="<?php echo $PID;?>">
    <input type="hidden" name="type" value="<?php echo $this->getVar('type');?>">
    <dl class="rex-form-group form-group">
        <dt><label for="rex_modal_cat_name">Name</label></dt>
        <dd>
            <input class="form-control" id="rex_modal_cat_name" type="text" name="<?php echo $strType;?>-name" value="" >
        </dd>
    </dl>

    <dl class="rex-form-group form-group">
        <dt><label for="rex_modal_cat_priority">Prio</label></dt>
        <dd>
            <input class="form-control" id="rex_modal_cat_priority" type="number" name="<?php echo $strType;?>-position" value="<?php echo (!empty($form_data)?($form_data->getRows()+1):'');?>" />
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
    <input type="submit" class="btn btn-default" value="Save">
  </div>
</form>