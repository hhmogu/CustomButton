<?php
$module_name = 'cgl_AssignmentButton';
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
        'LBL_EDITVIEW_PANEL1' => 
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
            'name' => 'flow_module',
            'studio' => 'visible',
            'label' => 'LBL_SHOW_MODULE',
          ),
          1 => 
          array (
            'name' => 'show_view',
            'studio' => 'visible',
            'label' => 'LBL_SHOW_VIEW',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'functionbutton',
            'studio' => 'visible',
            'label' => 'LBL_BUTTON',
          ),
          1 => 'description',
        ),
        3 => 
        array (
          0 => '',
          1 => '',
        ),
      ),
      'LBL_CONDITION_LINES' =>
      array(
          0 =>
          array(
              0 => 'condition_lines',
          ),
      ),
    ),
  ),
);
;
?>
