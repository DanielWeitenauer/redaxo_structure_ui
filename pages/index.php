<?php

echo rex_view::title($this->i18n('title_structure'));

$categoryId = rex_get('category');
$articleId = rex_get('article');
$content = $sections = '';
$c_root_tree = $this->getConfig('root_tree');
$navigation = $this->getConfig('navigation',[]);
$article_navigation = $this->getConfig('article_navigation',[]);

if(rex_get('page') == 'structure') {
  if($categoryId) {
    if(!empty($navigation) && $navigation[$categoryId] == 1) {
      $navigation[$categoryId] = 0;
    } else {
      $navigation[$categoryId] = 1;
    }
    $this->setConfig('navigation',$navigation);
  }
  if($articleId) {
    if(!empty($article_navigation) && $article_navigation[$articleId] == 1) {
      $article_navigation[$articleId] = 0;
    } else {
      $article_navigation[$articleId] = 1;
    }
    $this->setConfig('article_navigation',$article_navigation);
  }
  if(($root_tree = rex_get('root_tree'))) {
    $this->setConfig('root_tree',$root_tree);
  }
}

$c_root_tree = $this->getConfig('root_tree');

$arrCategories = [];
if(!empty($c_root_tree) && $c_root_tree != 'reset') {
  $Category = rex_category::get($c_root_tree);
  $arrCategories[$Category->getId()] = $Category->getName();
  $Categories = $Category->getChildren();
  while($Category->getParent()) {
    $Category = $Category->getParent();
    $arrCategories[$Category->getId()] = $Category->getName();
  }
  $arrCategories = array_reverse($arrCategories,true);

  echo '<div class="breadcrumb">';
  echo '<a href="'.rex_url::backendPage('structure',['root_tree'=>'reset']).'">Root</a> | ';
  foreach($arrCategories as $id => $name) {
    echo '<a href="'.rex_url::backendPage('structure',['root_tree'=>$id]).'">'.$name.'</a> | ';
  }
  echo '</div>';
} else $Categories = rex_category::getRootCategories();

foreach($Categories as $Category) {
    $fragment = new rex_fragment();
    $fragment->setVar('addon', $this);
    $fragment->setVar('category', $Category);
    $fragment->setVar('navigation', $navigation);
    $fragment->setVar('article_navigation', $article_navigation);
    $sections .= '<ul class="categories root_categories">'.$fragment->parse('pages/category.php').'</ul>';
    $content = '';
}

$fragment = new rex_fragment();
$fragment->setVar('class', 'info structure', false);
$fragment->setVar('title', rex_i18n::msg('root_level'));
$fragment->setVar('body', $sections, false);
echo $fragment->parse('core/page/section.php');