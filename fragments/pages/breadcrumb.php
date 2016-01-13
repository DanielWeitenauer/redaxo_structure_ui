<?php
  $addon = $this->getVar('addon');
  $categories = $this->getVar('categories');
?><div id="rex-js-structure-breadcrumb" class="rex-breadcrumb">
  <ol class="breadcrumb">
    <li class="rex-breadcrumb-title"><a href="<?php echo rex_url::backendPage('structure',['root_tree'=>'reset','clang'=>rex_clang::getCurrent()->getId()]);?>"><i class="rex-icon rex-icon-sitestartarticle"></i> <?php echo $addon->i18n('homepage');?></a></li>
    <?php if(empty($categories)) {?><li>Hauptebene</li><?php } else {?>
    <?php foreach($categories as $id => $name) {?>
    <li><a href="<?php echo rex_url::backendPage('structure',['root_tree'=>$id,'clang'=>rex_clang::getCurrent()->getId()]);?>"><?php echo $name;?></a></li>
    <?php }?>
    <?php }?>
  </ol>
</div>