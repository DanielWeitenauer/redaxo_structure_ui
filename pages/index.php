<?php

/**
 * - Sprach-Tabs
 * - Breadcrumb
 * - Head-Artikel
 * - Struktur-Baum
 */

echo rex_view::title($this->i18n('title_structure'));

$categoryId = rex_get('category');
$toggleAllArticles = rex_get('toggleAllArticles');
$toggleAllCategories = rex_get('toggleAllCategories');
$articleId = rex_get('article');
$content = $sections = '';
$c_root_tree = $this->getConfig('root_tree');
$navigation = $this->getConfig('navigation',[]);
$c_toggle_all_articles = $this->getConfig('c_toggle_all_articles', 0);
$c_toggle_all_categories = $this->getConfig('c_toggle_all_categories', 0);
$article_navigation = $this->getConfig('article_navigation',[]);

if(rex_get('page') == 'structure') {

  if($categoryId) {
    if(!empty($navigation) && $navigation[$categoryId] == 1) {
      $navigation[$categoryId] = 0;
    } else {
      $navigation[$categoryId] = 1;
    }
    $c_toggle_all_categories = 0;
    $this->setConfig('c_toggle_all_categories',0);
    $this->setConfig('navigation',$navigation);
  }

  if($articleId) {
    if(!empty($article_navigation) && $article_navigation[$articleId] == 1) {
      $article_navigation[$articleId] = 0;
    } else {
      $article_navigation[$articleId] = 1;
    }
    $c_toggle_all_articles = 0;
    $this->setConfig('c_toggle_all_articles',0);
    $this->setConfig('article_navigation',$article_navigation);
  }

  if(($root_tree = rex_get('root_tree'))) {
    $this->setConfig('root_tree',$root_tree);
  }

  if($toggleAllCategories) {
    if(!empty($c_toggle_all_categories) && $c_toggle_all_categories == 1) {
      $c_toggle_all_categories = 0;
    } else {
      $c_toggle_all_categories = 1;
    }
    $this->setConfig('c_toggle_all_categories',$c_toggle_all_categories);
    $this->setConfig('navigation',[]);
  }

  if($toggleAllArticles) {
    if(!empty($c_toggle_all_articles) && $c_toggle_all_articles == 1) {
      $c_toggle_all_articles = 0;
    } else {
      $c_toggle_all_articles = 1;
    }
    $this->setConfig('c_toggle_all_articles',$c_toggle_all_articles);
    $this->setConfig('article_navigation',[]);
  }

}

$Categories = [];
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
} else $Categories = rex_category::getRootCategories();


$fragment = new rex_fragment();
$fragment->setVar('addon', $this);
$sections .= $fragment->parse('pages/header_function.php');

$fragment = new rex_fragment();
$fragment->setVar('addon', $this);
$fragment->setVar('categories', $arrCategories);
echo $fragment->parse('pages/languages.php');

$fragment = new rex_fragment();
$fragment->setVar('addon', $this);
$fragment->setVar('categories', $arrCategories);
echo $fragment->parse('pages/breadcrumb.php');


$strArticle = '';
$RootArticles = [];
$RootCategory = null;
if(!empty($c_root_tree) && $c_root_tree != 'reset') {
  $RootCategory = rex_category::get($c_root_tree);
  $RootArticles = $RootCategory->getArticles();
} else {
  $RootArticles = rex_article::getRootArticles();
}
foreach($RootArticles as $Article) {
  $fragment = new rex_fragment();
  $fragment->setVar('category', $RootCategory);
  $fragment->setVar('article', $Article);
  $strArticle .= $fragment->parse('pages/article.php');
}
if(!empty($strArticle))
  $sections .= '<ul class="categories root_categories">'.$strArticle.'</ul><hr>';



foreach($Categories as $Category) {
  $fragment = new rex_fragment();
  $fragment->setVar('addon', $this);
  $fragment->setVar('toggleAllArticles', $c_toggle_all_articles);
  $fragment->setVar('toggleAllCategories', $c_toggle_all_categories);
  $fragment->setVar('category', $Category);
  $fragment->setVar('navigation', $navigation);
  $fragment->setVar('article_navigation', $article_navigation);
  $sections .= '<ul class="categories root_categories">'.$fragment->parse('pages/category.php').'</ul>';
  $content = '';
}


$fragment = new rex_fragment();
$panel_title = $fragment->parse('pages/panel_title.php');

$fragment = new rex_fragment();
$fragment->setVar('class', 'info structure', false);
$fragment->setVar('title', (!empty($RootCategory)?$RootCategory->getName():rex_i18n::msg('root_level')).$panel_title,false);
$fragment->setVar('body', $sections, false);
echo $fragment->parse('core/page/section.php');


