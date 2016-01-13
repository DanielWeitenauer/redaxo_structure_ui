<?php
  $category = $this->getVar('category');
  $categoryId = !empty($category)?$category->getId():0;
  $article = $this->getVar('article');
?>
<li class="article">
  <div>
    <span class="left"><a href="<?php echo rex_url::backendPage('content/edit',['article_id'=>$article->getId()]);?>"><i class="rex-icon fa-file-o"></i> <?php echo $article->getName();?></a></span>
    <span class="right">
      <a href="<?php echo rex_url::backendPage('content/edit',['article_id'=>$article->getId()]);?>">Edit</a>
      <a href="#" data-confirm="Artikel wirklich löschen?">Delete</a>
    </span>
  </div>
</li>