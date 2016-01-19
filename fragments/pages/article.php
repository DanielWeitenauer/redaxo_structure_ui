<?php
  $category = $this->getVar('category');
  $categoryId = !empty($category)?$category->getId():0;
  $article = $this->getVar('article');
  $articleId = $article->getId();
  $clang = rex_clang::getCurrent()->getId();
?>
<li class="article">
  <div>
    <span class="left"><a href="<?php echo rex_url::backendPage('content/edit',['article_id'=>$article->getId()]);?>"><i class="rex-icon fa-file-o"></i> <?php echo $article->getName();?></a></span>
    <span class="right trigger_modal">
      <a href="<?php echo rex_url::backendPage('structure',['id'=>$articleId, 'clang'=>rex_clang::getCurrent()->getId(),'pid'=>$categoryId,'function'=>'edit','type'=>'art']);?>" data-modal="true" data-target="#modal_structure">Einstellungen</a>
      <a href="<?php echo rex_url::backendPage('content/edit',['article_id'=>$articleId]);?>">Module</a>
      <a href="<?php echo rex_url::backendPage('structure',['rex-api-call'=>'article_delete','article_id'=>$article->getId(),'clang'=>$clang,'artstart'=>0]);?>" data-confirm="Kategorie wirklich löschen?">Löschen</a>
    </span>
  </div>
</li>