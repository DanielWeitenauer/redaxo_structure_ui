<?php
  $addon = $this->getVar('addon');
  $toggleAllArticles = $this->getVar('toggleAllArticles',0);
  $toggleAllCategories = $this->getVar('toggleAllCategories',0);
  $category = $this->getVar('category');
  $navigation = $this->getVar('navigation');
  $article_navigation = $this->getVar('article_navigation');
  $Children = $category->getChildren();
  $Articles = $category->getArticles();
  $categoryId = $category->getId();
?>
<li class="category">
  <div>
    <span class="open">
      <?php if(!empty($Children)) {?><a class="openCategories" href="<?php echo rex_url::backendPage('structure',['category'=>$categoryId]);?>"><i class="rex-icon fa-chevron-<?php echo ($navigation[$categoryId] == 1 || $toggleAllCategories == 1?'down':'right');?>"></i></a><?php }?>
      <?php if(!empty($Articles)) {?><a class="showArticles" href="<?php echo rex_url::backendPage('structure',['article'=>$categoryId]);?>"><i class="rex-icon fa-<?php echo ($article_navigation[$categoryId] == 1 || $toggleAllArticles == 1?'minus':'plus');?>-square-o"></i></a><?php }?>
    </span>
    <span class="left"><a href="<?php echo rex_url::backendPage('structure',['root_tree'=>$categoryId]);?>"><?php echo $category->getName();?></a></span>
    <span class="right trigger_modal">
      <a data-modal="true" data-target="#modal_structure" href="<?php echo rex_url::backendPage('structure',['id'=>$categoryId,'pid'=>$category->getParentId(),'clang'=>rex_clang::getCurrent()->getId(),'function'=>'edit','type'=>'cat']);?>">Edit</a>
      <a href="#" data-confirm="Kategorie wirklich löschen?">Delete</a>
      <span>|</span>
      <a href="<?php echo rex_url::backendPage('structure',['pid'=>$categoryId, 'clang'=>rex_clang::getCurrent()->getId(),'function'=>'add','type'=>'cat']);?>" data-modal="true" data-target="#modal_structure">Kategorie hinzufügen</a>
      <span>|</span>
      <a href="<?php echo rex_url::backendPage('structure',['pid'=>$categoryId, 'clang'=>rex_clang::getCurrent()->getId(),'function'=>'add','type'=>'art']);?>" data-modal="true" data-target="#modal_structure">Artikel hinzufügen</a>
    </span>
  </div>
  <?php if(!empty($Articles) && ($article_navigation[$categoryId] == 1 || $toggleAllArticles == 1)) {?>
  <ul class="articles">
    <?php foreach($Articles as $Article) {
      $fragment = new rex_fragment();
      $fragment->setVar('category', $category);
      $fragment->setVar('article', $Article);
      echo $fragment->parse('pages/article.php');
    }?>
  </ul>
  <?php }?>
  <?php if(!empty($Children) && $navigation[$categoryId] == 1) {?>
  <ul class="categories">
    <?php foreach($Children as $Child) {
      $fragment = new rex_fragment();
      $fragment->setVar('addon', $addon);
      $fragment->setVar('toggleAllArticles', $toggleAllArticles);
      $fragment->setVar('toggleAllCategories', $toggleAllCategories);
      $fragment->setVar('navigation', $navigation);
      $fragment->setVar('article_navigation', $article_navigation);
      $fragment->setVar('category', $Child);
      echo $fragment->parse('pages/category.php');
    }?>
  </ul>
  <?php }?>
</li>