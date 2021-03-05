<?php
// created: 2021-02-24 17:05:23
$dictionary["AOS_Products"]["fields"]["cgl_functionbutton_aos_products"] = array (
  'name' => 'cgl_functionbutton_aos_products',
  'type' => 'link',
  'relationship' => 'cgl_functionbutton_aos_products',
  'source' => 'non-db',
  'module' => 'cgl_FunctionButton',
  'bean_name' => 'cgl_FunctionButton',
  'vname' => 'LBL_CGL_FUNCTIONBUTTON_AOS_PRODUCTS_FROM_CGL_FUNCTIONBUTTON_TITLE',
  'id_name' => 'cgl_functionbutton_aos_productscgl_functionbutton_ida',
);
$dictionary["AOS_Products"]["fields"]["cgl_functionbutton_aos_products_name"] = array (
  'name' => 'cgl_functionbutton_aos_products_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CGL_FUNCTIONBUTTON_AOS_PRODUCTS_FROM_CGL_FUNCTIONBUTTON_TITLE',
  'save' => true,
  'id_name' => 'cgl_functionbutton_aos_productscgl_functionbutton_ida',
  'link' => 'cgl_functionbutton_aos_products',
  'table' => 'cgl_functionbutton',
  'module' => 'cgl_FunctionButton',
  'rname' => 'name',
);
$dictionary["AOS_Products"]["fields"]["cgl_functionbutton_aos_productscgl_functionbutton_ida"] = array (
  'name' => 'cgl_functionbutton_aos_productscgl_functionbutton_ida',
  'type' => 'link',
  'relationship' => 'cgl_functionbutton_aos_products',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CGL_FUNCTIONBUTTON_AOS_PRODUCTS_FROM_AOS_PRODUCTS_TITLE',
);
