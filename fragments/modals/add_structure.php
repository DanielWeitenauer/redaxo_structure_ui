<?php
  $addon = $this->getVar('addon');
  $function = $this->getVar('function');
  $form_data = $this->getVar('form_data',[]);
?><form action="<?php echo rex_url::currentBackendPage();?>" method="post">
  <fieldset class="form-horizontal">
    <legend>Allgemein (<?php echo $function;?>)</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="value-1">Name</label>
        <div class="col-sm-10">
            <input class="form-control" id="value-1" type="text" name="Name" value="<?php echo (!empty($form_data)?$form_data->getName():'');?>" >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="value-1">Prio</label>
        <div class="col-sm-10">
            <input class="form-control" id="value-1" type="number" name="priority" value="<?php echo (!empty($form_data)?$form_data->getValue('priority'):'');?>" />
        </div>
    </div>
  </fieldset>

  <fieldset class="form-horizontal">
    <legend>Meta-Daten</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="value-1">Meta</label>
        <div class="col-sm-10">
            <input class="form-control" id="value-1" type="text" name="Name" value="" />
        </div>
    </div>
  </fieldset>


  <div class="modal-footer">
    <input type="submit" class="btn btn-default" data-dismiss="modal" value="Save">
  </div>
</form>