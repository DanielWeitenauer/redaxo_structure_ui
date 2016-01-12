<?php
  $addon = $this->getVar('addon');
  $category = $this->getVar('category');
  $navigation = $this->getVar('navigation');
  $article_navigation = $this->getVar('article_navigation');
  $Children = $category->getChildren();
  $Articles = $category->getArticles();
?>
<li class="category">
  <div>
    <span class="open">
      <?php if(!empty($Children)) {?><a class="openCategories" href="<?php echo rex_url::backendPage('structure',['category'=>$category->getId()]);?>"><i class="rex-icon fa-chevron-<?php echo ($navigation[$category->getId()] == 1?'down':'right');?>"></i></a><?php }?>
      <?php if(!empty($Articles)) {?><a class="showArticles" href="<?php echo rex_url::backendPage('structure',['article'=>$category->getId()]);?>"><i class="rex-icon fa-<?php echo ($article_navigation[$category->getId()] == 1?'minus':'plus');?>-square-o"></i></a><?php }?>
    </span>
    <span class="left"><a href="<?php echo rex_url::backendPage('structure',['root_tree'=>$category->getId()]);?>"><?php echo $category->getName();?></a></span>
    <span class="right">
    </span>
  </div>
  <?php if(!empty($Articles) && $article_navigation[$category->getId()] == 1) {?>
  <ul class="articles">
    <?php foreach($Articles as $Article) {
      $fragment = new rex_fragment();
      $fragment->setVar('category', $category);
      $fragment->setVar('article', $Article);
      echo $fragment->parse('pages/article.php');
    }?>
  </ul>
  <?php }?>
  <?php if(!empty($Children) && $navigation[$category->getId()] == 1) {?>
  <ul class="categories">
    <?php foreach($Children as $Child) {
      $fragment = new rex_fragment();
      $fragment->setVar('addon', $addon);
      $fragment->setVar('navigation', $navigation);
      $fragment->setVar('article_navigation', $article_navigation);
      $fragment->setVar('category', $Child);
      echo $fragment->parse('pages/category.php');
    }?>
  </ul>
  <?php }?>
</li>