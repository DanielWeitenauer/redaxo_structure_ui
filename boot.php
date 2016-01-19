<?php

if(rex_get('page') == 'structure' && (($function = rex_get('function','string')) !== '')) {
  /* Article/Category Modal */

  $Type = rex_get('type','string');
  $KAT = rex_sql::factory();
  $Where = ['clang_id = :clang','parent_id = :pid'];
  $WhereParam = ['clang'=>rex_get('clang','int',1),'pid'=>rex_get('pid','int',0)];
  if($Type === 'cat')
    $Where[] = 'catname != ""';
  else $Where[] = 'catname = ""';

  if($function !== 'add') {
    $Where[] = 'id = :id';
    $WhereParam['id'] = rex_get('id','int');
  }

  $Where = implode(' AND ',$Where);
  
  $Result = $KAT->setQuery('SELECT * FROM '.rex::getTablePrefix().'article WHERE '.$Where.' GROUP BY id',$WhereParam);

  if($Type === 'cat')
    $typeHandler = new rex_metainfo_category_handler();
  elseif($Type === 'art')
    $typeHandler = new rex_metainfo_category_handler();

  $_typeHandler = rex_extension::registerPoint(new rex_extension_point('STRUCTURE_UI_META_HANDLER', '', [
    'function' => $function,
    'type' => $Type,
  ]));
  if(!empty($_typeHandler))
    $typeHandler = $_typeHandler;

  $HandlerData = [
    'function' => $function,
    'type' => $Type,
    'id' => rex_get('id','int'),
    'clang' => rex_get('clang','int'),
    'category' => $Result
  ];

  $Meta = $typeHandler->renderFormAndSave($Type.'_', $HandlerData);
  $EP = rex_extension::registerPoint(new rex_extension_point('STRUCTURE_UI_MODAL', '', $HandlerData));

  $fragment = new rex_fragment();
  $fragment->setVar('addon',$this);
  $fragment->setVar('type',$Type);
  $fragment->setVar('form_data',$Result);
  $fragment->setVar('clang',rex_get('clang','int'));
  $fragment->setVar('pid',rex_get('pid','int',0));
  $fragment->setVar('meta',$Meta,false);
  $fragment->setVar('extended',$EP,false);
  $fragment->setVar('function',$function);
  $ModalBody = $fragment->parse('modals/'.($function==='add'?'add':'edit').'_structure.php');



  $fragment = new rex_fragment();
  $fragment->setVar('class','fade');
  $fragment->setVar('id','structure');
  $fragment->setVar('title',$this->i18n($function.'_'.$Type));

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