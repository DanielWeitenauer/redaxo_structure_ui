<?php
  $category = $this->getVar('category');
  $article = $this->getVar('article');
?>
<li class="article">
  <div>
    <span class="left"><a href="<?php echo rex_url::backendPage('content/edit',['category_id'=>$category->getId(),'article_id'=>$article->getId()]);?>"><i class="rex-icon fa-file-o"></i> <?php echo $article->getName();?></a></span>
    <span class="right">
      <a href="<?php echo rex_url::backendPage('content/edit',['category_id'=>$category->getId(),'article_id'=>$article->getId()]);?>">Edit</a>
      <a href="#">Delete</a>
    </span>
  </div>
</li>