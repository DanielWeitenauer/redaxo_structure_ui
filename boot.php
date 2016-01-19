<?php

if(rex_get('page') == 'structure' && (($function = rex_get('function','string')) !== '')) {
  /* Article/Category Modal */


  $KAT = rex_sql::factory();
  $KAT->setTable(rex::getTablePrefix() . 'article')
  ->setWhere(['id'=>rex_get('id','int')])
  ->select();

  $catHandler = new rex_metainfo_category_handler();

  $Meta = $catHandler->renderFormAndSave('cat_', [
    'id' => rex_get('id','int'),
    'clang' => rex_get('clang','int'),
    'category' => $KAT,
    'catname' => 'Kontakt',
    'catpriority' => 1,
    'data_colspan' => 2,
  ]);
  
  $EP = rex_extension::registerPoint(new rex_extension_point('STRUCTURE_UI_MODAL', '', [
    'function' => $function,
    'id' => rex_get('id','int'),
    'clang' => rex_get('clang','int'),
    'category' => $KAT,
    'catname' => 'Kontakt',
    'catpriority' => 1,
    'data_colspan' => 2,
  ]));

  $fragment = new rex_fragment();
  $fragment->setVar('addon',$this);
  if($function == 'edit_cat')
    $fragment->setVar('form_data',rex_category::get(rex_get('id','int')));
  $fragment->setVar('meta',$Meta,false);
  $fragment->setVar('extended',$EP,false);
  $fragment->setVar('function',$function);
  $ModalBody = $fragment->parse('modals/add_structure.php');

  $fragment = new rex_fragment();
  $fragment->setVar('class','fade');
  $fragment->setVar('id','structure');
  $fragment->setVar('title',$this->i18n($function));

  $fragment->setVar('body',$ModalBody,false);
  echo $fragment->parse('core/modal.php');
  die();
}

/* Assets */
if(rex_addon::get('assets')->isAvailable()) {
  rex_extension::register('BE_ASSETS',function($ep) {
    $Subject = $ep->getSubject()?$ep->getSubject():[];
    $Subject[$this->getPackageId()] = [
      'files' => [
        $this->getPath('assets/structure_ui.less'),
        $this->getPath('assets/structure_ui.js'),
      ],
      'addon' => $this->getPackageId(),
    ];
    return $Subject;
  });
} elseif(rex::isBackend()) {
  rex_view::addCssFile($this->getAssetsUrl('structure_ui.less.min.css'));
  rex_view::addCssFile($this->getAssetsUrl('structure_ui.jsmin.min.css'));
}

/* Eigene index.php laden */
rex_extension::register('PAGES_PREPARED',function($ep) {
  if (rex_be_controller::getCurrentPage() == 'structure') {
    $Page = rex_be_controller::getCurrentPageObject();
    $Page->setPath($this->getPath('pages/index.php'));
  }
});

/* Push-State verhindern */
if(rex_get('page') == 'structure') {
  rex_extension::register('OUTPUT_FILTER', function($ep) {
    $Subject = str_replace('data-pjax-container="#rex-js-page-main"','data-pjax-container="#rex-js-page-main" data-pjax-no-history="1"',$ep->getSubject());
    return $Subject;
  });
}