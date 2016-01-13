<div class="fdl_modal modal <?php echo $this->getVar('class');?>" id="modal_<?php echo $this->getVar('id');?>" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $this->getVar('title');?></h4>
      </div>
      <div class="modal-body">
        <?php echo $this->getVar('body');?>
      </div>
    </div>
  </div>
</div>