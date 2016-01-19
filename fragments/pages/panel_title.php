<div class="buttons right trigger_modal">
  <a href="<?php echo rex_url::backendPage('structure',['pid'=>$this->getVar('categoryId'), 'clang'=>rex_clang::getCurrent()->getId(),'function'=>'add','type'=>'art']);?>" data-modal="true" data-target="#modal_structure">Artikel hinzufügen</a>
  <a href="<?php echo rex_url::backendPage('structure',['pid'=>$this->getVar('categoryId'), 'clang'=>rex_clang::getCurrent()->getId(),'function'=>'add','type'=>'cat']);?>" data-modal="true" data-target="#modal_structure">Kategorie hinzufügen</a>
  <span> | </span>
  <a href="<?php echo rex_url::backendPage('structure',['pid'=>$this->getVar('categoryId'), 'clang'=>rex_clang::getCurrent()->getId(),'function'=>'edit','type'=>'cat']);?>" data-modal="true" data-target="#modal_structure">Editieren</a>
  <a href="<?php echo rex_url::backendPage('structure',['pid'=>$this->getVar('categoryId'), 'clang'=>rex_clang::getCurrent()->getId(),'function'=>'delete','type'=>'cat']);?>" data-confirm="Wirklich löschen?">Löschen</a>
</div>
