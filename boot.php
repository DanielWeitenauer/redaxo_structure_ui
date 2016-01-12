<?php

/* Assets */
if(rex_addon::get('assets')->isAvailable()) {
  rex_extension::register('BE_ASSETS',function($ep) {
    $Subject = $ep->getSubject()?$ep->getSubject():[];
    $Subject[$this->getPackageId()] = [
      'files' => [
        $this->getPath('assets/structure_ui.less'),
      ],
      'addon' => $this->getPackageId(),
    ];
    return $Subject;
  });
} elseif(rex::isBackend()) {
  rex_view::addCssFile($this->getAssetsUrl('structure_ui.less.min.css'));
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