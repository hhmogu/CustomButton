<?php
$module_name = 'cgl_FunctionButton';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'label_zh',
            'label' => 'LBL_LABEL_ZH',
          ),
          1 => 
          array (
            'name' => 'label_en',
            'label' => 'LBL_LABEL_EN',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'response_event',
            'studio' => 'visible',
            'label' => 'LBL_RESPONSE_EVENT',
          ),
          1 => 
          array (
            'name' => 'function_event',
            'studio' => 'visible',
            'label' => 'LBL_FUNCTION_EVENT',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'css_theme',
            'studio' => 'visible',
            'label' => 'LBL_CSS_THEME',
          ),
          1 => 'description',
        ),
        4 => 
        array (
        ),
      ),
    ),
  ),
);
;
?>
