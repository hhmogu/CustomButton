<?php
 // created: 2021-02-24 17:05:23
$layout_defs["cgl_FunctionButton"]["subpanel_setup"]['cgl_functionbutton_aos_products'] = array (
  'order' => 100,
  'module' => 'AOS_Products',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CGL_FUNCTIONBUTTON_AOS_PRODUCTS_FROM_AOS_PRODUCTS_TITLE',
  'get_subpanel_data' => 'cgl_functionbutton_aos_products',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
