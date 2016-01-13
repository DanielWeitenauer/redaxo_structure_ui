<div class="buttons right trigger_modal">
  <a href="<?php echo rex_url::backendPage('structure',['category_id'=>0,'article_id'=>0,'clang'=>rex_clang::getCurrent()->getId(),'function'=>'add_art']);?>" data-modal="true" data-target="#modal_structure">Artikel hinzufügen</a>
  <a href="<?php echo rex_url::backendPage('structure',['category_id'=>0,'article_id'=>0,'clang'=>rex_clang::getCurrent()->getId(),'function'=>'add_cat']);?>" data-modal="true" data-target="#modal_structure">Kategorie hinzufügen</a>
  <span> | </span>
  <a href="<?php echo rex_url::backendPage('structure',['category_id'=>0,'article_id'=>0,'clang'=>rex_clang::getCurrent()->getId(),'function'=>'edit_cat']);?>" data-modal="true" data-target="#modal_structure">Editieren</a>
  <a href="<?php echo rex_url::backendPage('structure',['category_id'=>0,'article_id'=>0,'clang'=>rex_clang::getCurrent()->getId(),'function'=>'delete_cat']);?>" data-confirm="Wirklich löschen?">Löschen</a>
</div>
