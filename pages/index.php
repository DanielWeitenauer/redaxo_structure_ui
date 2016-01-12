<?php

echo rex_view::title($this->i18n('title_structure'));

$categoryId = rex_get('category');
$articleId = rex_get('article');
$content = $sections = '';
$Categories = rex_category::getRootCategories();
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
}

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