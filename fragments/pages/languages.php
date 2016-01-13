<?php
  $clangs = rex_clang::getAll();
  $current = rex_clang::getCurrent();
  if(!empty($clangs)) {
?><div class="rex-nav-btn rex-nav-language">
  <div class="btn-toolbar">
    <div class="btn-group">
      <?php foreach($clangs as $clang) {?>
      <a href="<?php echo rex_url::backendPage('structure',['clang'=>$clang->getId()]);?>" class="btn btn-clang<?php echo ($current->getId() == $clang->getId()?' active':'');?>" title="<?php echo $clang->getName();?>"><i class="rex-icon rex-icon-language<?php echo ($current->getId() == $clang->getId()?'-active':'');?>"></i> <?php echo $clang->getName();?></a>
      <?php }?>
    </div>
  </div>
</div>
<?php }?>